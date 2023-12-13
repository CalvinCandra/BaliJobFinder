<!-- hero-section -->
<div class="hero-section">
    <div class="hero" id="home">
        <div class="konten-kanan">
            <h1 class="Judul">bali job finder</h1>
            <h5 class="pendukung">website pencari lowongan kerja terbaik!</h5>
            <a href="#lowongan" class="button">find now</a>
        </div>
        <div class="konten-kiri">
            <img src="<?php echo base_url('assets/img/landing/hero.png')?>" alt="img hero section">
        </div>
    </div>
</div>
<!-- end hero section -->


<!-- alasan -->
<h2 class="judul-alasan">Kenapa Bali Job Finder?</h2>

<div class="alasan-section">

    <div class="alasan">
        <div class="bungkus-alasan">
            <div class="gambar">
                <img src="<?php echo base_url("assets/img/landing/cv_generator.png")?>" alt="Gambar Alasan">
            </div>
            <div class="judul-card">
                <h5>CV Generator</h5>
            </div>
            <div class="text">
                <p>Buat CV dengan gampang dengan contoh CV yang dibuat secara otomatis oleh sistem</p>
            </div>            
        </div>

        <div class="bungkus-alasan">
            <div class="gambar">
                <img src="<?php echo base_url("assets/img/landing/search_lowongan.png")?>" alt="Gambar Alasan">
            </div>
            <div class="judul-card">
                <h5>Search Lowongan</h5>
            </div>
            <div class="text">
                <p>Mencari lowongan dengan mudah dan sesuai preferensi Anda  dengan beberapa detik </p>
            </div>            
        </div>

        <div class="bungkus-alasan">
            <div class="gambar">
                <img src="<?php echo base_url("assets/img/landing/detail_lowongan.png")?>" alt="Gambar Alasan">
            </div>
            <div class="judul-card">
                <h5>Detail Lowongan</h5>
            </div>
            <div class="text">
                <p>Dapat melihat detail lowongan yang jelas sesuai dengan kebutuhhan Anda</p>
            </div>            
        </div>
    </div>
</div>
<!-- end alasan -->

<!-- rekom -->
<h2 class="judul-rekom">Rekomendasi Perusahaan</h2>
<p class="pendukung-judul-rekom">Kami menyarankan beberapa perusahaan yang terbaik</p>

<div class="rekom-section">
    <div class="rekom-kotak">
        
        <div class="rekom">
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/blessing computer 2.png')?>" alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/khrisna oleh-oleh 1.png')?>"alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/The_keranjang 1.png')?>"alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/unique.png')?>"alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/blessing computer 2.png')?>" alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/khrisna oleh-oleh 1.png')?>"alt="Logo Perusahaan">
            </div>
        </div>
    
        <div class="rekom1">
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/blessing computer 2.png')?>" alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/khrisna oleh-oleh 1.png')?>"alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/The_keranjang 1.png')?>"alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/unique.png')?>"alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/blessing computer 2.png')?>" alt="Logo Perusahaan">
            </div>
            <div class="kotak">
                <img src="<?php echo base_url('assets/img/landing/khrisna oleh-oleh 1.png')?>"alt="Logo Perusahaan">
            </div>
        </div>
    </div>
</div>
<!-- end rekom -->


