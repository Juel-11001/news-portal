<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\ProfilePasswordUpdateRequest;
use App\Models\Admin;
use App\Traits\FileUploadTrait;

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
        toast('Profile updated successfully', 'success')->width('400');
        return redirect()->back();
        
    }


    public function updatePassword(ProfilePasswordUpdateRequest $request, string $id)
    {
        $admin=Admin::findOrFail($id);
        $admin->password=bcrypt($request->password);
        $admin->save();
        toast('Password updated successfully', 'success')->width('400');
        return redirect()->back();
    }
}
