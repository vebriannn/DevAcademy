<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profession;

class AdminProfessionController extends Controller
{
    public function index(Request $request)
    {
        $professions = Profession::all();
        return view('admin.profession.view', compact('professions'));
    }

    public function create()
    {
        return view('admin.profession.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // Cek apakah nama tools sudah ada
        $existingprofession = Profession::where('name', $request->name)->first();

        if ($existingprofession) {
            return redirect()->route('admin.profession')->with('error', 'Maaf profesi sudah ada.');
        }


        Profession::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.profession')->with('success', 'Profesi berhasil dibuat');
    }

    public function edit($id)
    {
        $profession = Profession::findOrFail($id);
        return view('admin.profession.update', compact('profession'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $profession = Profession::findOrFail($id);

        // Cek apakah nama tools sudah ada, kecuali untuk dirinya sendiri
        $existingProfession = Profession::where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($existingProfession) {
            return redirect()->route('admin.profession')->with('error', 'Maaf, profesi sudah digunakan.');
        }

        // Update data tools
        $profession->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.profession')->with('success', 'Profesi berhasil diubah.');
    }

    public function delete($id)
    {
        $profession = Profession::findOrFail($id);
        $profession->delete();

        return redirect()->route('admin.profession')->with('success', 'Profesi berhasil dihapus');
    }
}
