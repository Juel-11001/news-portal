<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoryCreateRequest;
use App\Http\Requests\AdminCategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages=Language::all();
        $categories=$this->getCategories($languages);
        // dd($categories);
        return view('admin.category.index', compact('languages', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        return view('admin.category.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryCreateRequest $request)
    {
        // dd($request->all());
        $category=new Category();
        $category->language=$request->language;
        $category->name=$request->name;
        $category->slug=\Str::slug($request->name);
        $category->show_at_nav=$request->show_at_nav;
        $category->status=$request->status;
        $category->save();
        toast(__('Category Created successfully'), 'success')->width('400');
        return redirect()->route('admin.category.index');

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
        $languages = Language::all();
        $category=Category::findOrFail($id);
        return view('admin.category.edit', compact('languages', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryUpdateRequest $request, string $id)
    {
        $category=Category::findOrFail($id);
        $category->language=$request->language;
        $category->name=$request->name;
        $category->slug=\Str::slug($request->name);
        $category->show_at_nav=$request->show_at_nav;
        $category->status=$request->status;
        $category->save();
        toast(__('Category Updated successfully'), 'success')->width('400');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category=Category::findOrFail($id);
            $category->delete();
            return response(['status'=>'success', 'message'=> 'Category deleted successfully']);
        } catch (\Throwable $th) {
            return response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }

    public function getCategories($languages)
    {
        $result=[];
        foreach ($languages as $language) {
             $category = Category::where('language', $language->lang)->orderByDesc('id')->get();
             $result[$language->lang]=$category;
        }
        return $result;
    }

}
