<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <b><h3 class="profile-header font-weight-bold mb-2">PROFILE USER</h3></b>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php foreach ($perusahaan->result_array() as $key): ?>
                        <div class="card-body">

                            <form method="post" action="<?php echo base_url('perusahaan/simpanProfile'); ?>" enctype="multipart/form-data">

                            <input type="hidden" class="form-control" name="perusahaan" value="<?php echo $key['id_perusahaan'] ?>">

                            <div class="row">

                                <div class="col-md-5 col-sm-12">
                                    <label for="logo">Logo Perusahaan:</label>

                                    <div class="d-flex align-items-center justify-content-md-center">
                                        <div class="form-group">
                                            <br>
                                            <?php if (empty($key['logo'])): ?>
                                                <img class="rounded-circle" src="<?= base_url('assets/img/dashboard/no_image.png'); ?>" alt="Default Logo" width="250">
                                            <?php else: ?>
                                                <img class="rounded-circle" src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" alt="Logo Preview" width="250">
                                            <?php endif; ?>

                                            <input type="file" id="logo" name="logo_file" class="form-control-file mt-4" accept="image/*"><br>

                                            <small class="font-italic">*Ekstensi yang diperbolehkan adalah .jpg, .jpeg, .png</small><br>
											<small class="font-italic">*Size foto harus di bawah 3MB.</small><br>
											<small class="font-italic">*Gunakan rasio aspek 1:1 untuk hasil yang lebih bagus.</small>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-7 col-sm-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Perusahaan:</label>
                                        <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo $key['nama_perusahaan']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_tlp">Nomor Telepon:</label>
                                        <input type="text" class="form-control" name="no_tlp" value="<?php echo $key['tlp_perusahaan']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_tlp">Kota:</label>
                                        <input type="text" class="form-control" name="kota" value="<?php echo $key['kota']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat Perusahaan:</label>
                                        <textarea class="form-control" name="alamat" rows="3" required><?php echo $key['alamat_perusahaan']; ?></textarea>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Simpan Profile</button>
                                </div>
                            </div>
                            
                               
                            </form>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
</div>

