<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon/icon.png')?>" type="image/x-icon">

     <!-- CDN Bootstrap Icon -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <!-- link css -->
    <link rel="stylesheet" href="<?php echo base_url("assets/css/landing/landing.css")?>">

    
    <title><?= $title?></title>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="pembungkus">
            <!-- logo -->
            <div class="logo">
                <img src="<?php echo base_url("assets/img/logo/blue_logo 1.png")?>" alt="Logo Bali Job Finder" srcset="">
            </div>

            <!-- navigasion menu -->
            <div class="list_menu">
                <a href="#home">Home</a>
                <a href="#lowongan">Lowongan</a>
                <a href="#contact">Contact</a>
            </div>

            <!-- navidasion action -->
            <div class="auth">
                <!-- melakukan pengecekan jika ada session -->
                <?php 
                    if($session_name === NULL){
                ?>
                    <a href="<?php echo base_url("Auth/login")?>" class="btn">Login</a>
                    <a href="<?php echo base_url("Auth/register_pilih")?>" class="btn">Register</a>
                <?php 
                    }else{
                ?>
                    <a class="name_session"><?php echo $session_name?></a>
                    <div class="menu_dropdown">
                        <!-- cek role -->
                        <?php 
                            if($role == 'pelamar'){
                        ?>
                            <li><a href="<?php echo base_url('Pelamar')?>">Dashboard</a></li>
                        <?php 
                            }elseif($role == 'perusahaan'){
                        ?>
                            <li><a href="<?php echo base_url('Perusahaan')?>">Dashboard</a></li>
                                
                        <?php 
                            }else{
                        ?>
                            <li><a href="<?php echo base_url('Admin')?>">Dashboard</a></li>
                        <?php } ?>

                        <li><a href="<?php echo base_url('Auth/logout')?>">Logout</a></li>
                    </div>
                <?php } ?>
            </div>

            <a class="toogle"><i class="bi bi-list"></i></a>
        </div>

        <div class="dropdown">
            <!-- cek session kembali -->
            <?php 
                 if($session_name === NULL){
            ?>
                <li class="ngelist"><a href="#home" class="link">Home</a></li>
                <li class="ngelist"><a href="#lowongan" class="link">Lowongan</a></li>
                <li class="ngelist"><a href="#contact" class="link">Contact</a></li>
                <li><a href="<?php echo base_url("Auth/login")?>" class="btn">Login</a></li>
                <li><a href="<?php echo base_url("Auth/register_pilih")?>" class="btn">Register</a></li>
            <?php 
                }else{
            ?>
                <li class="ngelist"><a href="#home" class="link">Home</a></li>
                <li class="ngelist"><a href="#lowongan" class="link">Lowongan</a></li>
                <li class="ngelist"><a href="#contact" class="link">Contact</a></li>
                <div>
                    <!-- cek role -->
                    <?php 
                        if($role == 'pelamar'){
                    ?>
                        <li><a href="<?php echo base_url('Pelamar')?>">Dashboard</a></li>
                    <?php 
                        }elseif($role == 'perusahaan'){
                    ?>
                        <li><a href="<?php echo base_url('Perusahaan')?>">Dashboard</a></li>
                                
                    <?php 
                        }else{
                    ?>
                        <li><a href="<?php echo base_url('Admin')?>">Dashboard</a></li>
                    <?php } ?>
                        <li><a href="<?php echo base_url('Auth/logout')?>">Logout</a></li>
                </div>
            <?php } ?>
        </div>



    </nav>

    <!-- end navbar -->