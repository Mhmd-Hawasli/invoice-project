<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('pages.sections.all-sections', compact('sections')); // Pass 'sections' as a string
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



    public function store(StoreSectionRequest $request)
    {
        // Validate the request data
        $validatedData = $request->validated();

        // Add the authenticated user's ID to the data
        $validatedData['user_id'] = Auth::user()->id;

        // Create the section record
        Section::create($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم حفظ البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {

        // Update section details
        $section->section_name = $request->section_name;
        $section->description = $request->description;

        // Save the changes to the database
        $section->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'تم تعديل القسم بنجاح');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        try
        {
            // Delete the section
            $section->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'تم حذف القسم بنجاح');
        }
        catch (\Exception $e)
        {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'لم يتم حذف القسم بنجاح' . $e->getMessage());
        }
    }

}
