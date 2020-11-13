<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarrierResource;
use App\Http\Resources\CustomerResource;
use App\Mail\VerifyMail;
use App\Models\Carrier;
use App\Models\Customer;
use App\Models\EmailVerify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserRegisterResource;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\ResetMail;
use Illuminate\Support\Facades\File;
use Hash;
use DB;
use App\PasswordReseting;


class UserAuthController extends Controller
{
    public function registerUser(UserRegisterRequest $request)
    {

        if ($request->type == 'carrier') {
            // check if email already registered
            $status = Carrier::where('email', $request->email)->first();
            if (!is_null($status)) {
                return response([
                    'error' => true,
                    'message' => 'Sorry! this email is already registered!',
                ], Response::HTTP_OK);
            }
            // create and return data
            $user = new Carrier();
        } elseif ($request->type == 'customer') {
            // check if email already registered
            $status = Customer::where('email', $request->email)->first();
            if (!is_null($status)) {
                return response([
                    'error' => true,
                    'message' => 'Sorry! this email is already registered!',
                ], Response::HTTP_OK);
            }
            // create and return data
            $user = new Customer();
        }


        $user->email = $request->email;
        $user->password =Hash::make($request->password) ;
        if ($user->save()) {
            $digits = 4;
            $token = random_int(10 ** ($digits - 1), (10 ** $digits) - 1);

            $status = EmailVerify::where('email', $request->email)->count();
            if ($status > 0) {
                $pass = EmailVerify::where('email', $request->email)->first();
                $pass->email = $request->email;
                $pass->token = $token;
                $data = [
                    'token' => $token,
                ];
                if ($pass->update()) {
                    \Mail::to($request->email)->send(new VerifyMail($data));
                    return response([
                        'error' => false,
                        'message' => 'Email verification token sent',
                    ], Response::HTTP_OK);
                } else {
                    return response([
                        'error' => true,
                        'message' => 'Failed to send token!',
                    ], Response::HTTP_OK);
                }
            } else {

                $pass = new EmailVerify();
                $pass->email = $request->email;
                $pass->token = $token;
                $data = [
                    'token' => $token,
                ];
                if ($pass->save()) {
                    \Mail::to($request->email)->send(new VerifyMail($data));
                    return response([
                        'error' => false,
                        'message' => 'Email verification token sent',
                    ], Response::HTTP_OK);
                } else {
                    return response([
                        'error' => true,
                        'message' => 'Failed to send token!',
                    ], Response::HTTP_OK);
                }
            }

        }
    }

