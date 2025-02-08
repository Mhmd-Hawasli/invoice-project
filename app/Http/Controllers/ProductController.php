<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $products = product::all();
        return view('pages.products.dashboard', compact('sections', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Create the Product record
        product::create($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateProductRequest $request, Product $product)
    {
        // Get section ID by section name from the database
        $product->section_id = DB::table('sections')->where('section_name', $request->section_name)->value('id');

        // Update product details
        $product->product_name = $request->product_name;
        $product->description = $request->description;

        // Save changes to the database
        $product->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'تم تعديل المنتج بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        try
        {
            // Delete the product
            $product->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'تم حذف المنتج بنجاح');
        }
        catch (\Exception $e)
        {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'لم يتم حذف المنتج بنجاح' . $e->getMessage());
        }
    }
}
