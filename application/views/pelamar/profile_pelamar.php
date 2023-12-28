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
                    <?php foreach ($profile->result_array() as $key): ?>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('upload_error')): ?>
                                <div class="error-message">
                                    <?php echo $this->session->flashdata('upload_error'); ?>
                                </div>
                            <?php endif; ?>
                            <form method="post" action="<?php echo base_url('Pelamar/simpanProfile'); ?>" enctype="multipart/form-data">
                             <div class="form-group">
                                    <label for="logo">Logo Perusahaan:</label>
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
                                <div class="form-group">
                                    <label for="nama">Nama Pelamar:</label>
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $key['id_pelamar'] ?>">
                                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $key['nama_lengkap']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_tlp">Tanggal Lahir:</label>
                                    <input type="text" class="form-control" name="tgl_lahir" value="<?php echo $key['tgl_lahir']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_tlp">No.HP:</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?php echo $key['no_hp']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat:</label>
                                    <textarea class="form-control" name="alamat" rows="3" required><?php echo $key['alamat']; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
</div>

