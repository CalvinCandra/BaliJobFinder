<div class="bg">
    <img src="<?php echo base_url("assets/img/auth/2.svg")?>" alt="" class="gambar_atas">

        <div class="forgetPass">
            <div class="containerr">
                <h2 class="judul fw-bold">Forget Password</h2> 
                <div class="fomulir">
                    <form action="<?php echo base_url("Auth/prosesForget")?>" method="post">
                        <input type="hidden" name="users" value="<?= $users?>">

                        <div class="inputan">
                            <i class="bi bi-lock-fill"></i>
                            <input type="password" name="password" id="" placeholder ="********">
                        </div>
                        <small class="pesan"><?php echo form_error('password'); ?></small>
        
                        <div class="inputan">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="confrim" id="" placeholder ="********">
                        </div>
                        <small class="pesan"><?php echo form_error('confrim'); ?></small>
            
                        <div class="btn_forget">
                            <button type="submit" class="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <img src="<?php echo base_url("assets/img/auth/1.svg")?>" alt="" class="gambar_bawah">
</div>

    