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
        return view('list_mk', $data);
    }

    public function create(){
        return view('create_mk',[
            'title' => 'Create Mata Kuliah']);
    }

    public function store(){
        MataKuliah::create([
           'nama_mk' => request('nama_mk'),
           'sks' => request('sks')
        ]);
        return redirect()->to('/mata-kuliah');
    }

    public function update(){
    }

    public function destroy($id){
        MataKuliah::find($id)->delete();
        return redirect()->to('/mata-kuliah');
    }
}
