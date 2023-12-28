
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    

 <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <div class="user-panel d-flex">
        <div class="image">
            <img src="<?php echo base_url('assets/img/dashboard/profile.png');?>" class="img-circle elevation-1" alt="Default User Image">
          </div>
          <div class="info">
            <b><?php echo $session ?></b>
          </div>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">User Options</span>
        <!-- Add other dropdown items as needed -->
        <div class="dropdown-divider"></div>
        <a href="<?= base_url('Balijobfinder') ?>" class="dropdown-item">Landing Page</a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url("Auth/logout")?>" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
  <!-- /.navbar -->