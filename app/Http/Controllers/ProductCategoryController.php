<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $product_category = ProductCategory::all();
            return Datatables::of($product_category)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="productcategorydelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
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
            $product_category = new ProductCategory();
            $product_category->product_categories = $request->product_category;
            if ($product_category->save()) {
                return response([
                    'success' => True,
                    'message' => 'ProductCategory  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'ProductCategory not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response

     */
    public function edit(Request $request, $id)
    {
        $product_categories = ProductCategory::where('id', $id)->get();


        return view('admin.product_category.edit', compact('product_categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ProductCategory::where('id', $id)
            ->update([
                'product_categories' => $request->product_category
            ]);

        return redirect()->route('product.category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $product_category_id = $request->product_category_id;
            $product_category = ProductCategory::find($product_category_id);
            if ($product_category) {
                $product_category->delete();
                return response([
                    'success' => True,
                    'message' => 'ProductCategory  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'ProductCategory  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
