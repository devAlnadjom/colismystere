<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

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

        sleep(1);
        return Inertia::render('Product', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'product' =>$product
        ]);

    }


    public function step2(){



        sleep(1);
        return Inertia::render('Recipient', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);

    }
}
