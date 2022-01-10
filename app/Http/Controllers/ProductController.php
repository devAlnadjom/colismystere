<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

use App\Http\Requests\UpdateProductRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return Inertia::render('Products/Index', [
            'filters' => $request->all('search', 'trashed'),
            'products' => Product::Where('id','>','0')->with('media')
                ->filter($request->only('search', 'trashed'))
                ->paginate(10)
                ->withQueryString()
        ]);
    }

   
    
    public function create()
    {
        //
        return Inertia::render('Products/Create');
    }

    
    public function store(StoreProductRequest $request)
    {
       
        $data= $request->safe()->except(['picture']);;
        $product= Product::create($data);

        $product->addMediaFromRequest('picture')
                ->toMediaCollection('images');
        
        return redirect()->route('products.index')->with('success',"Your new product has been added.");
        
    }

    
    public function show(int $product)
    {
        $AYU= Product::where('id',$product)
                    ->with(['categories:id,slug,name','media'])
                    ->firstOrFail();

        return Inertia::render('Products/Edit', [
            'product' => $AYU,
            'categories' => Category::get(['id','name']),
        ]);
       
    }

    
    public function edit(Product $product)
    {
        //
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {
        
        $data= $request->safe()->except(['picture']);;
        $product->update($data);
        
        return redirect()->route('products.show',$product->id)->with('success',"Your product has been updated.");
    }

   
    public function destroy(Product $product)
    {
        //
    }

    public function remove_category(Request $request)
    {

         Product::find($request->input('id_product'))->categories()->detach($request->input('id_category'));
         
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Category deleted.");

    }

    public function add_category(Request $request)
    {

         Product::find($request->input('id_product'))->categories()->attach($request->input('id_category'));
         
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Category Added.");

    
    }

    public function remove_media(Request $request)
    {

         Product::find($request->input('id_product'))->touch();
         Media::where('id', $request->input('id_media'))->delete();
         Storage::deleteDirectory('/public/'.$request->input('id_media'));
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Image deleted.");

    }

    public function add_media(Request $request)
    {

        $validated = $request->validate([
            'picture' => 'image',
        ]);

         Product::find($request->input('id_product'))
                    ->addMediaFromRequest('picture')
                    ->toMediaCollection('images');
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Media added.");

    }

}
