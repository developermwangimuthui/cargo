<?php

namespace App\Http\Controllers;

use App\Models\DrivingYear;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\DrivingYearsResource;

class DrivingYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $driving_years = DrivingYear::all();
            return Datatables::of($driving_years)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="drivingyeardelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    <a class="btn btn-outline-warning btn-round waves-effect waves-light name="edit" href="' . route('driving.year.edit', $data->id) . '" id="' . $data->id . '" ><i class="ti-pencil"></i>Edit</a>

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.driving_year.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apiIndex()
    {

        $driving_years = DrivingYear::all();
        if (!empty($driving_years)) {

        $driving_years = DrivingYearsResource::collection($driving_years);
        return response([
            'error' => False,
            'message' => 'Success',
            'driving_years' => $driving_years
        ], Response::HTTP_OK);
        } else {
        return response([
            'error' => true,
            'message' => 'Failed',
            'driving_years' => ''
        ], Response::HTTP_OK);
        }


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
            $driving_years = new DrivingYear();
            $driving_years->driving_years = $request->driving_year;
            if ($driving_years->save()) {
                return response([
                    'success' => True,
                    'message' => 'DrivingYear  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'DrivingYear not created',
                ], Response::HTTP_OK);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrivingYear  $drivingYear
     * @return \Illuminate\Http\Response
     */
    public function show(DrivingYear $drivingYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrivingYear  $drivingYear
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $driving_years = DrivingYear::where('id', $id)->get();


        return view('admin.driving_year.edit', compact('driving_years'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DrivingYear  $drivingYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DrivingYear::where('id', $id)
            ->update([
                'driving_years' => $request->driving_year
            ]);

        return redirect()->route('driving.year');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrivingYear  $drivingYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $driving_years_id = $request->driving_years_id;
            $driving_years = DrivingYear::find($driving_years_id);
            if ($driving_years) {
                $driving_years->delete();
                return response([
                    'success' => True,
                    'message' => 'DrivingYear  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'DrivingYear  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
