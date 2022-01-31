<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Driver;
use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return Inertia::render('Orders/Index', [
            //'orders' => Order::paginate(),
            'filters' => $request->all('search', 'trashed'),
            'orders' => Order::Where('total','>','-1')
                ->filter($request->only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order= Order::where('id',$id)
                    ->with(['user'])
                    ->firstOrFail();

        $products= $order->products()->get();
        return Inertia::render('Orders/View', [
            'products' => $products,
            'order' => $order,
            'categories' => Category::get(['id','name']),
            'drivers' => Driver::with(["user"])->get(),
            'deliveries'=> $order->deliveries()->with(['driver.user'])->get(),
        ]);
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
        $order= Order::where('id',$id);
         $validated= $this->validate($request, [
            'status' => 'numeric|required',
            'type' => 'numeric|required',
        ]);
        if($request->input("type")==1){
            $order->update(['status'=>$request->input("status")]);
        }
        //Noify User if Need 
        return redirect()->back()->with("success","your order state has been change");
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
