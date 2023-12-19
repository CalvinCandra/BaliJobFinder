<!-- search section -->
<div class="search-section">
    <div class="search-data">
        <form class="form-search" action="<?= base_url("Balijobfinder/lowongan")?>" method="post">
            <input class="search-input" type="text" placeholder="Nama Pekerjaan..." name="search">
            <input class="search-btn" name="cari" type="submit" value="cari">
        </form>
    </div>
</div>
<!-- end search -->

<!-- lowongan -->
<section id="lowongan">
    <div class="lowongan-section">
        <div class="lowongan">
            <?php if ($search && $datalowongan->num_rows() == 0): ?>
                <div class="alert alert-danger d-flex align-items-center justify-content-center w-75" role="alert">
                    <div>
                        Pekerjaan Belum Tersedia
                    </div>
                </div>

            <?php else: ?>

                <?php
                    foreach($datalowongan->result_array() as $key):
                ?>     
    
                <div class="kotak-lowongan">
                    <!-- img -->
                    <div class="logo-lowongan">
                        <img src="<?php echo base_url($key['logo'])?>" alt="">
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
                        <a href="<?php echo base_url("Balijobfinder/Details?lowongan=".$key['posisi_lowongan'].'&perusahaan='.$key['nama_perusahaan'])?>">Detail Lowongan</a>
                    </div>
        
                </div>

                <?php
                    endforeach;
                ?>

            <?php
                endif;
            ?>
    
        </div>
    </div>
</section>
<!-- end lowongan -->

<!-- pagination -->
<section class="pagination">
    <?= $this->pagination->create_links(); ?>
</section>
<!-- end pagination -->