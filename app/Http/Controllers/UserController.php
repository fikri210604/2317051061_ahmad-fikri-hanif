<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class UserController extends Controller
{
    public $user;
    public $kelas;
    public function __construct()
    {
        $this->user = new User();
        $this->kelas = new Kelas();
    }
    public function index(Request $request)
    {
        $query = User::with('kelas');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_mahasiswa', 'like', '%' . $request->search . '%')
                    ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $users = $query->get();
        $kelas = Kelas::all();

        if ($request->ajax()) {
            return response()->json(['users' => $users]);
        }

        return view('list_user', compact('users', 'kelas'));
    }



    public function create()
    {
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();

        $data = [
            'title' => 'User',
            'kelas' => $kelas
        ];

        return view('user.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255|unique:user,nama_mahasiswa',
            'nim' => 'required|string|unique:user,nim',
            'kelas_id' => 'required|integer'
        ]);

        $this->user->create([
            'nama_mahasiswa' => $request->input('nama_mahasiswa'),
            'nim' => $request->input('nim'),
            'kelas_id' => $request->input('kelas_id')
        ]);

        return redirect('/user')->with('success', 'User berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'nama_mahasiswa' => 'required|string|max:255|unique:user,nama_mahasiswa,' . $id,
            'nim' => 'required|string|unique:user,nim,' . $id,
            'kelas_id' => 'required|integer'
        ]);
        $user = User::find($id);
        $user->update([
            'nama_mahasiswa' => $request->input('nama_mahasiswa'),
            'nim' => $request->input('nim'),
            'kelas_id' => $request->input('kelas_id')
        ]);
        return redirect('/user')->with('success', 'User berhasil diupdate');
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }


}
