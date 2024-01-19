
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
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

    <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <div class="user-panel d-flex" style="height:150%;">
        <div class="image">
                    <?php if(empty($foto_profile)): ?>
                      <img src="<?php echo base_url('assets/img/dashboard/profile.png');?>" class="img-circle elevation-1" alt="Default User Image">
                    <?php else: ?>
                       <img src="<?= base_url('assets/img/profile/pelamar/'.$foto_profile); ?>" class="img-circle elevation-1" alt="User Image">
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

        <?php if($cekData == 1 || $cekDataPendidikan == 1 || $cekDataPengalaman == 1 || $cekDataSkill == 1 ): ?>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#alert">Generate CV</a>
        <?php else:?>
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url("CV/GenerateCV")?>" class="dropdown-item" target="__blank" download>Generate CV</a>
        <?php endif;?>
        
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url("Auth/logout")?>" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
  <!-- /.navbar -->

<!-- Modal Alert -->
<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="tambahLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLowonganModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Upsss, Data Profile Kosong, Silahkan Di Isi
            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url("Pelamar/profile")?>" class="btn btn-success">Okey</a>
            </div>
        </div>
    </div>
</div>
