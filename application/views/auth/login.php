
    <div class="bg">
        <img src="<?php echo base_url("assets/img/auth/2.svg")?>" alt="" class="gambar_atas">
        
        <div class="login">
            <div class="containerr">
                <h2 class="judul fw-bold">Login Form</h2>
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

        <img src="<?php echo base_url("assets/img/auth/1.svg")?>" alt="" class="gambar_bawah">
    </div>

