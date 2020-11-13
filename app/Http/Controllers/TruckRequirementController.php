<?php

namespace App\Http\Controllers;

use App\Models\TruckRequirement;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class TruckRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $truck_requirements = TruckRequirement::all();
            return Datatables::of($truck_requirements)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="truckrequirementdelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('product.category.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.product_category.index');
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
            $truck_requirements = new TruckRequirement();
            $truck_requirements->product_categories = $request->product_category;
            if ($truck_requirements->save()) {
                return response([
                    'success' => True,
                    'message' => 'TruckRequirement  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'TruckRequirement not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckRequirement  $truckRequirement
     * @return \Illuminate\Http\Response
     */
    public function show(TruckRequirement $truckRequirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckRequirement  $truckRequirement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product_categories = TruckRequirement::where('id', $id)->get();


        return view('admin.product_category.edit', compact('product_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckRequirement  $truckRequirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TruckRequirement::where('id', $id)
            ->update([
                'product_categories' => $request->product_category
            ]);

        return redirect()->route('product.category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckRequirement  $truckRequirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $truck_requirement_ids = $request->product_category_id;
            $truck_requirements = TruckRequirement::find($truck_requirement_ids);
            if ($truck_requirements) {
                $truck_requirements->delete();
                return response([
                    'success' => True,
                    'message' => 'TruckRequirement  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'TruckRequirement  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
