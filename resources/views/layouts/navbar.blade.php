<nav class="navbar navbar-expand-lg bg-white border-bottom ">
    <div class="container-fluid">
      <a class="navbar-brand text-dark fw-bold" href="#">MyApp</a>
      <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link text-white {{ request()->routeIs('user.index') ? 'fw-bold' : '' }}" href="{{ route('user.index') }}">
              Users
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
