<!-- details -->

<section class="detail">
    <div class="kotak-details">
        <div class="detail-section">
       
            <div class="bungkus-detail">
    
                <?php
                    foreach($datalowongan->result_array() as $key):
                ?>
                <div class="header">
                    <div class="logo">
                        <img src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo'])?>" alt="">
                    </div>
                    <div class="nama_perusahaan">
                        <h2><?= $key['nama_perusahaan']?></h2>
                    </div>
                </div>
    
                <div class="perusahaan">
                    <h2>Informasi Perusahaan</h2>
                    <div class="center-kotak">
                        <div class="bungkus-perusahaan">
                            
                            <div class="kota">
                                <h4>Kota</h4>
                                <p><?= $key['kota']?></p>
                            </div>
                            
                            <div class="alamat">
                                <h4>Alamat</h4>
                                <p><?= $key['alamat_perusahaan']?></p>
                            </div>
    
                            <div class="telp">
                                <h4>Telepon</h4>
                                <p><?= $key['tlp_perusahaan']?></p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="lowongan">
                    <h2>Informasi Lowongan</h2>
                    <div class="center-kotak">
                        <div class="bungkus-lowongan">
                            <div class="posisi">
                                <h4>Posisi Lowongan</h4>
                                <p><?= $key['posisi_lowongan']?></p>
                            </div>
            
                            <div class="salary">
                                <h4>Salary</h4>
                                <p>Rp. <?php echo number_format($key['salary'], 0, ',', '.'); ?> / Bulan</p>
                            </div>
            
                            <div class="syarat">
                                <h4>Syarat</h4>
                               <textarea name="" id="" rows="10" disabled><?= $key['syarat_lowongan']?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
    
                <?php
                    endforeach;
                ?>
                
            </div>
        </div>

    
        <div class="cegah">
            <div class="upload-section">
                <h2>Lamar Kerja</h2>
                <div class="bungkus-upload">
                    <div class="text-ajakan">
                        <p>jika anda tertarik pada pekerjaan ini, anda dapat melamar pekerjaan dengan menekan tombol <span>"Lamar Now"</span> lalu upload curriculum vitae (CV) anda.</p>
                    </div>
            
                    <div class="btn-upload">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Lamar Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        
            <h5 class="modal-title" id="exampleModalLabel">Upload Curriculum Vitae (CV)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       

      </div>
      <div class="modal-body">
        <?php
            if($role == 'pelamar'):
                foreach($datalowongan->result_array() as $key):

        ?>
            <form action="<?= base_url("BalijobFinder/uploadCV")?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_lowongan" value="<?= $key['id_lowongan']?>">
                <input type="hidden" name="posisi" value="<?= $key['posisi_lowongan']?>" >
                <input type="hidden" name="perusahaan" value="<?= $key['nama_perusahaan']?>">

                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="cv" id="inputGroupFile02">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Lamar</button>
            </form>
        <?php
                endforeach;
            else:
        ?>
            <h5 class="text-center">Opppsss Cannot Upload CV</h5>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>


<!-- end details -->