<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguageCreateRequest;
use App\Http\Requests\AdminLanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanugageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLanguageCreateRequest $request)
    {
        // dd($request->all());
        Language::create([
            'lang'=>$request->lang,
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status,
            'default'=>$request->default
        ]);
        toast('Language created successfully', 'success')->width('400');
        return redirect()->route('admin.language.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lang=Language::find($id);
        return view('admin.language.edit', compact('lang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminLanguageUpdateRequest $request, string $id)
    {
        $lang=Language::find($id);
        $lang->update([
            'lang'=>$request->lang,
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status,
            'default'=>$request->default
        ]);
        toast('Language updated successfully', 'success')->width('400');
        return redirect()->route('admin.language.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $lang=Language::find($id);
            if($lang->lang=='en'){
                return response(['status'=>'error', 'message'=> 'Default language can not be deleted']);
            }
            $lang->delete();
            return response(['status'=>'success', 'message'=> 'Language deleted successfully']);
            
        } catch (\Throwable $th) {
            return response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }
}
