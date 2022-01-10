<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        return Inertia::render('Categories/Index', [
            'filters' => $request->all('search', 'trashed'),
            'categories' => Category::where('id','>','0')
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
        return Inertia::render('Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $data= $request->validated();
        $category= Category::create($data);

        return redirect()->route('categories.index')->with('success',"Your new category has been added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(int $category)
    {
        $category= Category::where('id',$category)
                    ->with(['products:id,name'])
                    ->firstOrFail();

        return Inertia::render('Categories/Edit', [
            'category' => $category,
        ]);
    }

    
    public function edit(Category $category)
    {
        
    }

  

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data= $request->validated();
        $category->update($data);
        
        return redirect()->route('categories.show',$category->id)->with('success',"Your category has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
