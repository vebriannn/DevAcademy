<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Tools;


class AdminToolsController extends Controller
{
    public function index(Request $request) {
        $perPage = $request->get('entries', 10);
        $tools = Tools::paginate($perPage);
        return view('admin.tools.view', compact('tools'));
    }

    public function create() {
        return view('admin.tools.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name_tools' => 'required',
            'logo_tools' => 'required|image|mimes:jpeg,png,jpg',
            'link' => 'required|url',
        ]);

        $images = $request->file('logo_tools');
        $imagesGetNewName = Str::random(10) . '.' . $images->getClientOriginalExtension();
        $images->storeAs('public/images/logoTools', $imagesGetNewName);
                    
        Tools::create([
            'name_tools' => $request->name_tools,
            'logo_tools' => $imagesGetNewName,
            'link' => $request->link,
        ]);
        
        Alert::success('Success', 'Tools Berhasil Di Buat');
        return redirect()->route('admin.tools');
    }

    public function edit($id) {
        $tools = Tools::findOrFail($id);
        return view('admin.tools.update', compact('tools'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name_tools' => 'required',
            'link' => 'required|url',
            'logo_tools' => 'sometimes|image|mimes:jpeg,png,jpg',
        ]);

        $tools = Tools::findOrFail($id);

        if ($request->hasFile('logo_tools')) {
            $images = $request->file('logo_tools');
            $imagesGetNewName = Str::random(10) . '.' . $images->getClientOriginalExtension();
            $images->storeAs('public/images/logoTools', $imagesGetNewName);

            // Delete the old logo
            Storage::disk('public')->delete('images/logoTools/' . $tools->logo_tools);

            $tools->logo_tools = $imagesGetNewName;
        }

        $tools->update([
            'name_tools' => $request->name_tools,
            'logo_tools' => $tools->logo_tools,
            'link' => $request->link,
        ]);

        Alert::success('Success', 'Tools Berhasil Di Update');
        return redirect()->route('admin.tools');
    }

    public function delete($id) {
        $tools = Tools::findOrFail($id); 
        Storage::disk('public')->delete('images/logoTools/' . $tools->logo_tools);
        $tools->delete();
        
        Alert::success('Success', 'Tools Berhasil Di Hapus');
        return redirect()->route('admin.tools');
    }
}