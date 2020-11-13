<?php

namespace App\Http\Controllers;

use App\Models\TruckBrand;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TruckBrandResource;
class TruckBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $truck_brands = TruckBrand::all();
            return Datatables::of($truck_brands)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="truckbranddelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('truck.brand.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.truck_brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiIndex()
    {

        $truck_brands = TruckBrand::all();

        $truck_brands = TruckBrandResource::collection($truck_brands);
        return response([
            'error' => False,
            'message' => 'Success',
            'truck_brands' => $truck_brands
        ], Response::HTTP_OK);



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
            $truck_brands = new TruckBrand();
            $truck_brands->truck_brands = $request->truck_brand;
            if ($truck_brands->save()) {
                return response([
                    'success' => True,
                    'message' => 'TruckBrand  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'TruckBrand not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckBrand  $truckBrand
     * @return \Illuminate\Http\Response
     */
    public function show(TruckBrand $truckBrand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckBrand  $truckBrand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $truck_brands = TruckBrand::where('id', $id)->get();


        return view('admin.truck_brand.edit', compact('truck_brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckBrand  $truckBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TruckBrand::where('id', $id)
            ->update([
                'truck_brands' => $request->truck_brand
            ]);

        return redirect()->route('truck.brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckBrand  $truckBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $truck_brands_id = $request->truck_brand_id;
            $truck_brands = TruckBrand::find($truck_brands_id);
            if ($truck_brands) {
                $truck_brands->delete();
                return response([
                    'success' => True,
                    'message' => 'TruckBrand  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'TruckBrand  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
