<div x-data="{ open: true }" class="flex">
  <div class="flex flex-col bg-white border-r border-gray-200 transition-all duration-300"
       :style="open ? 'width:220px' : 'width:60px'" style="height: 100vh;">

    <div class="flex items-center justify-between p-3">
      <a href="/" class="flex items-center text-gray-800 no-underline" x-show="open" x-transition>
        <i class="bi bi-grid text-xl me-2"></i>
        <span class="text-lg font-bold">Dashboard</span>
      </a>
      <button @click="open = !open" class="btn btn-outline-secondary p-1">
        <i class="bi" :class="open ? 'bi-chevron-left' : 'bi-chevron-right'"></i>
      </button>
    </div>

    <hr class="border-gray-300">

    <!-- Menu -->
    <ul class="nav flex-column space-y-1">
      <li class="nav-item">
        <a href="{{ route('user.index') }}"
           class="flex items-center px-3 py-2 rounded-md
                  {{ request()->routeIs('user.index')
                      ? 'bg-[#ffcc00] text-white'
                      : 'bg-white text-gray-800 hover:bg-[#ffcd00] hover:text-white' }}">
          <i class="bi bi-people me-2"></i>
          <span x-show="open" x-transition>Mahasiswa</span>
        </a>
      </li>
      <li>
        <a href="{{ route('matakuliah.index') }}"
           class="flex items-center px-3 py-2 rounded-md
                  {{ request()->routeIs('matakuliah.index')
                      ? 'bg-[#ffcc00] text-white'
                      : 'bg-white text-gray-800 hover:bg-[#ffcf00] hover:text-white' }}">
          <i class="bi bi-box me-2"></i>
          <span x-show="open" x-transition>Mata Kuliah</span>
        </a>
      </li>
      <li>
        <a href="#"
           class="flex items-center px-3 py-2 rounded-md
                  {{ request()->is('settings*')
                      ? 'bg-[#ffcc00] text-white'
                      : 'bg-white text-gray-800 hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 hover:text-white' }}">
          <i class="bi bi-gear me-2"></i>
          <span x-show="open" x-transition>Settings</span>
        </a>
      </li>
    </ul>

    <hr class="border-gray-300">

    <!-- Dropdown Admin -->
    <div class="dropdown mt-auto px-3 py-2">
      <a href="#" class="flex items-center bg-white rounded-md text-gray-800 dropdown-toggle"
         data-bs-toggle="dropdown">
        <img src="https://ui-avatars.com/api/?name=User" alt=""
             class="rounded-full me-2" width="32" height="32">
        <span x-show="open" x-transition><strong>Admin</strong></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="#">Logout</a></li>
      </ul>
    </div>
  </div>
</div>
