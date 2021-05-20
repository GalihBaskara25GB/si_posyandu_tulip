<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category">
      <span class="nav-link">Dashboard</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('home')}}">
        <span class="menu-title">Dashboard</span>
        <i class="icon-speedometer menu-icon"></i>
      </a>
    </li>
    @if(Auth::user()->isAdmin())
    <li class="nav-item nav-category"><span class="nav-link">Manajemen Data</span></li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('kaders.index')}}">
        <span class="menu-title">Data Kader</span>
        <i class="icon-people menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('users.index')}}">
        <span class="menu-title">Data User</span>
        <i class="icon-credit-card menu-icon"></i>
      </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="{{route('kaders.show', Auth::user()->kader->getKey())}}">
        <span class="menu-title">Data Saya</span>
        <i class="icon-docs menu-icon"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="{{route('kriterias.index')}}">
        <span class="menu-title">Data Kriteria</span>
        <i class="icon-layers menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('rangkings.index')}}">
        <span class="menu-title">Rangking</span>
        <i class="icon-chart menu-icon"></i>
      </a>
    </li>
    @else
    <li class="nav-item">
      <a class="nav-link" href="{{route('rangking')}}">
        <span class="menu-title">Rangking</span>
        <i class="icon-chart menu-icon"></i>
      </a>
    </li>
    @endif

  </ul>
</nav>