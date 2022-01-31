<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    
    
    public function index()
    {
        //
    }

    
    
    public function create()
    {
        //
    }

    
    
    public function store(Request $request)
    {

        $validated= $this->validate($request, [
            'driver_id' => 'numeric|required',
            'order_id' => 'numeric|required',
            'deliver_before' => 'date',
        ]);

        Delivery::where('order_id',$request->input("order_id"))->update(['status'=>3]);
        $delivery= Delivery::create($validated);
        $delivery->update(['status'=>1]);
        $delivery->order()->update(['status'=>2]);

        return redirect()->back()->with('success',"Delivery planned...");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   
    
    public function edit($id)
    {
        //
    }

    

    public function update(Request $request, $id)
    {
        //
    }

    
    
    public function destroy($id)
    {
        //
    }
}
