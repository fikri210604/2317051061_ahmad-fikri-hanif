<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    public function index(){
        $data = [
          'title' => 'Mata Kuliah',
          'mks' => MataKuliah::all() 
        ];

        $totalSks = $data['mks']->sum('sks');
        $data['totalSks'] = $totalSks;
        return view('list_mk', $data);
    }

    public function create(){
        return view('create_mk',[
            'title' => 'Create Mata Kuliah']);
    }

    public function store(Request $request){
        $request->validate([
            'nama_mk' => 'required | alpha',
            'sks' => 'required | numeric | min:1 | max:3'
        ]);
        MataKuliah::create([
           'nama_mk' => request('nama_mk'),
           'sks' => request('sks')
        ]);
        return redirect()->to('/mata-kuliah')->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_mk' => 'required | alpha',
            'sks' => 'required | numeric | min:1 | max:3'
        ]);
        
        $mk = MataKuliah::findOrFail($id);
        $mk->update([
            'nama_mk' => $request->input('nama_mk'),
            'sks' => $request->input('sks')
        ]);
        
        return redirect()->to('/mata-kuliah')->with('success', 'Mata kuliah berhasil diupdate');
    }

    public function destroy($id){
        MataKuliah::findOrFail($id)->delete();
        return redirect()->to('/mata-kuliah');
    }


}
