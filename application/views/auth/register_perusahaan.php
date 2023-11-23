<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
     <!-- link css-->
     <link rel="stylesheet" href="<?php echo base_url('assets/css/auth/register.css')?>">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="gambar_kotak">
            <img src="<?php echo base_url("assets/img/auth/register_perusahaan.png")?>" alt="">
        </div>

        <div class="fomulir">
            <h2 class ="judul">Register Form</h2>
            <form action="<?php echo base_url('Auth/register_perusahaan')?>" method="post">
                <div class="inputan">
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" name="email" id="" placeholder="example@gmail.com">
                </div>
                <small class="pesan"><?php echo form_error('email'); ?></small>

                <div class="inputan">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" name="name" id="" placeholder="Name Company">
                </div>
                <small class="pesan"><?php echo form_error('name'); ?></small>

                <div class="inputan">
                    <i class="bi bi-telephone-fill"></i>
                    <input type="number" name="no_hp" id="" min="0" placeholder="Phone Number Company">
                </div>
                <small class="pesan"><?php echo form_error('no_hp'); ?></small>

                <div class="inputan">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="password" id="" placeholder="Password">
                </div>
                <small class="pesan"><?php echo form_error('password'); ?></small>

                <div class="inputan">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="confrim" id="" placeholder="Confrim Password">
                </div>
                <small class="pesan"><?php echo form_error('confrim'); ?></small>

                <div class="btn_register">
                    <button type="submit">Register Now</button>
                </div>
            </form>
            <div class="ke_login">
                <p>Already have an  account? <a href="<?php echo base_url("Auth/login")?>">Login</a></p>
            </div>
            
        </div>
    </div>
    
</body>
</html>