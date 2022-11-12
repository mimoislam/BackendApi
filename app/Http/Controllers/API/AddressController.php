<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    public function pickupAddress()
    {
        $user = auth()->user();

        return $user->addressOnPickup->take(5);
    }


    public function deliveryAddress()
    {
        $user = auth()->user();

        return $user->addressOnDelivery->take(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $addressDelivery=$user->addressOnDelivery->where('lat','=',$request->get('deliveryLat'))->where('long','=',$request->get('deliveryLong'))->first();
        if ($addressDelivery === null) {
            $addressDelivery=new Address;
            $addressDelivery->user_id=$user->id;
            $addressDelivery->lat=$request->get('deliveryLat');
            $addressDelivery->long=$request->get('deliveryLong');
            $addressDelivery->address=$request->get('deliveryAddress');
            $addressDelivery->is_on_delivery=true;
        }else{
            $addressDelivery->count=$addressDelivery->count+1;
        }



        $addressPickup=$user->addressOnPickup->where('lat','=',$request->get('pickupLat'))->where('long','=',$request->get('pickupLong'))->first();
        if ($addressPickup === null) {
            $addressPickup=new Address;
            $addressPickup->user_id=$user->id;
            $addressPickup->lat=$request->get('pickupLat');
            $addressPickup->long=$request->get('pickupLong');
            $addressPickup->address=$request->get('pickupAddress');
            $addressPickup->is_on_delivery=false;
        }else{
            $addressPickup->count=$addressPickup->count+1;
        }








        $addressDelivery->save();
        $addressPickup->save();

        return json_custom_response(['message'=> 'success' , 'status' => true]);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
