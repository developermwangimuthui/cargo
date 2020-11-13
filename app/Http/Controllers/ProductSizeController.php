<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $product_size = ProductSize::all();
            return Datatables::of($product_size)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="productsizedelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('product.size.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    '
                    ;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view ('admin.product_size.index');
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
            $product_size = new ProductSize();
            $product_size->product_sizes = $request->product_size;
            if ($product_size->save()) {
                return response([
                    'success'=>True,
                    'message'=>'Product Size  created Succesfully',
                ],Response::HTTP_OK);
            }else{
                return response([
                    'error'=>True,
                    'message'=>'Product Size not created',
                ],Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSize $productSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $product_sizes =ProductSize::where('id',$id)->get();


        return view ('admin.product_size.edit',compact('product_sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ProductSize::where('id',$id)
        ->update([
            'product_sizes'=> $request->product_size
        ]);

        return redirect()->route('product.size');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            $product_size_id = $request->product_size_id;
    $product_size = ProductSize::find($product_size_id);
    if ($product_size) {
        $product_size->delete();
        return response([
            'success'=>True,
            'message'=>'Product Size  deleted Succesfully',
        ],Response::HTTP_OK);
    } else {
        return response([
            'success'=>True,
            'message'=>'Product Size  not deleted',
        ],Response::HTTP_OK);
    }
    }
    }
}
