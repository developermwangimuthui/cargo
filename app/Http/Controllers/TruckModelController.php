<?php

namespace App\Http\Controllers;

use App\Models\TruckBrand;
use App\Models\TruckModel;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Symfony\Component\HttpFoundation\Response;

class TruckModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $truck_brands = TruckBrand::all();

        if ($request->ajax()) {
  $truck_models = TruckModel::join('truck_brands','truck_brands.id','=','truck_models.truck_brand_id')->select([
            'truck_models.id as id',
            'truck_models.truck_models as truck_models',
            'truck_brands.truck_brands as truck_brands',
        ])->orderby('truck_brands', 'asc')->get();

            return Datatables::of($truck_models)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a class="btn btn-outline-danger btn-round waves-effect waves-light name="delete" id="' . $data->id . '" onclick="truckmodeldelete(\'' . $data->id . '\')"><i class="icon-trash"></i>Delete</a>&nbsp;&nbsp;
                    

                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.truck_model.index',compact('truck_brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getMakeModels(Request $request)
    {

        $truck_brands_id = $request->truck_brands_id;
        $models = TruckModel::orderby('truck_models', 'asc')
            ->select("id", "truck_models")
            ->where('truck_brands', $truck_brands_id)
            ->get();
            dd($models);
        $response = [];
        foreach ($models as $model) {
            $response[] = [
                "id" => $model->id,
                "text" => $model->car_model
            ];
        }
        // dd($truck_brands_id);
        return response($response, Response::HTTP_OK);
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
            $truck_models = new TruckModel();
            $truck_models->truck_brand_id = $request->truck_brand;
            $truck_models->truck_models = $request->truck_model;
            if ($truck_models->save()) {
                return response([
                    'success' => True,
                    'message' => 'TruckModel  created Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'error' => True,
                    'message' => 'TruckModel not created',
                ], Response::HTTP_OK);
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TruckModel  $truckModel
     * @return \Illuminate\Http\Response
     */
    public function show(TruckModel $truckModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TruckModel  $truckModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $truck_models = TruckModel::where('id', $id)->get();


        return view('admin.truck_model.edit', compact('truck_models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TruckModel  $truckModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        TruckModel::where('id', $id)
            ->update([
                'truck_models' => $request->truck_model
            ]);

        return redirect()->route('truck.model');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TruckModel  $truckModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            $truck_models_id = $request->truck_model_id;
            $truck_models = TruckModel::find($truck_models_id);
            if ($truck_models) {
                $truck_models->delete();
                return response([
                    'success' => True,
                    'message' => 'TruckModel  deleted Succesfully',
                ], Response::HTTP_OK);
            } else {
                return response([
                    'success' => True,
                    'message' => 'TruckModel  not deleted',
                ], Response::HTTP_OK);
            }
        }
    }
}
