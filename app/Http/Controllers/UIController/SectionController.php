<?php

namespace App\Http\Controllers\UiController;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectionRequest;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الاقسام', ['only' => ['index']]);
        $this->middleware('permission:اضافة قسم', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }
    public function index()
    {
        $sections = Section::get();
        return view('sections.index', compact('sections'));
    }
    public function create()
    {
        return view('sections.create');
    }
    public function store(SectionRequest $request)
    {
        /// 
        // $check = Section::where('section_name', '=', $request->section_name)->first();
        // if ($check != null) {
        //     session()->flash('error', 'هذا القسم موجود بالفعل ');
        //     return redirect()->route('sections.index');
        // }
        ///

        // $validated = $request->validated();
        // // Retrieve a portion of the validated input data...
        // $validated = $request->safe()->only(['name', 'email']);
        // $validated = $request->safe()->except(['name', 'email']);
        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name
        ]);
        return redirect()->route('sections.index')->with('success', 'تم اضافه القسم بنجاح');
    }

    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view("sections.edit", compact('section'));
    }


    public function update(SectionRequest $request, Section $section)
    {
        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);
        return redirect()->route('sections.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    public function destroy(Section $section)
    {

        $section->delete();
        return redirect()->route('sections.index')->with('success', 'تم حذف القسم بنجاح');
    }
}
