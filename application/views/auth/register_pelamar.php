
    <div class="containerr">

        <div class="gambar_kotak">
            <img src="<?php echo base_url("assets/img/auth/Pelamar Regis 1.png")?>" alt="" style="width:80%; margin-right:-80px;">
        </div>

        <div class="fomulir">

            <h2 class ="judul">Register Form</h2>
            <form action="<?php echo base_url("Auth/register_pelamar")?>" method="post">
                <div class="inputan">
                    <i class="bi bi-envelope-fill"></i>
                    <input type="email" name="email" id="" placeholder="example@gmail.com" value="<?php echo set_value('email')?>">
                </div>
                <small class="pesan"><?php echo form_error('email'); ?></small>
                

                <div class="inputan">
                    <i class="bi bi-person-fill"></i>
                    <input type="text" name="name" id="" placeholder="Nama Lengkap" value="<?php echo set_value('name')?>">
                </div>
                <small class="pesan"><?php echo form_error('name'); ?></small>
        
                <div class="inputan">
                    <i class="bi bi-lock-fill"></i>
                    <input type="password" name="password" id="" placeholder="Password">
                </div>
                <small class="pesan"><?php echo form_error('password'); ?></small>

                <div class="inputan">
                    <i class="bi bi-lock"></i>
                    <input type="password" name="confrim" id="" placeholder="Konfrimasi Password">
                </div>
                <small class="pesan"><?php echo form_error('confrim'); ?></small>

                <div class="btn_register">
                    <button type="submit">Register</button>
                </div>
            </form>
            <div class="ke_login">
                <p>Sudah Punya Akun? <a href="<?php echo base_url("Auth/login")?>">Login</a></p>
            </div>
            
        </div>
    </div>
