@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📋 Daftar Mahasiswa</h1>

    <!-- Form Search & Filter -->
    <div class="mb-4 mr-2">
      <form id="searchForm" class="row g-2 align-items-center">
        <div class="col-md-5">
          <input type="text" name="search" id="search" class="form-control" placeholder="Cari berdasarkan Nama atau NIM">
        </div>
        <div class="col-md-5">
          <select name="kelas_id" id="kelas_id" class="form-select">
            <option value="">-- Semua Kelas --</option>
            @foreach ($kelas as $k)
              <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
            @endforeach
          </select>
        </div>
        <!-- Tombol Tambah -->
        <div class="col-md">
          <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalTambah"
            style="background: #ffcc00;">
            + Tambah Murid
          </button>
        </div>
      </form>
    </div>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div id="tableData" class="overflow-x-auto bg-white shadow-lg rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-600">
        <thead class="bg-[#ffcc00] text-white text-center">
          <tr>
            <th class="px-6 py-3">Nomor</th>
            <th class="px-6 py-3">Nama</th>
            <th class="px-6 py-3">NIM</th>
            <th class="px-6 py-3">Kelas</th>
            <th class="px-6 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody id="userTableBody" class="text-center">
          @foreach ($users as $u)
            <tr class="border-b hover:bg-indigo-50 transition">
              <td class="px-6 py-4 font-medium text-gray-800">{{ $loop->iteration }}</td>
              <td class="px-6 py-4">{{ $u->nama_mahasiswa }}</td>
              <td class="px-6 py-4">{{ $u->nim }}</td>
              <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full text-white bg-indigo-500">
                  {{ $u->kelas->nama_kelas ?? '-' }}
                </span>
              </td>
              <td class="px-6 py-4">
                <div class="flex justify-center gap-2">
                  <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $u->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $u->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
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
      <div class="modal-content @if($errors->any() && !session('error_edit_id')) shake @endif">
        <form action="{{ route('user.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="background-color: #ffcc00;">
            <h5 class="modal-title">Tambah Pengguna</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="nama_mahasiswa" class="form-control" required>
              @error('nama_mahasiswa')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">NIM</label>
              <input type="text" name="nim" class="form-control" required>
              @error('nim')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <select name="kelas_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                  <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
              </select>
              @error('kelas_id')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            @if (session('error'))
              <span class="text-danger">{{ session('error') }}</span>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  @foreach ($users as $u)
    <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" @if ($errors->any()) shake @endif>
          <form action="{{ route('user.update', $u->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header" style="background-color: #ffcc00;">
              <h5 class="modal-title">Edit Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_mahasiswa" class="form-control" value="{{ $u->nama_mahasiswa }}" required>
                @error('nama_mahasiswa')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">NPM</label>
                <input type="text" name="nim" class="form-control" value="{{ $u->nim }}" required>
                @error('nim')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="kelas_id" class="form-select" required>
                  <option value="">-- Pilih Kelas --</option>
                  @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ $k->id == $u->kelas_id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                  @endforeach
                </select>
                @error('kelas_id')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
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
            <div class="modal-header" style="background-color: #ffcc00;">
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
  
  @if ($errors->any())
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      @if (session('error_edit_id'))
        var editModal = new bootstrap.Modal(
          document.getElementById('modalEdit{{ session('error_edit_id') }}')
        );
        editModal.show();
      @else
        var tambahModal = new bootstrap.Modal(
          document.getElementById('modalTambah')
        );
        tambahModal.show();
      @endif
    });
  </script>
@endif
