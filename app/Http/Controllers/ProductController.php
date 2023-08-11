<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    
    $colors = Color::all();
    $categories = Category::pluck('name', 'id'); 

    return view('products.create', compact('colors', 'categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required',
            'category_name' => 'required', 
            'colors' => 'array', 
            
        ]);
    
        $category = Category::where('name', $request->input('category_name'))->first();
        
        $productData = $request->except('category_name'); 
        $productData['category_id'] = $category->id; 
    
        $product = Product::create($productData);
        $product->colors()->attach($request->input('colors', []));

         if ($request->hasFile('image')) {
            $image = $request->file('image');
            
 
            $product->addMedia($image)->toMediaCollection('product_images');
          
        }
        
    
        return redirect()->route('products.index')->with('success', 'Product has been created successfully.');
    }
    


    /**
     * Display the specified resource.
     */
    public function show( Product $product)
    {
       dd($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
    
        $colors = Color::all();
        $categories = Category::all(); 
    
        return view('products.edit', compact('product', 'colors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'status' => 'required',
            'category_name' => 'required', 
            'colors' => 'array',
        ]);
    
        $product = Product::findOrFail($id);
    
        $product->update($request->all());
    
        $category = Category::where('name', $request->input('category_name'))->first();
        $product->category()->associate($category)->save();
    
        $product->colors()->sync($request->input('colors', []));
    
        return redirect()->route('products.index')->with('success', 'Product has been updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
   
    $product->colors()->detach();


    return redirect()->route('products.index')->with('success', 'ProductColor has been deleted successfully.');
}
}
