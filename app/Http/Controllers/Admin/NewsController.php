<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewsCreateRequest;
use App\Http\Requests\AdminNewsUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use App\Models\News;
use App\Models\Tag;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        $newsByLanguage=$this->fetchData($languages);
        return view('admin.news.index', compact('languages','newsByLanguage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $languages = Language::all();
         return view('admin.news.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $imagePath=$this->handleFileUpload($request, 'image');

        $news=new News();
        $news->admin_id=Auth::guard('admin')->user()->id;
        $news->language=$request->language;
        $news->category_id=$request->category;
        $news->title=$request->title;
        $news->slug=\Str::slug($request->title);
        $news->content=$request->content;
        $news->meta_title=$request->meta_title;
        $news->meta_description=$request->meta_description;
        $news->is_breaking_news=$request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider=$request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular=$request->show_at_popular == 1 ? 1 : 0;
        $news->status=$request->status == 1 ? 1 : 0;
        $news->image=$imagePath;
        $news->save();

        $tags=explode(',', $request->tags);
        $tagId=[];
        foreach($tags as $tag){
            $item=new Tag();
            $item->name=$tag;
            $item->save();
            $tagId[]=$item->id;
        }

        $news->tags()->attach($tagId);
        
        toast(__('News Created successfully'), 'success')->width('400');
        return redirect()->route('admin.news.index');
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
        $news=News::findOrFail($id);
        $categories=Category::where('language', $news->language)->get();
        return view('admin.news.edit', compact('languages', 'news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminNewsUpdateRequest $request, string $id)
    {
        $news=News::findOrFail($id);
        $imagePath=$this->handleFileUpload($request, 'image', $news->image);
        $news->language=$request->language;
        $news->category_id=$request->category;
        $news->title=$request->title;
        $news->slug=\Str::slug($request->title);
        $news->content=$request->content;
        $news->meta_title=$request->meta_title;
        $news->meta_description=$request->meta_description;
        $news->is_breaking_news=$request->is_breaking_news == 1 ? 1 : 0;
        $news->show_at_slider=$request->show_at_slider == 1 ? 1 : 0;
        $news->show_at_popular=$request->show_at_popular == 1 ? 1 : 0;
        $news->status=$request->status == 1 ? 1 : 0;
        $news->image=!empty($imagePath) ? $imagePath : $news->image;
        $news->save();

         $tags=explode(',', $request->tags);
        $tagId=[];
        $news->tags()->delete();
        $news->tags()->detach($news->tags);

        foreach($tags as $tag){
            $item=new Tag();
            $item->name=$tag;
            $item->save();
            $tagId[]=$item->id;
        }

        $news->tags()->attach($tagId);
        toast(__('News Updated successfully'), 'success')->width('400');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news=News::findOrFail($id);
        $this->deleteFile($news->image);
        $news->tags()->delete();
        $news->delete();
        return response(['status'=>'success', 'message'=>__('News deleted successfully')]);

    }
    public function getCategories(Request $request)
    {
       $category=Category::where('language', $request->lang)->orderByDesc('id')->get();
       return $category;
    }
    /**
     * fetch news by language into index page
     */
        public function fetchData($languages)
    {
        $result=[];
        foreach ($languages as $language) {
             $news = News::where('language', $language->lang)->orderBy('id', 'desc')->get();
             $result[$language->lang]=$news;
        }
        return $result;
    }
    /** 
     * update news all status 
     */
    public function changeStatus(Request $request)
    {
        $news=News::find($request->id);
        $news->{$request->name}=$request->status;
        $news->save();
        return response(['status'=>'success','message'=>__('updated successfully')]);
    }
    public function copyNews(string $id)
    {
        $news=News::findOrFail($id);
        $copyNews=$news->replicate();
        $copyNews->save();
        toast(__('News copied successfully'), 'success')->width('400');
        return redirect()->back();
    }

}
