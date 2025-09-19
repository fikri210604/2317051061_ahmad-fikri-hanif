<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <title>Profile</title>
</head>
<body class="font-[Poppins] min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-700 via-yellow-300 to-white">

  <!-- Card -->
  <div class="bg-white/30 backdrop-blur-lg shadow-xl rounded-2xl w-full max-w-md p-8">

    <!-- Avatar -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('images/Template Id Card Panitia.png') }}"
           class="rounded-full w-28 h-28 border-4 border-white shadow-md object-cover"
           alt="Foto Profil">
    </div>

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-white text-center mb-6 drop-shadow-md">Profil Saya</h2>

    <!-- Data profil -->
    <div class="space-y-4 text-gray-800">
      <div>
        <label class="block text-sm font-semibold text-white mb-1">Nama</label>
        <input type="text" readonly value="{{ $nama }}"
               class="w-full px-3 py-2 rounded-lg bg-white/70 text-gray-800 shadow-inner focus:outline-none">
      </div>

      <div>
        <label class="block text-sm font-semibold text-white mb-1">NPM</label>
        <input type="text" readonly value="{{ $npm }}"
               class="w-full px-3 py-2 rounded-lg bg-white/70 text-gray-800 shadow-inner focus:outline-none">
      </div>

      <div>
        <label class="block text-sm font-semibold text-white mb-1">Kelas</label>
        <input type="text" readonly value="{{ $kelas }}"
               class="w-full px-3 py-2 rounded-lg bg-white/70 text-gray-800 shadow-inner focus:outline-none">
      </div>

    </div>

    <!-- Tombol -->
    <div class="mt-6 flex justify-center">
      <button class="px-6 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold shadow-md hover:scale-105 transition transform">
        Edit Profil
      </button>
    </div>
  </div>

</body>
</html>
