<?php

namespace App\Http\Controllers;

use App\Models\PackageStyle;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class PackageStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $packaging_style = PackageStyle::all();
            return Datatables::of($packaging_style)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="packagestyledelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('packaging.style.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.packaging_style.index');
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
            $packaging_style = new PackageStyle();
            $packaging_style->package_styles = $request->package_style;
            if ($packaging_style->save()) {
                return response([
                    'success' => True,
                    'message' => 'PackageStyle  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'PackageStyle not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageStyle  $packageStyle
     * @return \Illuminate\Http\Response
     */
    public function show(PackageStyle $packageStyle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageStyle  $packageStyle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $packaging_styles = PackageStyle::where('id', $id)->get();


        return view('admin.packaging_style.edit', compact('packaging_styles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PackageStyle  $packageStyle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        PackageStyle::where('id', $id)
            ->update([
                'package_styles' => $request->package_style
            ]);

        return redirect()->route('packaging.style');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageStyle  $packageStyle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $packaging_style_id = $request->packaging_style_id;
            $packaging_style = PackageStyle::find($packaging_style_id);
            if ($packaging_style) {
                $packaging_style->delete();
                return response([
                    'success' => True,
                    'message' => 'PackageStyle  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'PackageStyle  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
