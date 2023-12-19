  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="<?= base_url()?>assets/img/favicon/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class=" text-primary font-weight-bold">BALI JOB FINDER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-1 mb-1 d-flex">
        <div class="image">
          <!-- <img src="<?php echo base_url()?>assets/img/dashboard/profile.png" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <div class="dropdown">
  <!-- <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $session?> -->
  <!-- </button> -->
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-header">DAFTAR LAMARAN</li>
          <li class="nav-item">
            <a href="<?= base_url('perusahaan/management')?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Lamaran
              </p>
            </a>
          </li>

          <li class="nav-header">LOWONGAN PEKERJAAN</li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-suitcase"></i>
              <p>
                Melamar Pekerjaan
              </p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                KELOLA LOWONGAN
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Lowongan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Lowongan</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- <li class="nav-header">MY PROFIL</li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil User
              
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-arrow-left"></i>
              <p>
                Log Out
              
              </p>
            </a>
          </li> -->

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>