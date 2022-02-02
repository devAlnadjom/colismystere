<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class ShopController extends Controller
{
    //
    public function index(){

        $products= Product::where('avaible','1')->with(['categories:id,name','media'])
            ->paginate(9);
        
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'products' => $products
        ]);

    }

    public function viewone($slug,$id){

        $product= Product::where('slug',$slug)
                    ->orWhere('id',$id)
                    ->with(['categories:id,slug,name','media','features'])
                    ->firstOrFail();
       // dd($product);

       
        return Inertia::render('Product', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'product' =>$product
        ]);

    }


    public function step2(Request $request){

        $total = Cart::getTotal();
        return Inertia::render('Recipient', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'cartTotal' => $total,
            'recipientData'=> $request->session()->has('recipientInfo')?$request->session()->get("recipientInfo"):false
        ]);

    }



    public function storeRecipient(Request $request){

        $total = Cart::getTotal();

        usleep(100000);
        $allRecipientInfo= $request->all();
        $_SESSION['Recipient'] = array();
        array_push($_SESSION['Recipient'],$allRecipientInfo);
        $request->session()->put("recipientInfo", $allRecipientInfo);
        $request->session()->save();

        return redirect()->route('order.checkout');

    }



    public function checkout(Request $request){

        $total = Cart::getTotal();
        $cart = Cart::getContent();
        $infoRecipient= $request->session()->get("recipientInfo");
        
        usleep(100000);
        return Inertia::render('Checkout', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'cartTotal' => $total,
            'cart' => $cart,
            'stripeKey'=> env("STRIPE_KEY", null),
            
        ]);

    }


    public function sumary(Request $request){

        if (! $request->session()->has('last_order')) {
             return redirect()->route('home');
        }
        
        $order= $request->session()->get("last_order");
        $order= Order::Where('id',$order)
                    ->with(['products'])
                    ->firstOrFail();
        $request->session()->forget('last_order');
        $request->session()->forget('recipientInfo');

        return Inertia::render('Order_sumary', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'order' =>$order
            
        ]);

    }
    
    
    public function tracking( $id,$key){
       // dd($id);
        $order= Order::Where('id',$id)
                    ->Where('sha_key','like',"%".$key."%")
                    //->orWhere('sha_key',$key)
                    ->with(['products.media'])
                    ->firstOrFail();
        $products=$order->products()->with(['media'])->get();
       // dd($products);
        

        return Inertia::render('Order_tracking', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'order' =>$order,
            'products'=>$products,
            
        ]);

    }
}
