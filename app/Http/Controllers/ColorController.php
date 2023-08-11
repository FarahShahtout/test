<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('colors.index', compact('colors'));
    }

    public function show(Color $color)
    {
        return view('colors.show', compact('color'));
    }

    public function create()
    {
        return view('colors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $color = Color::create($validatedData);

        
        $productIds = $request->input('product_ids', []);
        $color->products()->attach($productIds);

        return redirect()->route('colors.index')->with('success', 'Update done');
    }

    public function edit(Color $color)
    {
        return view('colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $color->update($validatedData);

       
        $productIds = $request->input('product_ids', []);
        $color->products()->sync($productIds);

        return redirect()->route('colors.index')->with('success', '');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'تم حذف اللون بنجاح.');
    }

    public function attachProduct(Request $request, Color $color)
    {
        $productIds = $request->input('product_ids', []);

        // إضافة المنتجات المحددة إلى اللون باستخدام العلاقة "attach"
        $color->products()->attach($productIds);

        return redirect()->route('colors.show', $color)->with('success', 'تمت إضافة المنتجات للون بنجاح.');
    }

    public function detachProduct(Request $request, Color $color)
    {
        $productIds = $request->input('product_ids', []);

       
        $color->products()->detach($productIds);

        return redirect()->route('colors.show', $color)->with('success', 'تمت إزالة المنتجات من اللون بنجاح.');
    }
}
