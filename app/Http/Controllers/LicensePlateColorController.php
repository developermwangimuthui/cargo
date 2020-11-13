<?php

namespace App\Http\Controllers;

use App\Models\LicensePlateColor;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
class LicensePlateColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $license_plate_color = LicensePlateColor::all();
            return Datatables::of($license_plate_color)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="licenseplatecolordelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('license.plate.color.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.license_plate_color.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $license_plate_color = new LicensePlateColor();
            $license_plate_color->license_plate_colors = $request->license_plate_color;
            if ($license_plate_color->save()) {
                return response([
                    'success' => True,
                    'message' => 'LicensePlateColor  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'LicensePlateColor not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LicensePlateColor  $licensePlateColor
     * @return \Illuminate\Http\Response
     */
    public function show(LicensePlateColor $licensePlateColor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LicensePlateColor  $licensePlateColor
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $license_plate_colors = LicensePlateColor::where('id', $id)->get();


        return view('admin.license_plate_color.edit', compact('license_plate_colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LicensePlateColor  $licensePlateColor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        LicensePlateColor::where('id', $id)
            ->update([
                'license_plate_colors' => $request->license_plate_color
            ]);

        return redirect()->route('license.plate.color');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LicensePlateColor  $licensePlateColor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $license_plate_color_id = $request->license_plate_color_id;
            $license_plate_color = LicensePlateColor::find($license_plate_color_id);
            if ($license_plate_color) {
                $license_plate_color->delete();
                return response([
                    'success' => True,
                    'message' => 'LicensePlateColor  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'LicensePlateColor  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
