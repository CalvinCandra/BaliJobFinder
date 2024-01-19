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
                    <?php foreach ($perusahaan->result_array() as $key): ?>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('upload_error')): ?>
                                <div class="error-message">
                                    <?php echo $this->session->flashdata('upload_error'); ?>
                                </div>
                            <?php endif; ?>
                            <form method="post" action="<?php echo base_url('perusahaan/simpanProfile'); ?>" enctype="multipart/form-data">

                            <input type="hidden" class="form-control" name="perusahaan" value="<?php echo $key['id_perusahaan'] ?>">

                            <div class="d-flex align-items-center">
                                <div class="form-group">
                                       <label for="logo">Logo Perusahaan:</label>
                                       <br>
                                       <?php if (empty($key['logo'])): ?>
                                           <img src="<?= base_url('assets/img/dashboard/profile.png'); ?>" alt="Default Logo" width="150">
                                       <?php else: ?>
                                           <img src="<?= base_url('assets/img/profile/perusahaan/'.$key['logo']); ?>" alt="Logo Preview" width="150">
                                       <?php endif; ?>
                                   </div>

                                   <div class="form-group">
                                       <input type="file" id="logo" name="logo_file" class="form-control-file ml-4 mt-5" accept="image/*">
                                   </div>
                            </div>
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
                            </form>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </section>
</div>

