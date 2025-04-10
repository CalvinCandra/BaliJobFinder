
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <?php foreach ($perusahaan->result_array() as $key): ?>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <div class="user-panel d-flex">
        <div class="position-relative rounded-circle overflow-hidden border" style="height:35px; width:35px;">
                    <?php if ($key['logo']): ?>
                        <img src="<?php echo base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" class="elevation-1 d-flex align-items-center justify-content-center" alt="User Image" style="width:100%; background-size:cover;">
                    <?php else: ?>
                        <img src="<?php echo base_url('assets/img/dashboard/profile.png');?>" class="elevation-1 d-flex align-items-center justify-content-center" alt="User Image" style="width:100%; background-size:cover;">
                    <?php endif; ?>
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
        <a href="<?= base_url('perusahaan/profile') ?>" class="dropdown-item">Profile User</a>
        <a href="<?= base_url('Balijobfinder') ?>" class="dropdown-item">Landing Page</a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url("Auth/logout")?>" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
<?php endforeach ?>
  <!-- /.navbar -->