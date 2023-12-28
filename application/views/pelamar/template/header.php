
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <?php foreach ($profile->result_array() as $key): ?>
    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <div class="user-panel d-flex">
        <div class="image">
                    <?php if ($key['gambar']): ?>
                        <img src="<?php echo base_url($key['gambar']); ?>" class="img-circle elevation-1" alt="User Image">
                    <?php else: ?>
                        <img src="<?php echo base_url('assets/img/dashboard/profile.png');?>" class="img-circle elevation-1" alt="Default User Image">
                    <?php endif; ?>
          </div>
          <div class="info">
            <b><?= $session ?></b>
          </div>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">User Options</span>
        <!-- Add other dropdown items as needed -->
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url("pelamar/profile")?>" class="dropdown-item">Profile</a>
        <a href="<?php echo base_url("Balijobfinder")?>" class="dropdown-item">Landing Page</a>

        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url("CV/GenerateCV")?>" class="dropdown-item" target="__blank" download>Generate CV</a>
        
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url("Auth/logout")?>" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
<?php endforeach ?>
  <!-- /.navbar -->