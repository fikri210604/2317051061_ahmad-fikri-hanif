@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📋 Daftar Pengguna</h1>

    <!-- 🔍 Form Search & Filter -->
    <div class="mb-4">
      <form id="searchForm" class="row g-2 align-items-center">
        <div class="col-md-6">
          <input type="text" name="search" id="search" class="form-control" placeholder="Cari berdasarkan Nama atau NIM">
        </div>
        <div class="col-md-4">
          <select name="kelas_id" id="kelas_id" class="form-select">
            <option value="">-- Semua Kelas --</option>
            @foreach ($kelas as $k)
              <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
            @endforeach
          </select>
        </div>
        <!-- Tombol Tambah -->
        <div class="col-md-2">
          <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#modalTambah"
            style="background: linear-gradient(to right, #6366F1, #A855F7);">
            + Tambah Murid
          </button>
        </div>
      </form>
    </div>


    <!-- 📋 Tabel hasil -->
    <div id="tableData" class="overflow-x-auto bg-white shadow-lg rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-600">
        <thead class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">Nama</th>
            <th class="px-6 py-3">NIM</th>
            <th class="px-6 py-3">Kelas</th>
            <th class="px-6 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody id="userTableBody">
          @foreach ($users as $u)
            <tr class="border-b hover:bg-indigo-50 transition">
              <td class="px-6 py-4 font-medium text-gray-800">{{ $u->id }}</td>
              <td class="px-6 py-4">{{ $u->nama_mahasiswa }}</td>
              <td class="px-6 py-4">{{ $u->nim }}</td>
              <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full text-white bg-indigo-500">
                  {{ $u->kelas->nama_kelas ?? '-' }}
                </span>
              </td>
              <td class="px-6 py-4 space-x-2">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $u->id }}">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $u->id }}">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>

          @endforeach
        </tbody>
      </table>

    </div>


  </div>


  <!-- Modal Tambah -->
  <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('user.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Tambah Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="nama_mahasiswa" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">NIM</label>
              <input type="text" name="nim" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select name="kelas_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                  <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  @foreach ($users as $u)
    <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="{{ route('user.update', $u->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title">Edit Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_mahasiswa" class="form-control" value="{{ $u->nama_mahasiswa }}" required>
              </div>
              <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $u->nim }}" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="kelas_id" class="form-select" required>
                  <option value="">-- Pilih Kelas --</option>
                  @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ $k->id == $u->kelas_id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach

  <!-- Modal Hapus -->
  @foreach ($users as $u)
    <div class="modal fade" id="modalDelete{{ $u->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('user.delete', $u->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header">
              <h5 class="modal-title">Hapus Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus pengguna ini?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endforeach
@endsection