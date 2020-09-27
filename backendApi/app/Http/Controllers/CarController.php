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
        

        $cars = Car::paginate(100);

        return CarResource::collection($cars);

    }
    
    public function available(Request $request){
        
        $searchbrand = $request->get('brand');
        $searchmodel = $request->get('model');
        $searchproductionyear = $request->get('productionyear');

        $cars = Car::where('brand', 'like', '%'.$searchbrand.'%')
                   ->where('model', 'like', '%'.$searchmodel.'%')
                   ->where('productionyear', 'like', '%'.$searchproductionyear.'%')              
                   ->where('rented', 'like', '0')
                   ->paginate(12);

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

          if ($request->input('car_id'));
          {
            $car->id = $request->input('car_id');
          }  if ($request->input('name'));
          {
             $car->name = $request->input('name');

          } if ($request->input('brand'));
          {
            $car->brand = $request->input('brand');

          } if ($request->input('model'));
          {
            $car->model = $request->input('model');

          } if ($request->input('productionyear'));
          {
            $car->productionyear = $request->input('productionyear');

          } if ($request->input('description'));
          {
            $car->description = $request->input('description');

          } if ($request->input('rented'));
          {
            $car->rented = $request->input('rented');
        }


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
