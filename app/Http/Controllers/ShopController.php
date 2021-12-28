<?php

namespace App\Http\Controllers;

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

        $products= Product::with(['categories:id,name'])
            ->paginate(9);
        //dd($products);

        //sleep(1);
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
                    ->with(['categories:id,slug,name'])
                    ->firstOrFail();
       // dd($product);

       usleep(500000);
        return Inertia::render('Product', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'product' =>$product
        ]);

    }


    public function step2(){

        $total = Cart::getTotal();

        usleep(200000);
        return Inertia::render('Recipient', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'cartTotal' => $total,
        ]);

    }



    public function storeRecipient(Request $request){

        $total = Cart::getTotal();

        usleep(100000);
        $allRecipientInfo= $request->all();
        //get all session data
        //$request->session()->all();
        $_SESSION['Recipient'] = array();
        array_push($_SESSION['Recipient'],$allRecipientInfo);
        $request->session()->put("recipientInfo", $allRecipientInfo);
        $request->session()->save();

        // Forget a single key...
        //$request->session()->forget('name');

        //if ($request->session()->has('users')) 

        //ddd($request->session()->get("recipientInfo"));


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
}
