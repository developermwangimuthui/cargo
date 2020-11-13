<?php

namespace App\Http\Controllers;

use App\Models\TruckType;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class TruckTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $truck_type = TruckType::all();
            return Datatables::of($truck_type)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="trucktypedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('truck.type.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.truck_type.index');
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
            $truck_type = new TruckType();
            $truck_type->truck_types = $request->truck_type;
            if ($truck_type->save()) {
                return response([
                    'success' => True,
                    'message' => 'TruckType  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'TruckType not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function show(TruckType $truckType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $truck_types = TruckType::where('id', $id)->get();


        return view('admin.truck_type.edit', compact('truck_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TruckType::where('id', $id)
            ->update([
                'truck_types' => $request->truck_type
            ]);

        return redirect()->route('truck.type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckType  $truckType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $truck_type_id = $request->truck_type_id;
            $truck_type = TruckType::find($truck_type_id);
            if ($truck_type) {
                $truck_type->delete();
                return response([
                    'success' => True,
                    'message' => 'TruckType  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'TruckType  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
