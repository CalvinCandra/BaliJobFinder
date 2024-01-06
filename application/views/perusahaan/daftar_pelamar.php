<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <b><h3>Daftar Pelamar</h3></b>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('perusahaan/lamaran') ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchLamaran" placeholder="Cari lamaran..." name="key_lamaran" autocomplete="off" autofocus>
                            <div class="input-group-append">
                                <input class="btn btn-outline-secondary" type="submit" name="cari_lamaran" value="cari">
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
                        <?php if ($key_lamaran && $lamaran->num_rows() == 0): ?>
                        <div class="alert alert-danger" role="alert">
                            Data tidak ditemukan untuk kata kunci "<?php echo $key_lamaran; ?>"
                        </div>
                        <?php elseif ($lamaran->num_rows() > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Posisi</th>
                                    <th>CV</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor=1;foreach ($lamaran->result_array() as $key): ?>
                                <tr>
                                    <td><?= ++$start ?></td>
                                    <td><?php echo $key['nama_lengkap'] ?></td>
                                    <td><?php echo $key['posisi_lowongan'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url("assets/CV/".$key['cv']) ?>" target="__blank">
                                            <p class="btn btn-light text-primary">Cek CV</p>
                                        </a>
                                    </td>
                                    <td>
                                        <?php if ($key['status_lamaran'] == "Diterima"): ?>
                                            <span class="badge badge-success">Diterima</span>
                                        <?php elseif ($key['status_lamaran'] == "Ditolak"): ?>
                                            <span class="badge badge-danger">Ditolak</span>
                                        <?php else : ?>
                                            <span class="badge badge-warning">Perlu Konfirmasi...</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#editLamaranModal">Edit</button> -->
                                        <button class="btn btn-info" data-toggle="modal" data-target="#detailLamaranModal<?php echo $key['id_lamaran'] ?>">Detail</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteConfirmationModal<?php echo $key['id_lamaran'] ?>">Hapus</button>
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


<!-- Modal Detail Lamaran -->
<?php foreach ($lamaran->result_array() as $key): ?>
<div class="modal fade" id="detailLamaranModal<?php echo $key['id_lamaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailLamaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLamaranModalLabel">Detail Lamaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="posisiLowonganEdit">Nama :</label>
                        <input type="text" class="form-control" value="<?= $key['nama_lengkap'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganEdit">Tanggal Lahir :</label>
                        <input type="text" class="form-control" value="<?= $key['tgl_lahir'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganEdit">Alamat :</label>
                        <textarea class="form-control" name="alamat" rows="3" disabled><?= $key['alamat'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganEdit">Posisi yang Dilamar :</label>
                        <input type="text" class="form-control" value="<?= $key['posisi_lowongan'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="salaryLowonganEdit">Nomor Telephone :</label>
                        <input type="text" class="form-control" value="<?= $key['no_hp'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="syaratLowonganEdit">CV</label><br>
                        <a href="<?php echo base_url("assets/CV/".$key['cv']) ?>" target="__blank">
                            <p class="btn btn-light text-primary">Cek CV</p>
                        </a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <form method="post" action="<?php echo base_url('perusahaan/konfirmasiLamaran/'.$key['id_lamaran']) ?>">
                    <button type="submit" class="btn btn-success" name="status" value="Diterima">Terima</button>
                    <button type="submit" class="btn btn-danger" name="status" value="Ditolak">Tolak</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>

<!-- Modal Hapus Lamaran -->
<?php foreach ($lamaran->result_array() as $key): ?>
<div class="modal fade" id="deleteConfirmationModal<?php echo $key['id_lamaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus lamaran ini?
            </div>
            <div class="modal-footer">
                <form method="post" action="<?php echo base_url('perusahaan/deleteLamaran/'.$key['id_lamaran']) ?>">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>