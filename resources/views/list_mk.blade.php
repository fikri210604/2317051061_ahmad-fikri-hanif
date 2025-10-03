@extends('layouts.app')

@section('content')
  <div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">📚 Daftar Mata Kuliah</h1>

    <!-- Tombol Tambah -->
    <div class="mb-4 text-right">
      <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalTambah"
        style="background: #ffcc00;">
        + Tambah Mata Kuliah
      </button>
    </div>

    <div id="tableData" class="overflow-x-auto bg-white shadow-lg rounded-lg">
      <table class="min-w-full text-sm text-left text-gray-600">
        <thead class="bg-[#ffcc00] text-white text-center">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">Nama Mata Kuliah</th>
            <th class="px-6 py-3">SKS</th>
            <th class="px-6 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody id="mkTableBody" class="text-center">
          @foreach ($mks as $mk)
            <tr class="border-b hover:bg-indigo-50 transition">
              <td class="px-6 py-4 font-medium text-gray-800">{{ $mk->id }}</td>
              <td class="px-6 py-4">{{ $mk->nama_mk }}</td>
              <td class="px-6 py-4">{{ $mk->sks }}</td>
              <td class="px-6 py-4">
                <div class="flex justify-center gap-2">
                  <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $mk->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $mk->id }}">
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
        <form action="{{ route('matakuliah.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="background-color: #ffcc00;">
            <h5 class="modal-title">Tambah Mata Kuliah</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Mata Kuliah</label>
              <input type="text" name="nama_mk" class="form-control" required>
              @error('nama_mk')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Jumlah SKS</label>
              <input type="number" name="sks" class="form-control" required>
              @error('sks')
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
  @foreach ($mks as $mk)
    <div class="modal fade" id="modalEdit{{ $mk->id }}" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content @if ($errors->any() && session('error_edit_id') == $mk->id) shake @endif">
          <form action="{{ route('matakuliah.update', $mk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header" style="background-color: #ffcc00;">
              <h5 class="modal-title">Edit Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_mk" class="form-control" value="{{ $mk->nama_mk }}" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Jumlah SKS</label>
                <input type="number" name="sks" class="form-control" value="{{ $mk->sks }}" required>
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
  @foreach ($mks as $mk)
    <div class="modal fade" id="modalDelete{{ $mk->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('matakuliah.destroy', $mk->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-header" style="background-color: #ffcc00;">
              <h5 class="modal-title">Hapus Mata Kuliah</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus mata kuliah <b>{{ $mk->nama_mk }}</b>?
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
