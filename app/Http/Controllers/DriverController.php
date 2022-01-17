<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Driver;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    
    public function index(Request $request)
    {
        return Inertia::render('Drivers/Index', [
            'filters' => $request->all('search', 'trashed'),
            'drivers' => Driver::Where('id','>','0')->with('user')
               // ->filter($request->only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
        ]);
    }

   
    public function create()
    {
        return Inertia::render('Drivers/Create');
    }

    
    public function store(Request $request)
    {
        $driver = Driver::create([
            'registration'=>$request->input('registration'),
            'driver_license'=>$request->input('driver_license'),
            'vehicule_model'=>$request->input('vehicule_model'),
            'vehicule_type'=>$request->input('vehicule_type'),
        ]);

        $driver->user()->create([
            'email'=>$request->input('email'),
            'password'=>Hash::make(Str::random(10)),
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),
            'contact'=>$request->input('contact'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'zip_code'=>$request->input('zip_code'),
            'admoo'=>0,
        ]
        );

        return redirect()->route('driver.index')->with('success',"Your new driver has been added.");
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
