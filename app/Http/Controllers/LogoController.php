<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logo;


class LogoController extends Controller
{
    private $logos, $logo, $message;
    public function index()
    {
        return view('admin.logo.index');
    }
    public function create(Request $request)
    {
        $request->validate([
            'title'               => 'required',
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        Logo::newLogo($request);
        return back()->with('message', 'Logo added successfully!');
    }
    public function manage()
    {
        $this->logos = Logo::all();
        return view('admin.logo.manage', ['logos' => $this->logos]);
    }
    public function updateStatus($id)
    {
        $this->message = Logo::updateLogoStatus($id);
        return back()->with('message', $this->message);
    }
    public function edit($id)
    {
        $this->logo = Logo::find($id);
        return view('admin.logo.edit', ['logo' => $this->logo]);
    }
    public function update(Request $request, $id)
    {
        Logo::updateLogo($request, $id);
        return redirect('/manage/logo')->with('message', 'Logo updated successfully!');
    }
    public function delete($id)
    {
        Logo::deleteLogo($id);
        return back()->with('message_delete', 'Logo deleted successfully!');
    }
}