    public function verifyEmail(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'token' => 'required',
        ];
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response([
                'error' => true,
                'errors' => $error->errors()->all()
            ], Response::HTTP_OK);
        } else {
            $status = EmailVerify::where('email', $request->email)->where('token', $request->token)->count();
            if ($status > 0) {
                $type = $this->whichUserType($request->email);
                if ($type == 'carrier') {
                    $user = Carrier::where('email', $request->email)->first();
                } elseif ($type == 'customer') {
                    $user = Customer::where('email', $request->email)->first();
                } else {
                    return response([
                        'error' => true,
                        'message' => 'An serious error occurred!. Kindly contact admin.',
                    ], Response::HTTP_OK);
                }

                $user->is_verified = 1;
                $user->save();
                return response([
                    'error' => false,
                    'message' => 'Congratulations! You have successfully registered',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Email verificationt token invalid!',
                ], Response::HTTP_OK);
            }
        }
    }

    // -------------- [ User Login ] ------------------

    public function userLogin(UserLoginRequest $request)
    {
        $type = $this->whichUserType($request->email);
        if ($type == 'carrier') {
            $user = Carrier::where('email', $request->email)->first();
            $resourcename = 'carrier';
            $resource = new CarrierResource($user);
        } elseif ($type == 'customer') {
            $user = Customer::where('email', $request->email)->first();
            $resourcename = 'customer';
            $resource = new CustomerResource($user);
        } else {
            return response([
                'error' => true,
                'message' => 'Critical error, contact admin.'
            ], Response::HTTP_OK);
        }
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return response([
                    'error' => false,
                    'message' => 'Success! you are logged in successfully',
                    $resourcename => $resource
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Unauthorised, wrong email or password',
                    $resourcename => $resource
                ], Response::HTTP_OK);
            }
        } else {
            return response([
                'error' => true,
                'message' => 'Unauthorised, wrong email or password'
            ], Response::HTTP_OK);
        }

    }

    public function updateProfile(Request $request)
    {
        $userAuth = Auth::user();
        $type = $this->whichUserType($userAuth->email);
        if ($type == 'carrier') {
            $user = Carrier::where('email', $userAuth->email)->first();
            $resourcename = 'carrier';
            $resource = new CarrierResource($user);
            $idfolder = 'CarrierIDs';
            $profilefolder = 'CarrierProfilePics';
        } elseif ($type == 'customer') {
            $user = Customer::where('email', $userAuth->email)->first();
            $resourcename = 'customer';
            $resource = new CustomerResource($user);
            $idfolder = 'CustomerIDs';
            $profilefolder = 'CustomerProfilePics';
        } else {
            return response([
                'error' => true,
                'message' => 'Critical error, contact admin.'
            ], Response::HTTP_OK);
        }

        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        if ($request->profile_pic != null) {
            $user->profile_pic = $request->profile_pic;
            if (!$this->validateString($request->profile_pic)) {
                return response([
                    'error' => true,
                    'message' => 'invalid base64 string'
                ], Response::HTTP_OK);
            } else {
                $user->profile_pic = $this->moveUploadedFile($request->profile_pic, $profilefolder);
            }
        }
        if ($request->id_front != null) {
            $user->id_front = $request->id_front;
            if (!$this->validateString($request->id_front)) {
                return response([
                    'error' => true,
                    'message' => 'invalid base64 string'
                ], Response::HTTP_OK);
            } else {
                $user->id_front = $this->moveUploadedFile($request->id_front, $idfolder);
            }
        }
        if ($request->id_back != null) {
            $user->id_back = $request->id_back;
            if (!$this->validateString($request->id_back)) {
                return response([
                    'error' => true,
                    'message' => 'invalid base64 string'
                ], Response::HTTP_OK);
            } else {
                $user->id_back = $this->moveUploadedFile($request->id_back, $idfolder);
            }
        }
        $user->update(array_filter($request->all()));

        return response([
            'error' => false,
            'message' => 'Profile updated successfully',
            $resourcename => new $resource($user)
        ], Response::HTTP_CREATED);

    }

    public function forgot_password(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response(['errors' => $error->errors()->all()], Response::HTTP_OK);
        } else {
            $emailexist = User::where('email', $request->email)->count();
            if ($emailexist <= 0) {
                return response([
                    'error' => true,
                    'message' => 'User not found',
                ], Response::HTTP_OK);
            } else {
                $digits = 4;
                $token = random_int(10 ** ($digits - 1), (10 ** $digits) - 1);

                $status = PasswordReseting::where('email', $request->email)->count();
                if ($status > 0) {
                    $pass = PasswordReseting::where('email', $request->email)->first();
                    $pass->email = $request->email;
                    $pass->token = $token;
                    $data = [
                        'token' => $token,
                    ];
                    if ($pass->update()) {
                        \Mail::to($request->email)->send(new ResetMail($data));
                        return response([
                            'error' => false,
                            'message' => 'Password reset token sent',
                        ], Response::HTTP_OK);
                    } else {
                        return response([
                            'error' => true,
                            'message' => 'Failed to send token!',
                        ], Response::HTTP_OK);
                    }
                } else {

                    $pass = new PasswordReseting();
                    $pass->email = $request->email;
                    $pass->token = $token;
                    $data = [
                        'token' => $token,
                    ];
                    if ($pass->save()) {
                        \Mail::to($request->email)->send(new ResetMail($data));
                        return response([
                            'error' => false,
                            'message' => 'Password reset token sent',
                        ], Response::HTTP_OK);
                    } else {
                        return response([
                            'error' => true,
                            'message' => 'Failed to send token!',
                        ], Response::HTTP_OK);
                    }
                }
            }
        }
    }

    public function token_connfrm(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'token' => 'required',
        ];
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response(['errors' => $error->errors()->all()], Response::HTTP_OK);
        } else {
            $status = PasswordReseting::where('email', $request->email)->where('token', $request->token)->count();
            if ($status > 0) {
                return response([
                    'error' => false,
                    'message' => 'Password reset token validated',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Password reset token invalid!',
                ], Response::HTTP_OK);
            }
        }
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response(['errors' => $error->errors()->all()], Response::HTTP_OK);
        } else {
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            if ($user->update()) {
                return response([
                    'error' => false,
                    'message' => 'Password updated successfuly!',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => true,
                    'message' => 'Password failed to update!',
                ], Response::HTTP_OK);
            }
        }
    }

    public function whichUserType($email)
    {
        $carrier = Carrier::where('email', $email)->first();
        $customer = Customer::where('email', $email)->first();

        if (!is_null($carrier)) {
            //already there
            return 'carrier';
        } elseif (!is_null($customer)) {
            return 'customer';
        } elseif (!is_null($customer) && !is_null($carrier)) {
            return 'conflict';
        }
    }


    public function moveUploadedFile($param, $folder)
    {
        $image = str_replace('data:image/png;base64,', '', $param);
        $image = str_replace(' ', '+', $image);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $imageName = sprintf('%s.%0.8s', $basename, "png");

        $filePath = $folder . "/" . $imageName;
        // return Storage::disk('local')->put($filePath, $uploadedFile_base64) ? $filePath : false;
        //check if the directory exists
        if (!File::isDirectory($folder)) {
            //make the directory because it doesn't exists
            File::makeDirectory($folder);
        }
        if (\File::put(public_path() . '/' . $filePath, base64_decode($image))) {
            return $imageName;
        } else {
            return null;
        }
    }

    //function to validate base64 string

    public function validateString($s)
    {
        if (preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s) && base64_decode($s, true)) {
            return true;
        } else {
            return false;
        }
    }

}
