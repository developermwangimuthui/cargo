<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $product_type = ProductType::all();
            return Datatables::of($product_type)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="productsizedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('product.type.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    '
                    ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view ('admin.product_type.index');
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
        if($request->ajax()){
            $product_type = new ProductType();
            $product_type->product_types = $request->product_type;
            if ($product_type->save()) {
                return response([
                    'success'=>True,
                    'message'=>'ProductType  created Succesfully',
                ],Response::HTTP_OK);
            }else{
                return response([
                    'error'=>True,
                    'message'=>'ProductType not created',
                ],Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $productType)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $product_types =ProductType::where('id',$id)->get();


        return view ('admin.product_type.edit',compact('product_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)    {
        ProductType::where('id',$id)
        ->update([
            'product_types'=> $request->product_type
        ]);

        return redirect()->route('product.type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            $product_type_id = $request->product_type_id;
    $product_type = ProductType::find($product_type_id);
    if ($product_type) {
        $product_type->delete();
        return response([
            'success'=>True,
            'message'=>'ProductType  deleted Succesfully',
        ],Response::HTTP_OK);
    } else {
        return response([
            'success'=>True,
            'message'=>'ProductType  not deleted',
        ],Response::HTTP_OK);
    }
    }
    }
}
