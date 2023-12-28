<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-6">
                    <b><h2>Daftar Lamaran</h2></b>
                </div>
                <div class="col-md-6">
                    <form action="<?= base_url('perusahaan/management') ?>" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchLowongan" placeholder="daftar lamaran..." name="keyword" autocomplete="off" autofocus>
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
                        <h5>Results : 0</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Posisi</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $nomor=1 ?>
                            <?php foreach ($lamaran->result_array() as $key): ?>
                                <tr>
                                    <td><?= $nomor++?></td>
                                    <td><?= $key['posisi_lowongan']?></td>
                                    <td><?= $key['nama_perusahaan']?></td>
                                    <td>
                                        <?php if ($key['status'] == "Diterima"): ?>
                                            <span class="badge badge-success">Diterima</span>
                                        <?php elseif ($key['status'] == "Ditolak"): ?>
                                            <span class="badge badge-danger">Ditolak</span>
                                        <?php else : ?>
                                            <span class="badge badge-warning">Perlu Konfirmasi...</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>