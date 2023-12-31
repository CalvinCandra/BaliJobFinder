<style>
    /* Custom styles for Profile User section */
    .profile-header {
        font-weight: bold;
        margin-bottom: 5px; /* Adjust as needed */
    }
    .error-message {
        color: red;
        margin-top: 10px;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <b><h3 class="profile-header">Profile User</h3></b>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- menampilkan data pelamar -->
                    <?php foreach ($profile as $key): ?>
                        <div class="card-body">
                            <!-- menampilkan pesan error -->
                            <?php if ($this->session->flashdata('upload_error')): ?>
                                <div class="error-message">
                                    <?php echo $this->session->flashdata('upload_error'); ?>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="<?php echo base_url('Pelamar/simpanProfile'); ?>" enctype="multipart/form-data">
                            <!-- foto profile -->
                             <div class="form-group">
                                    <label for="logo">Foto Profil:</label>
                                    <br>
                                    <?php if (empty($key['logo'])): ?>
                                        <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                    <?php else: ?>
                                        <img src="<?= base_url($key['logo']); ?>" alt="Logo Preview" width="100">
                                    <?php endif; ?>
                                </div>
                                
                                <div class="form-group">
                                    <input type="file" id="logo" name="logo_file" class="form-control-file" accept="image/*">
                                </div>

                                <!-- nama pelamar -->
                                <div class="form-group">
                                    <label for="nama">Nama Pelamar:</label>
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $key['id_pelamar'] ?>">
                                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $key['nama_lengkap']; ?>" required>
                                </div>

                                <!-- tanggal-lahir -->
                                <div class="form-group">
                                    <label for="no_tlp">Tanggal Lahir:</label>
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $key['tgl_lahir']; ?>" required>
                                </div>

                                <!-- no hp -->
                                <div class="form-group">
                                    <label for="no_tlp">No.HP:</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?php echo $key['no_hp']; ?>" required>
                                </div>

                                <!-- alamat -->
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <textarea class="form-control" name="alamat" rows="3" required><?php echo $key['alamat']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Deskripsi Pelamar:</label>
                                    <textarea class="form-control" name="deskripsi" rows="3" required><?php echo $key['deskripsi_pelamar']; ?></textarea>
                                </div> 

                                <!-- pendidikan -->
                                <div class="form-group">
                                    <label for="pendidikan">Pendidikan</label> <a type="button" class="btn btn-primary rounded-circle text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i></a>
                                    <div class="w-100 p-3 mt-2 d-flex flex-wrap">

                                        <?php
                                            if(!$pendidikan):    
                                        ?>
                                            <p class="fw-bold text-black" style="font-size:15px;">Data Belum Ada</p>
                                        <?php
                                            else:
                                                foreach($pendidikan as $data):
                                        ?>

                                        <!-- bagian data -->
                                        <div class=" w-100 mx-1 my-2 p-2 shadow">
                                            <!-- header -->
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <p class="fw-bold text-black" style="font-size:15px;"><?= $data['bulan_awal']?> <?= $data['tahun_mulai']?>  - <?= $data['bulan_akhir']?> <?= $data['tahun_akhir']?></p> 
                                                </div>
                                                <div class="">
                                                    <div class="d-inline p-1">
                                                        <a class="text-center fw-bold text-info"  data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['id_pendidikan']?>"><i class="fa-solid fa-pen"></i></a>
                                                    </div>

                                                    <div class="d-inline">
                                                        <a class="text-center fw-bold text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalHapus<?= $data['id_pendidikan']?>"><i class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <h2 class="fw-bold" style="margin-top:-10px; font-size:20px;"><?= $data['nama_sekolah']?></h2>

                                            <h5 class="mt-2 italic" style="font-size:18px;"> <?= $data['bidang_studi']?></h5>

                                            <h5 class="mt-2" style="font-size:18px;">Nilai Akhir <?= $data['nilai_akhir']?></h5>
                                        </div>

                                        <!-- modal edit -->    
                                        <div class="modal fade" id="exampleModal<?= $data['id_pendidikan']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Data Pendidikan</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">Update</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal edit -->    
                                        <div class="modal fade" id="exampleModalHapus<?= $data['id_pendidikan']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pendidikan</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger">Hapus</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                             
                                        <?php 
                                                endforeach;
                                            endif;
                                        ?>


                                    </div>
                                </div> 

                                <!-- pengalaman -->
                                <div class="form-group">
                                    <label for="pengalaman">Pengalaman</label> <a type="button" class="btn btn-primary rounded-circle text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i></a>
                                    <div class="w-100 p-3 mt-2 d-flex flex-wrap">

                                        <?php
                                            if(!$pengalaman):        
                                        ?>
                                            <p class="fw-bold text-black" style="font-size:15px;">Data Belum Ada</p>

                                        <?php
                                            else:
                                                foreach($pengalaman as $data):
                                        ?>

                                        <!-- bagian data -->
                                        <div class=" w-100 mx-1 my-2 p-2 shadow">
                                            <!-- header -->
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <?php
                                                        if($data['status_kerja'] == 0):
                                                    ?>
                                                        <p class="fw-bold text-black" style="font-size:15px;"><?= $data['bulan_mulai_kerja']?> <?= $data['tahun_mulai_kerja']?>  - Now></p> 
                                                    <?php else:?>
                                                        <p class="fw-bold text-black" style="font-size:15px;"><?= $data['bulan_mulai_kerja']?> <?= $data['tahun_mulai_kerja']?>  - <?= $data['bulan_akhir_kerja']?> <?= $data['tahun_akhir_kerja']?></p> 
                                                    <?php endif;?>
                                                </div>
                                                <div class="">
                                                    <div class="d-inline p-1">
                                                        <a class="text-center fw-bold text-info"  data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['id_pengalaman']?>"><i class="fa-solid fa-pen"></i></a>
                                                    </div>

                                                    <div class="d-inline">
                                                        <a class="text-center fw-bold text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalHapus<?= $data['id_pengalaman']?>"><i class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <h2 class="fw-bold" style="margin-top:-10px; font-size:20px;"><?= $data['jabatan']?></h2>

                                            <h4 class="fw-bold" style="margin-top:0;"><?= $data['nama_perusahaan']?> (<?= $data['lokasi_perusahaan']?>)</h4>
                    
                                            <h5 class="mt-2 italic text-capitalize" style="font-size:18px;"><?= $data['status_pekerja']?> <span class="fst-italic fw-bold">(<?= $data['sistem_kerja']?>)</span></h5>
                                        </div>

                                        <!-- modal edit -->    
                                        <div class="modal fade" id="exampleModal<?= $data['id_pengalaman']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Data Pengalaman</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">Update</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal edit -->    
                                        <div class="modal fade" id="exampleModalHapus<?= $data['id_pengalaman']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengalaman</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger">Hapus</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                             
                                        <?php 
                                                endforeach;
                                            endif;
                                        ?>


                                    </div>
                                </div> 
                                
                                <!-- skill -->
                                <div class="form-group">
                                    <label for="skill">Skill</label> <a type="button" class="btn btn-primary rounded-circle text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i></a>
                                    <div class="w-100 p-3 mt-2 d-flex flex-wrap">

                                        <?php
                                            if(!$skill):        
                                        ?>
                                            <p class="fw-bold text-black" style="font-size:15px;">Data Belum Ada</p>

                                        <?php
                                            else:
                                                foreach($skill as $data):
                                        ?>

                                        <!-- bagian data -->
                                        <div class=" w-100 mx-1 my-2 p-2 shadow">
                                            <!-- header -->
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <h5 class='fs-3 fw-bold'><?= $data['nama_skill']?></h5>
                                                </div>
                                                <div class="">
                                                    <div class="d-inline p-1">
                                                        <a class="text-center fw-bold text-info"  data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['fk_id_pelamar']?>"><i class="fa-solid fa-pen"></i></a>
                                                    </div>

                                                    <div class="d-inline">
                                                        <a class="text-center fw-bold text-danger" data-bs-toggle="modal" data-bs-target="#exampleModalHapus<?= $data['fk_id_pelamar']?>"><i class="fa-solid fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                                echo "
                                                    <div class='my-2'>
                                                        <div class='progress w-100'>
                                                            <div class='progress-bar fw-bold text-center' role='progressbar' style='width: {$data['value']}%;' aria-valuenow='{$data['value']}' aria-valuemin='0' aria-valuemax='100'>{$data['value']}%</div>
                                                        </div>
                                                    </div>
                                                ";
                                            
                                            ?>

                                        </div>

                                        <!-- modal edit -->    
                                        <!-- <div class="modal fade" id="exampleModal<?= $data['id_pengalaman']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Data Pengalaman</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">Update</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- modal edit -->    
                                        <!-- <div class="modal fade" id="exampleModalHapus<?= $data['id_pengalaman']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengalaman</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger">Hapus</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div> -->

                                             
                                        <?php 
                                                endforeach;
                                            endif;
                                        ?>


                                    </div>
                                </div> 
                                
                                <button type="submit" class="btn btn-primary">Simpan Profile</button>
                            </form>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Pendidikan-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pendidikan</h5>
      </div>
      <div class="modal-body">
        <form action="" method="post">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

