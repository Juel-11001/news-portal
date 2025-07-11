<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordUpdateRequest;
use App\Models\Admin;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=auth()->guard('admin')->user();
        return view('admin.profile.index', compact('user'));
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        // dd($request->all());
        $imagePath=$this->handleFileUpload($request, 'image', $request->old_image);
        $admin=Admin::findOrFail($id);
        $admin->image=!empty($imagePath) ? $imagePath : $request->old_image;
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updatePassword(ProfilePasswordUpdateRequest $request, string $id)
    {
        $admin=Admin::findOrFail($id);
        $admin->password=bcrypt($request->password);
        $admin->save();
        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
