<?php

namespace App\Http\Controllers;

use App\Models\CalonAdmin;
use App\Http\Requests\StoreCalonAdminRequest;
use App\Http\Requests\UpdateCalonAdminRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CalonAdminController extends Controller
{
    public function index()
    {
        return view("pages.admin.camin.index", [
            "camin" => CalonAdmin::orderBy('no_urut')->get()
        ]);
    }

    // frontend
    public function camin()
    {
        $calon_admin = CalonAdmin::orderBy('no_urut')->get();
        return view('pages.public.voting', compact('calon_admin'));
    }
    public function vote_in(Request $request)
    {
        $camin_id = $request->input('c_admin_id');
        $camin = CalonAdmin::all();
        
        // dd($camin_id);
        return view('pages.public.vote_in', compact('camin'));
    }
    // fe end

    public function create()
    {
        return view("pages.admin.camin.create");
    }

    public function store(StoreCalonAdminRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('calon_admins', 'public');
        }

        CalonAdmin::create($data);

        return redirect()->route('camin.index')->with('success', 'Calon admin berhasil ditambahkan.');
    }

    public function show(CalonAdmin $calonAdmin)
    {
        //
    }

    public function edit(CalonAdmin $camin)
    {
        return view("pages.admin.camin.edit", compact('camin'));
    }

    public function update(UpdateCalonAdminRequest $request, CalonAdmin $camin)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            if ($camin->foto) {
                Storage::disk('public')->delete($camin->foto);
            }
            $data['foto'] = $request->file('foto')->store('calon_admins', 'public');
        } else {
            unset($data['foto']);
        }

        $camin->update($data);

        return redirect()->route('camin.index')->with('success', 'Calon admin berhasil diperbarui.');
    }

    public function destroy(CalonAdmin $camin)
    {
        if ($camin->foto) {
            Storage::disk('public')->delete($camin->foto);
        }

        $camin->delete();

        return redirect()->route('camin.index')->with('success', 'Calon admin berhasil dihapus.');
    }
}
