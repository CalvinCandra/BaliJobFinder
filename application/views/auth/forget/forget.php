
    <div class="bg">
        <img src="<?php echo base_url("assets/img/auth/2.svg")?>" alt="" class="gambar_atas">

        <div class="forget">
            <div class="containerr">
                <h2 class="judul fw-bold">Forget Password</h2> 
                <div class="fomulir">
                    <form action="<?php echo base_url("Auth/KirimEmailPassForget")?>" method="post">
    
                        <div class="inputan">
                            <i class="bi bi-envelope-fill"></i>
                            <input type="email" name="email" id="" placeholder ="example@gmail.com" value="<?php echo set_value('email')?>">
                        </div>
                        <small class="pesan"><?php echo form_error('email'); ?></small>
        
                        <div class="btn_login">
                            <button type="submit" class="submit">Send Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <img src="<?php echo base_url("assets/img/auth/1.svg")?>" alt="" class="gambar_bawah">
    </div>
