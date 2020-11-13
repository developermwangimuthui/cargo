<?php

namespace App\Http\Controllers;

use App\Models\CarrierLength;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
use DB;
class CarrierLengthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $carrier_lengths = CarrierLength::all();
            return Datatables::of($carrier_lengths)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="carrierlengthdelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('carrier.length.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.carrier_length.index');
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
            $carrier_lengths = new CarrierLength();
            $carrier_lengths->carrier_lengths = $request->carrier_length;
            if ($carrier_lengths->save()) {
                return response([
                    'success' => True,
                    'message' => 'CarrierLength  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'CarrierLength not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarrierLength  $carrierLength
     * @return \Illuminate\Http\Response
     */
    public function show(CarrierLength $carrierLength)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarrierLength  $carrierLength
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // dd($id);
        $carrier_lengths = DB::table('carrier_lengths')->where('id',$id)->get();
        // dd($carrier_lengths);

// foreach( $carrier_lengths as $carrier_length){
// dd($carrier_length->carrier_lengths);
// }

        return view('admin.carrier_length.edit', compact('carrier_lengths'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarrierLength  $carrierLength
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CarrierLength::where('id', $id)
            ->update([
                'carrier_lengths' => $request->carrier_length
            ]);

        return redirect()->route('carrier.length');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarrierLength  $carrierLength
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $carrier_lengths_id = $request->carrier_length_id;
            $carrier_lengths = CarrierLength::find($carrier_lengths_id);
            if ($carrier_lengths) {
                $carrier_lengths->delete();
                return response([
                    'success' => True,
                    'message' => 'CarrierLength  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'CarrierLength  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
