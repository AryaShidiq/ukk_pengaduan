<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="javascript:void(0)"><img src="{{asset('images/logo.svg')}}" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="javascript:void(0)"><img src="{{asset('images/logo-mini.svg')}}" alt="logo" /></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{asset('images/faces/user.jpg')}}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{auth()->guard('admin')->user()->nama_petugas}}</h5>
            <span>Role : {{auth()->guard('admin')->user()->level}}</span>
          </div>
        </div>
        <a href="#" class="text-warning" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-pencil"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="{{url('control/myaccount')}}" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('control')}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#table" aria-expanded="false" aria-controls="table">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Tables</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="table">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('category')}}"> Category </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('pengaduan')}}"> Pengaduan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('tanggapan')}}"> Tanggapan </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('control/petugas')}}"> Petugas </a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('masyarakat')}}"> Masyarakat </a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>