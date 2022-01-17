<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;

use App\Http\Requests\UpdateProductRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{
   
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
                    ->with(['categories:id,slug,name','media','features'])
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

//         $media->getPath();  // the path to the where the original image is stored
// $media->getPath('thumb'); // the path to the converted image with dimensions 368x232

// $media->getUrl();  // the url to the where the original image is stored
// $media->getUrl('thumb');

         Product::find($request->input('id_product'))
                    ->addMediaFromRequest('picture')
                    ->toMediaCollection('images');
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Media added.");

    }



    public function add_feature(Request $request)
    {
       $validated= $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required|max:255',
        ]);

         Product::find($request->input('id_product'))->features()->create($validated);
         
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Feature Added.");

    
    }


    public function remove_feature(Request $request)
    {

         Product::find($request->input('id_product'))->features()->delete($request->input('id_feature'));
         
         return redirect()->route('products.show',$request->input('id_product'))->with('success',"Category deleted.");

    }

}
