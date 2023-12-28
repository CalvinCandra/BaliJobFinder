<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <b><h2>Data Pelamar</h2></b>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('admin/dataPelamar') ?>" method="post">
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
                         <?php if ($key_pelamar && $pelamar->num_rows() == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan untuk kata kunci "<?php echo $key_pelamar; ?>"
                        </div>
                        <?php elseif ($pelamar->num_rows() > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Profile</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telephon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pelamar->result_array() as $key): ?>
                                <tr>
                                    <td><?= $key['id_pelamar']?></td>
                                    <td>
                                        <?php if (empty($key['gambar'])): ?>
                                            <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                        <?php else: ?>
                                            <img src="<?= base_url($key['gambar']); ?>" alt="Logo Preview" width="100">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $key['nama_lengkap']?></td>
                                    <td><?= $key['email']?></td>
                                    <td><?= $key['no_hp']?></td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#datapelamarDetail<?php echo $key['id_pelamar'] ?>">Detail</button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editpelamarmodal<?php echo $key['id_pelamar'] ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalhapuspelamar<?php echo $key['id_pelamar'] ?>">Hapus</button>
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

<!-- Modal Detail pelamar -->
<?php foreach ($pelamar->result_array() as $key): ?>
<div class="modal fade" id="datapelamarDetail<?php echo $key['id_pelamar'] ?>" tabindex="-1" role="dialog" aria-labelledby="datapelamarDetailLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="datapelamarDetailLabel">Detail Pelamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group">
                                    <label for="gambar">Profile Pelamar:</label>
                                    <br>
                                    <?php if (empty($key['gambar'])): ?>
                                        <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default gambar" width="100">
                                    <?php else: ?>
                                        <img src="<?= base_url($key['gambar']); ?>" alt="gambar Preview" width="100">
                                    <?php endif; ?>
                                </div>
           
                    <div class="form-group">
                        <label for="namapelamarEdit">Nama Pelamar :</label>
                        <input type="text" class="form-control" value="<?= $key['nama_lengkap'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="emailpelamarEdit">Email Pelamar:</label>
                        <input type="text" class="form-control" value="<?= $key['email'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tgllahirpelamarEdit">Tgl Lahir:</label>
                        <input type="text" class="form-control" value="<?= $key['tgl_lahir'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nohppelamarEdit">No Hp :</label>
                        <input type="text" class="form-control" value="<?= $key['no_hp'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="alamatpelamarEdit">Alamat :</label>
                        <input type="text" class="form-control" value="<?= $key['alamat'] ?>" disabled>
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
<?php foreach ($pelamar->result_array() as $key): ?>
<div class="modal fade" id="editpelamarmodal<?php echo $key['id_pelamar'] ?>" tabindex="-1" role="dialog" aria-labelledby="editpelamarmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editpelamarmodalLabel">Edit Pelamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('admin/editPelamar') ?>" enctype="multipart/form-data">
                <div class="form-group">
                                    <label for="logo">Profile Pelamar:</label>
                                    <br>
                                    <?php if (empty($key['gambar'])): ?>
                                        <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                    <?php else: ?>
                                        <img src="<?= base_url($key['gambar']); ?>" alt="Logo Preview" width="100">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <input type="file" id="logo" name="logo_file" class="form-control-file" accept="image/*">
                                </div>
                    <div class="form-group">
                        <label for="namapelamarEdit">Nama Pelamar:</label>
                        <input type="hidden" class="form-control" name="id" value="<?php echo $key['id_pelamar'] ?>">
                        <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $key['nama_lengkap'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="emailpelamarEdit">Email Perusahaan:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $key['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tgllahirpelamarEdit">Tgl Lahir:</label>
                        <input type="text" class="form-control" name="tgl_lahir" value="<?php echo $key['tgl_lahir'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nohppelamarEdit">No Hp:</label>
                        <input type="text" class="form-control" name="no_hp" value="<?php echo $key['no_hp'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamatpelamarEdit">Alamat:</label>
                        <input type="text" class="form-control" name="alamat" value="<?php echo $key['alamat'] ?>" required>
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
<?php foreach ($pelamar->result_array() as $key): ?>
    <div class="modal fade" id="modalhapuspelamar<?php echo $key['id_pelamar'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalhapuspelamarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalhapuspelamarLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus lowongan ini?
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo base_url('admin/deletepelamar/'.$key['id_pelamar']) ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>



