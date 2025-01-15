<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $banners, $banner, $message;
    public function index()
    {
        return view('admin.banner.index');
    }
    public function create(Request $request)
    {
        $request->validate([
            'title'               => 'required',
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Banner::newbanner($request);
        return back()->with('message', 'banner added successfully!');
    }
    public function manage()
    {
        $this->banners = Banner::all();
        return view('admin.banner.manage', ['banners' => $this->banners]);
    }
    public function updateStatus($id)
    {
        $this->message = Banner::updatebannerStatus($id);
        return back()->with('message', $this->message);
    }
    public function edit($id)
    {
        $this->banner = Banner::find($id);
        return view('admin.banner.edit', ['banner' => $this->banner]);
    }
    public function update(Request $request, $id)
    {
        Banner::updatebanner($request, $id);
        return redirect('/manage/banner')->with('message', 'banner updated successfully!');
    }
    public function delete($id)
    {
        Banner::deletebanner($id);
        return back()->with('message_delete', 'banner deleted successfully!');
    }
}
