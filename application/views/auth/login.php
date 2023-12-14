
    <div class="bg">
        <div class="containerr">
            <h2 class="judul fw-bold">Login Form</h2>
             <!-- menampilkan pesan -->
                <?php
                    $pesan = $this->session->flashdata('pesan');
                    $error = $this->session->flashdata('error');

                    if(isset($pesan)){
                        echo '<div class="alert alert-success alert-dismissible fade show mt-3 rounded-2 mx-4" role="alert">
                        <strong>'.$pesan.'</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    $this->session->unset_userdata('pesan');
                    }

                    if(isset($error)){
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3  mx-4 rounded-2" role="alert">
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

