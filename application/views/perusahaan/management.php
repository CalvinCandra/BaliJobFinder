<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <b><h2>Management Lowongan</h2></b>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('perusahaan/management') ?>" method="post">
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
                        
                        <?php  if($cekData == 1):?>
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahLowonganModalAlert">Tambah Lowongan</button>
                        <?php else:?>
                                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahLowonganModal">Tambah Lowongan</button>
                        <?php endif;?>

                        <h5>Results : <?= $total_rows; ?></h5>

                        <?php if ($keyword && $lowongan->num_rows() == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan untuk kata kunci "<?php echo $keyword; ?>"
                        </div>
                        <?php elseif ($lowongan->num_rows() > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Posisi</th>
                                    <th>Salary</th>
                                    <th>Syarat</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                
                                <?php foreach ($lowongan->result_array() as $key): ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td ><?php echo $key['posisi_lowongan'] ?></td>
                                    <td >Rp. <?php echo number_format($key['salary'], 0, ',', '.'); ?></td>
                                    <td><?php echo $key['syarat_lowongan'] ?></td>
                                    <td>
                                        <?php if ($key['status'] == 1): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editLowonganModal<?php echo $key['id_lowongan'] ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal<?php echo $key['id_lowongan'] ?>">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach ?>
        
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

<!-- Modal Tambah Lowongan -->
<div class="modal fade" id="tambahLowonganModal" tabindex="-1" role="dialog" aria-labelledby="tambahLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLowonganModalLabel">Tambah Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('perusahaan/addLowongan') ?>">
                    <div class="form-group">
                        <label for="posisiLowongan">Posisi:</label>
                        <input type="text" class="form-control" name="posisi_lowongan" placeholder="Masukkan posisi lowongan" required>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowongan">Salary:</label>
                        <input type="text" class="form-control" name="salary" placeholder="Masukkan salary lowongan" required>
                    </div>
                    <div class="form-group">
                        <label for="syaratLowongan">Syarat:</label>
                        <textarea class="form-control" name="syarat_lowongan" rows="10" placeholder="Masukkan syarat lowongan" required></textarea>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Lowongan -->
<?php foreach ($lowongan->result_array() as $key): ?>
<div class="modal fade" id="editLowonganModal<?php echo $key['id_lowongan'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLowonganModalLabel">Edit Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('perusahaan/editLowongan') ?>">
                    <input type="hidden" class="form-control" name="lowongan" value="<?php echo $key['id_lowongan'] ?>">

                    <div class="form-group">
                        <label for="posisiLowonganEdit">Posisi:</label>
                        <input type="text" class="form-control" name="posisi" value="<?php echo $key['posisi_lowongan'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganEdit">Salary:</label>
                        <input type="text" class="form-control" name="salary" value="<?php echo $key['salary'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="syaratLowonganEdit">Syarat:</label>
                        <textarea class="form-control" name="syarat" rows="3" required><?php echo $key['syarat_lowongan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="statusLowonganEdit">Status:</label>
                        <select class="form-control" name="status">
                            <option value="1" <?php echo ($key['status'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?php echo ($key['status'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<?php endforeach ?>

<!-- Modal Hapus Lowongan -->
<?php foreach ($lowongan->result_array() as $key): ?>
    <div class="modal fade" id="deleteConfirmationModal<?php echo $key['id_lowongan'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus lowongan <b><?= $key['posisi_lowongan']?></b>?
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo base_url('perusahaan/deleteLowongan/'.$key['id_lowongan']) ?>">
                        <button type="submit" class="btn btn-primary">Hapus</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal Alert -->
<div class="modal fade" id="tambahLowonganModalAlert" tabindex="-1" role="dialog" aria-labelledby="tambahLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahLowonganModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Upsss, Data Profile Masih Ada Yang Kosong, Silahkan Di isi Dulu
            </div>

            <div class="modal-footer">
                <a href="<?php echo base_url("Perusahaan/profile")?>" class="btn btn-success">Okey</a>
            </div>
        </div>
    </div>
</div>

