  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="<?php echo base_url("assets/img/favicon/icon.png") ?>" alt="AdminLTE Logo" class="brand-image img-circle"
           style="opacity: .8">
      <span class="brand-text text-primary font-weight-bold">BALI JOB FINDER</span>
    </a>

    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-4">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="<?= base_url('perusahaan/home') ?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          
          <li class="nav-header">LOWONGAN KERJA</li>
          <li class="nav-item">
            <a href="<?= base_url('perusahaan/management') ?>" class="nav-link">
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
          <li class="nav-header">PELAMAR KERJA</li>
          <li class="nav-item">
            <a href="<?= base_url('perusahaan/lamaran') ?>" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Daftar Pelamar
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- <script>
  document.addEventListener("DOMContentLoaded", function() {
    var navLinks = document.querySelectorAll(".nav-link");

    // Add click event listener to each navigation link
    navLinks.forEach(function(link) {
      link.addEventListener("click", function() {
        // Remove "active" class from all links
        navLinks.forEach(function(navLink) {
          navLink.classList.remove("active");
        });

        // Add "active" class to the clicked link
        this.classList.add("active");
      });

      // Check if the link's href matches the current URL
      if (link.href === window.location.href) {
        link.classList.add("active");
      }
    });
  });
  </script> -->

