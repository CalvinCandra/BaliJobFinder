<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- CDN Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!-- link css-->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/auth/login.css')?>">
    </head>
  <body>

    <div class="bg">
        <div class="container">
            <h2 class="judul fw-bold">Login Form</h2>
             <!-- menampilkan pesan -->
                <?php
                    $pesan = $this->session->flashdata('pesan');
                    $error = $this->session->flashdata('error');

                    if(isset($pesan)){
                        echo '<div class="alert alert-success alert-dismissible fade show mt-3 rounded-2" role="alert">
                        <strong>'.$pesan.'</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    $this->session->unset_userdata('pesan');
                    }

                    if(isset($error)){
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3 rounded-2" role="alert">
                        <strong>'.$error.'</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    $this->session->unset_userdata('error');
                    }
                ?>
            <div class="fomulir">
                <form action="<?php echo base_url("Auth/proses_login")?>" method="post">

                    <div class="inputan">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" name="email" id="" placeholder ="example@gmail.com" value="<?php echo set_value('email')?>">
                    </div>
                    <small class="pesan"><?php echo form_error('email'); ?></small>
    
                    <div class="inputan">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" name="password" id="" placeholder="***********">
                    </div>
                    <small class="pesan"><?php echo form_error('password'); ?></small>

                    <div class="bungkusForget">
                        <a href="<?php echo base_url("Auth/VForget")?>" class="forget">Forget Password?</a>
                    </div>
    
                    <div class="btn_login">
                        <button type="submit" name="login">Login Now</button>
                    </div>
                </form>
                <div class="ke_register">
                    <p>Don't Have an Account yet? <a href="<?php echo base_url("Auth/register_pilihan")?>">Register</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>