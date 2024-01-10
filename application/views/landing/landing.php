<!-- hero-section -->
<div class="hero-section" data-aos="zoom-in-up" data-aos-duration="1000" id="home">
    <div class="hero">
        <div class="konten">
            <h1 class="Judul">bali job finder</h1>
            <h5 class="pendukung">website pencari lowongan kerja terbaik!</h5>
            <div class="bungkus-btn">
                <a href="#lowongan" class="button">find now</a>
            </div>
        </div>
    </div>
</div>
<!-- end hero section -->


<!-- alasan -->
<div class="" data-aos="zoom-in-up" data-aos-duration="1000">
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
</div>

<!-- end alasan -->

<!-- rekom -->
<div class="" data-aos="zoom-in-up" data-aos-duration="1000">
    <h2 class="judul-rekom">Rekomendasi Perusahaan</h2>
    <p class="pendukung-judul-rekom">Kami menyarankan beberapa perusahaan yang terbaik</p>

    <div class="rekom-section">
        <div class="rekom-kotak">
    
            <div class="splide">
                <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide d-flex justify-content-center align-items-center">
                                <div class=" w-50 p-2 ">
                                    <img src="<?php echo base_url('assets/img/landing/blessing computer 2.png')?>" alt="" style="width:100%;">
                                </div>
                            </li>
                            <li class="splide__slide mx-1 d-flex justify-content-center align-items-center">
                                <div class=" w-50 p-2 ">
                                    <img src="<?php echo base_url('assets/img/landing/khrisna oleh-oleh 1.png')?>" alt="" style="width:100%;">
                                </div>
                            </li>
    
                            <li class="splide__slide mx-1 d-flex justify-content-center align-items-center">
                                <div class=" w-50 p-2 ">
                                    <img src="<?php echo base_url('assets/img/landing/The_keranjang 1.png')?>" alt="" style="width:100%;">
                                </div>
                            </li>
                            <li class="splide__slide mx-1 d-flex justify-content-center align-items-center">
                                <div class=" w-50 p-2 ">
                                <img src="<?php echo base_url('assets/img/landing/unique.png')?>" alt="" style="width:100%;">
                                </div>
                            </li>
    
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end rekom -->


<!-- lowongan -->
<div class="" id="lowongan" data-aos="zoom-in-up" data-aos-duration="1000">
    <section>
        <h2 class="judul-lowongan">Lowongan Pekerjaan</h2>
        <div class="lowongan-section">
            <div class="lowongan">
    
                <?php
                    foreach($datalowongan->result_array() as $key):
                ?>     
        
                <div class="kotak-lowongan">
                    <!-- img -->
                    <div class="logo-lowongan">
                        <img src="<?php echo base_url('assets/img/profile/perusahaan/'.$key['logo'])?>" alt="">
                    </div>
        
                    <!-- lowongan body -->
                    <div class="body-lowongan">
                        <p class="namaUsaha"><?= $key['nama_perusahaan']?></p>
                        <h2 class="namaPosisi"><?= $key['posisi_lowongan']?></h2>
                    </div>
        
                    <!-- lowongan kota -->
                    <div class="kota-lowongan">
                        <div class="icon-location">
                            <a id="location"><i class="fa-solid fa-location-dot"></i></a>
                        </div>
                        <p class="kotaUsaha"><?= $key['kota']?></p>
                    </div>
        
                    <!-- link cek details -->
                    <div class="cek">
                        <a href="<?php echo base_url('Balijobfinder/Details/'.$key['posisi_lowongan'].'/'.$key['nama_perusahaan'])?>">Detail Lowongan</a>
                    </div>
                </div>
    
                <?php
                    endforeach
                ?>
        
            </div>
    
        </div>
    
         <!-- link more -->
         <div class="btn_more-lowongan">
            <a href="<?php echo base_url("Balijobfinder/Lowongan") ?>">Find More</a>
        </div>
    </section>
</div>

<!-- end lowongan -->



    
 
    

