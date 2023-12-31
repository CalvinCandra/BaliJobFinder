
    <div class="bg">
        <div class="containerr">
            <h2 class="judul fw-bold">Forget Password</h2> 
            <!-- menampilkan error -->
            <?php
                    $pesan = $this->session->flashdata('pesan');
                    $error = $this->session->flashdata('error');

                    if(isset($pesan)){
                        echo '<div class="alert alert-success alert-dismissible fade show mt-3 mx-3 rounded-2" role="alert">
                        <strong>'.$pesan.'</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    $this->session->unset_userdata('pesan');
                    }

                    if(isset($error)){
                        echo '<div class="alert alert-danger alert-dismissible fade show mt-3 mx-3 rounded-2" role="alert">
                        <strong>'.$error.'</strong>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    $this->session->unset_userdata('error');
                    }
                ?>
            <div class="fomulir">
                <form action="<?php echo base_url("Auth/KirimEmailPassForget")?>" method="post">

                    <div class="inputan">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" name="email" id="" placeholder ="example@gmail.com" value="<?php echo set_value('email')?>">
                    </div>
                    <small class="pesan"><?php echo form_error('email'); ?></small>
    
                    <div class="btn_login">
                        <a href="<?php echo base_url('Auth')?>" class="back">Back</a>
                        <button type="submit" class="submit">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
