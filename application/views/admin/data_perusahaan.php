<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <b><h2>Data Perusahaan</h2></b>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('admin/dataPerusahaan') ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchLowongan" placeholder="Cari lowongan..." name="keyword" autocomplete="off" autofocus>
                            <div class="input-group-append">
                                <input class="btn btn-outline-secondary" type="submit" name="cari" value="cari">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h3 class="card-title">Kelola Lowongan</h3>
                    </div> -->
                    <div class="card-body">
                        <h5>Results : <?= $total_rows; ?></h5>
                         <?php if ($key_perusahaan && $perusahaan->num_rows() == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan untuk kata kunci "<?php echo $key_perusahaan; ?>"
                        </div>
                        <?php elseif ($perusahaan->num_rows() > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Logo</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Email</th>
                                    <th>Telephon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($perusahaan->result_array() as $key): ?>
                                <tr>
                                    <td><?= $key['id_perusahaan']?></td>
                                    <td>
                                        <?php if (empty($key['logo'])): ?>
                                            <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" alt="Logo Preview" width="100">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $key['nama_perusahaan']?></td>
                                    <td><?= $key['email']?></td>
                                    <td><?= $key['tlp_perusahaan']?></td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#dataperusahaanDetail<?php echo $key['id_perusahaan'] ?>">Detail</button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editperusahaanmodal<?php echo $key['id_perusahaan'] ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalhapusdataperusahaan<?php echo $key['id_perusahaan'] ?>">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                          <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?= $this->pagination->create_links(); ?>
</div>

<!-- Modal Detail perusahaan -->
<?php foreach ($perusahaan->result_array() as $key): ?>
<div class="modal fade" id="dataperusahaanDetail<?php echo $key['id_perusahaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="dataperusahaanDetailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataperusahaanDetailLabel">Detail Perusahaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                                    <label for="logo">Logo Perusahaan:</label>
                                    <br>
                                    <?php if (empty($key['logo'])): ?>
                                        <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" alt="Logo Preview" width="100">
                                    <?php endif; ?>
                                </div>
                    
                    <div class="form-group">
                        <label for="namaperusahaanEdit">Nama Perusahaan :</label>
                        <input type="text" class="form-control" value="<?= $key['nama_perusahaan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="emailEdit">Email Perusahaan:</label>
                        <input type="text" class="form-control" value="<?= $key['email'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="alamatperusahaannEdit">Alamat Perusahaan:</label>
                        <input type="text" class="form-control" value="<?= $key['alamat_perusahaan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tlpperusahaanEdit">Tlp Perusahaan :</label>
                        <input type="text" class="form-control" value="<?= $key['tlp_perusahaan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="kotaperusahaanEdit">Kota :</label>
                        <input type="text" class="form-control" value="<?= $key['kota'] ?>" disabled>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>

<!-- Modal Edit perusahaan -->
<?php foreach ($perusahaan->result_array() as $key): ?>
<div class="modal fade" id="editperusahaanmodal<?php echo $key['id_perusahaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLowonganModalLabel">Edit Perusahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('admin/editPerusahaan') ?>" enctype="multipart/form-data">
                <div class="form-group">
                                    <label for="logo">Logo Perusahaan:</label>
                                    <br>
                                    <?php if (empty($key['logo'])): ?>
                                        <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" alt="Logo Preview" width="100">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="file" id="logo" name="logo_file" class="form-control-file" accept="image/*">
                                </div>
                    <div class="form-group">
                        <label for="namaperusahaanEdit">Nama Perusahaan:</label>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $key['id_perusahaan'] ?>">
                        <input type="text" class="form-control" name="nama_perusahaan" value="<?php echo $key['nama_perusahaan'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="emailperusahaanEdit">Email Perusahaan:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $key['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamatperusahaanEdit">Alamat Perusahaan:</label>
                        <input type="text" class="form-control" name="alamat_perusahaan" value="<?php echo $key['alamat_perusahaan'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tlp_perusahaanEdit">tlp:</label>
                        <input type="text" class="form-control" name="tlp_perusahaan" value="<?php echo $key['tlp_perusahaan'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kotaperusahaanEdit">Kota:</label>
                        <input type="text" class="form-control" name="kota" value="<?php echo $key['kota'] ?>" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<?php endforeach ?>

<!-- Modal Hapus Lowongan -->
<?php foreach ($perusahaan->result_array() as $key): ?>
    <div class="modal fade" id="modalhapusdataperusahaan<?php echo $key['id_perusahaan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalhapusdataperusahaanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalhapusdataperusahaanLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus lowongan ini?
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo base_url('admin/deleteperusahaan/'.$key['id_perusahaan']) ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
