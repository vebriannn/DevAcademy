<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Tools;

class AdminToolsController extends Controller
{
    public function index(Request $request)
    {
        $tools = Tools::all();
        return view('admin.tools.view', compact('tools'));
    }

    public function create()
    {
        return view('admin.tools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_tools' => 'required',
            'logo_tools' => 'required|image|mimes:jpeg,png,jpg',
            'link_tools' => 'required|url',
        ]);

        // Cek apakah nama tools sudah ada
        $existingTool = Tools::where('name_tools', $request->name_tools)->first();

        if ($existingTool) {
            return redirect()->route('admin.tools')->with('error', 'Maaf nama tools sudah ada.');
        }

        $images = $request->file('logo_tools');
        $imagesGetNewName = Str::random(10) . '.' . $images->getClientOriginalExtension();
        $images->storeAs('public/images/logoTools', $imagesGetNewName);

        Tools::create([
            'name_tools' => $request->name_tools,
            'logo_tools' => $imagesGetNewName,
            'link_tools' => $request->link_tools,
        ]);

        return redirect()->route('admin.tools')->with('success', 'Tools Berhasil Di Buat');
    }

    public function edit($id)
    {
        $tools = Tools::findOrFail($id);
        return view('admin.tools.update', compact('tools'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_tools' => 'required',
            'link_tools' => 'required|url',
            'logo_tools' => 'sometimes|image|mimes:jpeg,png,jpg',
        ]);

        $tools = Tools::findOrFail($id);

        // Cek apakah nama tools sudah ada, kecuali untuk dirinya sendiri
        $existingTool = Tools::where('name_tools', $request->name_tools)
            ->where('id', '!=', $id)
            ->first();

        if ($existingTool) {
            return redirect()->route('admin.tools')->with('error', 'Maaf, nama tools sudah digunakan.');
        }

        // Jika ada file logo yang diupload
        if ($request->hasFile('logo_tools')) {
            $images = $request->file('logo_tools');
            $imagesGetNewName = Str::random(10) . '.' . $images->getClientOriginalExtension();
            $images->storeAs('public/images/logoTools', $imagesGetNewName);

            // Hapus logo lama jika ada
            if ($tools->logo_tools) {
                Storage::disk('public')->delete('images/logoTools/' . $tools->logo_tools);
            }

            $tools->logo_tools = $imagesGetNewName;
        }

        // Update data tools
        $tools->update([
            'name_tools' => $request->name_tools,
            'logo_tools' => $tools->logo_tools,
            'link_tools' => $request->link_tools,
        ]);

        return redirect()->route('admin.tools')->with('success', 'Tools Berhasil Diubah.');
    }

    public function delete($id)
    {
        $tools = Tools::findOrFail($id);
        Storage::disk('public')->delete('images/logoTools/' . $tools->logo_tools);
        $tools->delete();

        // Alert::success('Success', 'Tools Berhasil Di Hapus');
        return redirect()->route('admin.tools')->with('success', 'Tools berhasil dihapus');
    }
}
