<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Resources\Car as CarResource;
use Illuminate\Http\Request;
use App\Http\Requests;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        
        $searchbrand = $request->get('brand');
        $searchmodel = $request->get('model');
        $searchproductionyear = $request->get('productionyear');

        $cars = Car::where('brand', 'like', '%'.$searchbrand.'%')
                   ->where('model', 'like', '%'.$searchmodel.'%')
                   ->where('productionyear', 'like', '%'.$searchproductionyear.'%')
                   ->get();

        return CarResource::collection($cars);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
         
        $car = $request->isMethod('put') ? Car::FindOrfail($request->car_id)
         : new Car;

        $car->id = $request->input('car_id');
        $car->name = $request->input('name');
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->productionyear = $request->input('productionyear');
        $car->description = $request->input('description');
        $car->rented = $request->input('rented');


        if($car->save()){
            
            return new CarResource($car);
        }

    }


    public function rent(Request $request,$id)
    {
        $car = Car::FindOrfail($id);

        $car->id = $id;
        $car->rented = 1;
        if($car->save()){
            
            return new CarResource($car);
        }

    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);

        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        if($car->delete()){
            return new CarResource($car);
        }

    }
}
