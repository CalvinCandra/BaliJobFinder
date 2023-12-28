  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="<?php echo base_url("assets/img/favicon/icon.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-bold">BALI JOB FINDER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?= base_url('admin/home') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-header"> KELOLA LOWONGAN </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/dataLowongan') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Management Lowongan
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
          
        <!-- Nav Item - Daftar User -->
        <li class="nav-header"> KELOLA AKUN </li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Daftar User
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <!-- Submenu Admin  -->
        <li class="nav-item">
            <a href="<?= base_url('admin/dataPerusahaan') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Perusahaan</p>
            </a>
        </li>
        <!-- Submenu Pelamar -->
        <li class="nav-item">
            <a href="<?= base_url('admin/dataPelamar') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pelamar</p>
            </a>
        </li>
    </ul>
</li>


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">DATA AKUN:</h6>
                        <a class="collapse-item" href="../admin/akun_admin.php">Admin</a>
                        <a class="collapse-item" href="../admin/akun_penyedia.php">Penyedia</a>
                        <a class="collapse-item" href="../admin/akun_pelamar.php">Pelamar</a>
                    </div>
                </div>
            </li>

       
         

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>