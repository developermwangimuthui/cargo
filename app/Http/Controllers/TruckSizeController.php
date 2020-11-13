<?php

namespace App\Http\Controllers;

use App\Models\TruckSize;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class TruckSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $truck_sizes = TruckSize::all();
            return Datatables::of($truck_sizes)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="trucksizedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('truck.size.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.truck_size.index');
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
            $truck_sizes = new TruckSize();
            $truck_sizes->truck_sizes = $request->truck_size;
            if ($truck_sizes->save()) {
                return response([
                    'success' => True,
                    'message' => 'TruckSize  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'TruckSize not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckSize  $truckSize
     * @return \Illuminate\Http\Response
     */
    public function show(TruckSize $truckSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckSize  $truckSize
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $truck_sizes = TruckSize::where('id', $id)->get();


        return view('admin.truck_size.edit', compact('truck_sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckSize  $truckSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TruckSize::where('id', $id)
            ->update([
                'truck_sizes' => $request->truck_size
            ]);

        return redirect()->route('truck.size');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckSize  $truckSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $truck_sizes_id = $request->truck_size_id;
            $truck_sizes = TruckSize::find($truck_sizes_id);
            if ($truck_sizes) {
                $truck_sizes->delete();
                return response([
                    'success' => True,
                    'message' => 'TruckSize  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'TruckSize  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
