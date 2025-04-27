<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Majest</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('dist/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{asset('dist/assets/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('dist/assets/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('dist/assets/images/favicon.ico')}}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../../assets/images/logo.svg"
          alt="logo" /></a>
      <a class="navbar-brand brand-logo-white" href="../../index.html"><img src="../../../assets/images/logo-white.svg"
          alt="logo" /></a>
      <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../../assets/images/logo-mini.svg"
          alt="logo" /></a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-sort-variant"></span>
      </button>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav me-lg-4 w-100">
      <li class="nav-item nav-search d-none d-lg-block w-100">
        @yield('breadcumb')
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">

      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="../../../assets/images/faces/face5.jpg" alt="profile" />
          <span class="nav-profile-name">Louis Barnett</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="mdi mdi-cog text-primary"></i>
            Settings
          </a>
          <a class="dropdown-item">
            <i class="mdi mdi-logout text-primary"></i>
            Logout
          </a>
        </div>
      </li>
      {{-- <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="mdi mdi-apps"></i>
        </a>
      </li> --}}
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{request()->is('dashboard') ? 'active' : ' '}}" >
      <a class="nav-link">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{request()->is('barangmasuk*') ? 'active' : ' '}}">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="mdi mdi mdi-basket-fill menu-icon"></i>
        <span class="menu-title">Barang Masuk</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/barangmasuk/create">Input Barang Masuk</a></li>
          <li class="nav-item"> <a class="nav-link" href="/barangmasuk">Daftar Barang Masuk</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{request()->is('barangkeluar*') ? 'active' : ' '}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#barang-keluar" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi mdi-basket-unfill menu-icon"></i>
          <span class="menu-title">Barang Keluar</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="barang-keluar">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/barangkeluar/create">Input Barang Keluar</a></li>
            <li class="nav-item"> <a class="nav-link" href="/barangkeluar">Daftar Barang Keluar</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item {{request()->is('stok*') ? 'active' : ' '}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#stok-barang" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-server menu-icon"></i>
          <span class="menu-title">Stok Barang</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="stok-barang">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/stok/create">Input Barang Baru</a></li>
            <li class="nav-item"> <a class="nav-link" href="/stok">Daftar Stok Barang</a></li>
          </ul>
        </div>
      </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="mdi mdi-account menu-icon"></i>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/blank-page.html"> Blank Page </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-404.html"> 404 </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/error-500.html"> 500 </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/login.html"> Login </a></li>
          <li class="nav-item"> <a class="nav-link" href="../../pages/samples/register.html"> Register </a></li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Heri Julianto © 2025</span>
    <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Tugas test junior web development <i
        class="mdi mdi-heart text-danger"></i></span>
  </div>
</footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script src="{{asset('dist/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('dist/assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
  <script src="{{asset('dist/assets/vendors/select2/select2.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('dist/assets/js/off-canvas.js')}}"></script>
  <script src="{{asset('dist/assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('dist/assets/js/template.js')}}"></script>
  <script src="{{asset('dist/assets/js/settings.js')}}"></script>
  <script src="{{asset('dist/assets/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('dist/assets/js/file-upload.js')}}"></script>
  <script src="{{asset('dist/assets/js/typeahead.js')}}"></script>
  <script src="{{asset('dist/assets/js/select2.js')}}"></script>
  <!-- End custom js for this page-->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectKriteria = document.getElementById('selectkriteria');
        const tanggalGroup = document.getElementById('tanggalmasukgroup');
        const kodebarangGroup = document.getElementById('kodebaranggroup');

        function toggleInput() {
            if (selectKriteria.value === 'date') {
                tanggalGroup.style.display = 'block';
                kodebarangGroup.style.display = 'none';
            } else if (selectKriteria.value === 'kodebarang') {
                tanggalGroup.style.display = 'none';
                kodebarangGroup.style.display = 'block';
            }
        }

        // Panggil saat pertama kali halaman dimuat
        toggleInput();

        // Panggil setiap kali select berubah
        selectKriteria.addEventListener('change', toggleInput);
    });
    </script>


</body>

</html>
