<?php

namespace App\Http\Controllers\UiController;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:المنتجات', ['only' => ['index']]);
        $this->middleware('permission:اضافة منتج', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل منتج', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف منتج', ['only' => ['destroy']]);
    }
    public function index()
    {
        $products = Product::get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::select('id', 'section_name')->get();
        return view("products.create", compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description
        ]);
        return redirect()->route('products.index')->with('success', 'تم اضافه المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        ///
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $sections = Section::select('id', "section_name")->get();
        return view('products.edit', compact('product', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'product_name' => $request->product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }
}