<!-- lowongan -->
<section id="lowongan">
    <h2 class="judul-lowongan">Lowongan Pekerjaan</h2>
    <div class="lowongan-section">
        <div class="lowongan">
    
            <div class="kotak-lowongan">
                <!-- img -->
                <div class="logo-lowongan">
                    <img src="<?php echo base_url("assets/img/landing/blessing computer 2.png")?>" alt="">
                </div>
    
                <!-- lowongan body -->
                <div class="body-lowongan">
                    <p class="namaUsaha">PT. Blessing Computer</p>
                    <h2 class="namaPosisi">Staff Administrasi</h2>
                </div>
    
                <!-- lowongan kota -->
                <div class="kota-lowongan">
                    <div class="icon-location">
                        <a><i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                    <p class="kotaUsaha">Denpasar</p>
                </div>
    
                <!-- link cek details -->
                <?php 
                    if($session_name == NULL){
                ?>
                    <div class="cek">
                        <a href="<?php echo base_url("Auth/login")?>">Detail Lowongan</a>
                    </div>
                <?php
                    }else{
                ?>
    
                <div class="cek">
                    <a href=""></a>
                </div>
    
                <?php } ?>
            </div>
    
            <div class="kotak-lowongan">
                <!-- img -->
                <div class="logo-lowongan">
                    <img src="<?php echo base_url("assets/img/landing/unique.png")?>" alt="">
                </div>
    
                <!-- lowongan body -->
                <div class="body-lowongan">
                    <p class="namaUsaha">PT. Blessing Computer</p>
                    <h2 class="namaPosisi">Staff Administrasi</h2>
                </div>
    
                <!-- lowongan kota -->
                <div class="kota-lowongan">
                    <div class="icon-location">
                        <a><i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                    <p class="kotaUsaha">Denpasar</p>
                </div>
    
                <!-- link cek details -->
                <?php 
                    if($session_name == NULL){
                ?>
                    <div class="cek">
                        <a href="<?php echo base_url("Auth/login")?>">Detail Lowongan</a>
                    </div>
                <?php
                    }else{
                ?>
    
                <div class="cek">
                    <a href=""></a>
                </div>
    
                <?php } ?>
            </div>
    
            <div class="kotak-lowongan">
                <!-- img -->
                <div class="logo-lowongan">
                    <img src="<?php echo base_url("assets/img/landing/The_Keranjang 1.png")?>" alt="">
                </div>
    
                <!-- lowongan body -->
                <div class="body-lowongan">
                    <p class="namaUsaha">PT. Blessing Computer</p>
                    <h2 class="namaPosisi">Staff Administrasi</h2>
                </div>
    
                <!-- lowongan kota -->
                <div class="kota-lowongan">
                    <div class="icon-location">
                        <a><i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                    <p class="kotaUsaha">Denpasar</p>
                </div>
    
                <!-- link cek details -->
                <?php 
                    if($session_name == NULL){
                ?>
                    <div class="cek">
                        <a href="<?php echo base_url("Auth/login")?>">Detail Lowongan</a>
                    </div>
                <?php
                    }else{
                ?>
    
                <div class="cek">
                    <a href=""></a>
                </div>
    
                <?php } ?>
            </div>
    
            <div class="kotak-lowongan">
                <!-- img -->
                <div class="logo-lowongan">
                    <img src="<?php echo base_url("assets/img/landing/blessing computer 2.png")?>" alt="">
                </div>
    
                <!-- lowongan body -->
                <div class="body-lowongan">
                    <p class="namaUsaha">PT. Blessing Computer</p>
                    <h2 class="namaPosisi">Staff Administrasi</h2>
                </div>
    
                <!-- lowongan kota -->
                <div class="kota-lowongan">
                    <div class="icon-location">
                        <a><i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                    <p class="kotaUsaha">Denpasar</p>
                </div>
    
                <!-- link cek details -->
                <?php 
                    if($session_name == NULL){
                ?>
                    <div class="cek">
                        <a href="<?php echo base_url("Auth/login")?>">Detail Lowongan</a>
                    </div>
                <?php
                    }else{
                ?>
    
                <div class="cek">
                    <a href=""></a>
                </div>
    
                <?php } ?>
            </div>
    
            <div class="kotak-lowongan">
                <!-- img -->
                <div class="logo-lowongan">
                    <img src="<?php echo base_url("assets/img/landing/blessing computer 2.png")?>" alt="">
                </div>
    
                <!-- lowongan body -->
                <div class="body-lowongan">
                    <p class="namaUsaha">PT. Blessing Computer</p>
                    <h2 class="namaPosisi">Staff Administrasi</h2>
                </div>
    
                <!-- lowongan kota -->
                <div class="kota-lowongan">
                    <div class="icon-location">
                        <a><i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                    <p class="kotaUsaha">Denpasar</p>
                </div>
    
                <!-- link cek details -->
                <?php 
                    if($session_name == NULL){
                ?>
                    <div class="cek">
                        <a href="<?php echo base_url("Auth/login")?>">Detail Lowongan</a>
                    </div>
                <?php
                    }else{
                ?>
    
                <div class="cek">
                    <a href=""></a>
                </div>
    
                <?php } ?>
            </div>
    
            <div class="kotak-lowongan">
                <!-- img -->
                <div class="logo-lowongan">
                    <img src="<?php echo base_url("assets/img/landing/blessing computer 2.png")?>" alt="">
                </div>
    
                <!-- lowongan body -->
                <div class="body-lowongan">
                    <p class="namaUsaha">PT. Blessing Computer</p>
                    <h2 class="namaPosisi">Staff Administrasi</h2>
                </div>
    
                <!-- lowongan kota -->
                <div class="kota-lowongan">
                    <div class="icon-location">
                        <a><i class="bi bi-geo-alt-fill"></i></a>
                    </div>
                    <p class="kotaUsaha">Denpasar</p>
                </div>
    
                <!-- link cek details -->
                <?php 
                    if($session_name == NULL){
                ?>
                    <div class="cek">
                        <a href="<?php echo base_url("Auth/login")?>">Detail Lowongan</a>
                    </div>
                <?php
                    }else{
                ?>
    
                <div class="cek">
                    <a href=""></a>
                </div>
    
                <?php } ?>
            </div>
    
        </div>
    </div>
    
    <div class="btn_more-lowongan">
        <a href="">Find More</a>
    </div>
</section>

<!-- end lowongan -->



    
 
    

