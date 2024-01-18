<div class="content-wrapper" style="margin-top: 57px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <b><h2>Management Lowongan</h2></b>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('admin/dataLowongan') ?>" method="post">
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

                        <?php if ($keyword && $lowongan_kerja->num_rows() == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan untuk kata kunci "<?php echo $keyword; ?>"
                        </div>
                        <?php elseif ($lowongan_kerja->num_rows() > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Posisi</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            <?php foreach ($lowongan_kerja->result_array() as $key): ?>
                                <tr>
                                    <td><?= ++$start ?></td>
                                    <td><?= $key['nama_perusahaan'] ?></td>
                                    <td><?= $key['posisi_lowongan']?></td>
                                    <td>Rp. <?php echo number_format($key['salary'], 0, ',', '.'); ?></td>
                                    <td>
                                        <?php if ($key['status'] == 1): ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#detailLowonganModal<?php echo $key['id_lowongan'] ?>">Detail</button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editLowonganModal<?php echo $key['id_lowongan'] ?>">Edit</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#modalhapuslowongan<?php echo $key['id_lowongan'] ?>">Hapus</button>
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

<!-- Modal Detail lowongan -->
<?php foreach ($lowongan_kerja->result_array() as $key): ?>
<div class="modal fade" id="detailLowonganModal<?php echo $key['id_lowongan'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailLowonganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLowonganModalLabel">Detail Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <div class="form-group text-center">
                                    <br>
                                    <?php if (empty($key['logo'])): ?>
                                        <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="100">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" alt="Logo Preview" width="100">
                                    <?php endif; ?>
                                </div>
                    
                    <div class="form-group">
                        <label for="namaLowonganDetail">Nama Perusahaan :</label>
                        <input type="text" class="form-control" value="<?= $key['nama_perusahaan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="alamatowonganDetail">Alamat Perusahaan:</label>
                        <textarea class="form-control" rows ="3" disabled><?php echo $key['alamat_perusahaan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="posisiLowonganDetail">Posisi Lowongan :</label>
                        <input type="text" class="form-control" value="<?= $key['posisi_lowongan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganDetail">salary :</label>
                        <input type="text" class="form-control" value="<?= $key['salary'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="syaratLowonganDetail">Syarat Lowongan :</label>
                        <?php
                            $syaratArray = explode("\n", $key['syarat_lowongan']);
                            foreach($syaratArray as $syarat):
                        ?>
                            <ul class="list">
                                <li><?= $syarat?></li>  
                            </ul>
                        <?php endforeach;?>
                    </div>
                    <div class="form-group">
                        <label for="statusLowongandDetail">Status:</label>
                        <input type="text" class="form-control" name="" value="<?php echo ($key['status'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?>" disabled>
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

<!-- Modal Edit Lowongan -->
<?php foreach ($lowongan_kerja->result_array() as $key): ?>
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
                <form method="post" action="<?php echo base_url('admin/editLowongan') ?>">
                
                    <input type="hidden" class="form-control" name="lowongan" value="<?php echo $key['id_lowongan'] ?>">
                    
                    <div class="form-group">
                        <label for="namaperusahaanEdit">Nama Perusahaan:</label>
                        <input type="text" class="form-control" value="<?php echo $key['nama_perusahaan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganEdit">Posisi Lowongan:</label>
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
<?php foreach ($lowongan_kerja->result_array() as $key): ?>
    <div class="modal fade" id="modalhapuslowongan<?php echo $key['id_lowongan'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalhapuslowonganLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalhapuslowonganLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus lowongan ini?
                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo base_url('admin/deleteLowongan/'.$key['id_lowongan']) ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
