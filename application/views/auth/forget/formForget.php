<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forget Password</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- CDN Bootstrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!-- link css-->
        <link rel="stylesheet" href="<?php echo base_url('assets/css/auth/forget.css')?>">
    </head>
  <body>

    <div class="bg">
        <div class="containerr">
            <h2 class="judul fw-bold">Forget Password</h2> 
            <div class="fomulir">
                <form action="<?php echo base_url("Auth/prosesForget")?>" method="post">

                    <div class="inputan">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" name="password" id="" placeholder ="example@gmail.com">
                    </div>
                    <small class="pesan"><?php echo form_error('password'); ?></small>

                    <div class="inputan">
                        <i class="bi bi-lock"></i>
                        <input type="password" name="confrim" id="" placeholder ="example@gmail.com">
                    </div>
                    <small class="pesan"><?php echo form_error('confrim'); ?></small>
    
                    <div class="btn_login">
                        <button type="submit" class="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>