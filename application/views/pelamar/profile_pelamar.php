<div class="content-wrapper" style="margin-top: 57px;">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<b>
						<h3 class="profile-header font-weight-bold mb-2">PROFILE USER</h3>
					</b>
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

						<form method="post" action="<?php echo base_url('Pelamar/simpanProfile'); ?>"
							enctype="multipart/form-data">

							<div class="row">
								<div class="col-md-5 col-sm-12">
									<!-- foto profile -->
									<label for="logo">Foto Profil:</label>
									<div class="d-flex align-items-center justify-content-md-center">
										<div class="form-group">
											<br>
											<?php if (empty($key['gambar'])): ?>
												
												<img class="mr-4" src="<?= base_url('assets/img/dashboard/no_image.png'); ?>" alt="Default Logo"
													width="250">
											<?php else: ?>
												<img class="mr-4" src="<?= base_url('assets/img/profile/pelamar/'.$key['gambar']); ?>"
													alt="Logo Preview" width="250">
											<?php endif; ?>

											<input type="file" id="logo" name="logo_file" class="form-control-file mt-4"
												accept=".png, .jpg"><br>

											<small class="font-italic">*Ekstensi yang diperbolehkan adalah .jpg, .jpeg, .png</small><br>
											<small class="font-italic">*Size foto harus di bawah 3MB.</small><br>
											<small class="font-italic">*Ukuran foto harus 1:1 memperoleh hasil yang bagus.</small>
										</div>
									</div>
								</div>

								<div class="col-md-7 col-sm-12">
									<!-- nama pelamar -->
									<div class="form-group">
										<label for="nama">Nama Lengkap:</label>
										<input type="hidden" class="form-control" name="id"
											value="<?php echo $key['id_pelamar'] ?>">
										<input type="text" class="form-control" name="nama_lengkap"
											value="<?php echo $key['nama_lengkap']; ?>" required>
									</div>
		
									<!-- no hp -->
									<div class="form-group">
										<label for="no_tlp">Nomor Handphone:</label>
										<input type="text" class="form-control" name="no_hp"
											value="<?php echo $key['no_hp']; ?>" required>
									</div>
		
									<!-- alamat -->
									<div class="form-group">
										<label for="alamat">Alamat:</label>
										<textarea class="form-control" name="alamat" rows="3"
											required><?php echo $key['alamat']; ?></textarea>
									</div>
		
									<!-- Deskripsi Pelamar -->
									<div class="form-group">
										<label for="alamat">Deskripsi Singkat Pelamar:</label>
										<textarea class="form-control" name="deskripsi" rows="3"
											required><?php echo $key['deskripsi_pelamar']; ?></textarea>
									</div>
									<br>
									<button type="submit" class="btn btn-primary">Simpan Biodata</button>
								</div>
							</div>
						</form>
					</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="row">

			<!-- pendidikan -->
			<div class="col-sm-12 col-md-4">
				<div class="card">
					<div class="card-body">
							<!-- pendidikan -->
							<div class="form-group">
								<label for="pendidikan" style="font-size:20px;">PENDIDIKAN</label> <a type="button"
									class="btn btn-primary rounded-circle text-white" data-bs-toggle="modal"
									data-bs-target="#tambahPendidikan" style="margin-top:-5px;"><i class="fa-solid fa-plus"></i></a>

								<div class="w-100 p-3 mt-2 d-flex flex-wrap">
									<?php
                                            if(!$pendidikan):    
                                        ?>
									<p class="fw-bold text-black" style="font-size:15px;">Data Belum Ada</p>
									<?php
                                            else:     
                                        ?>
									<?php foreach($pendidikan as $data):?>

									<!-- bagian data -->
									<div class=" w-100 mx-1 my-2 p-2 shadow">
										<!-- Atas -->
										<div class="d-flex justify-content-between">
											<div class="">
												<p class="fw-bold text-black" style="font-size:15px;">
													<?= $data['bulan_mulai']?> <?= $data['tahun_mulai']?> -
													<?= $data['bulan_akhir']?> <?= $data['tahun_akhir']?></p>
											</div>
											<div class="">
												<div class="d-inline p-1">
													<a class="text-center fw-bold text-info" data-bs-toggle="modal"
														data-bs-target="#editPendidikan<?= $data['id_pendidikan']?>"><i
															class="fa-solid fa-pen"></i></a>
												</div>

												<div class="d-inline">
													<a class="text-center fw-bold text-danger" data-bs-toggle="modal"
														data-bs-target="#hapusPendidikan<?= $data['id_pendidikan']?>"><i
															class="fa-solid fa-trash"></i></a>
												</div>
											</div>
										</div>

										<!-- Bawah -->
										<h2 class="fw-bold" style="margin-top:-10px; font-size:20px;">
											<?= $data['nama_sekolah']?> (<?= $data['jenjang_pendidikan']?>)</h2>



										<h5 class="mt-2 italic" style="font-size:18px;"> <?= $data['bidang_studi']?>
										</h5>

										<h5 class="mt-2" style="font-size:18px;">Nilai Akhir <?= $data['nilai_akhir']?>
										</h5>
									</div>

									<?php endforeach;?>

									<?php 
                                            endif;
                                        ?>


								</div>
							</div>
					</div>
				</div>
			</div>

			<!-- pengalaman -->
			<div class="col-sm-12 col-md-4">
				<div class="card">
					<div class="card-body">

						<!-- Pengalaman -->
						<div class="form-group">
							<label for="pengalaman" style="font-size:20px;">PENGALAMAN</label> <a type="button"
								class="btn btn-primary rounded-circle text-white" data-bs-toggle="modal"
								data-bs-target="#tambahPengalaman" style="margin-top:-5px;"><i class="fa-solid fa-plus"></i></a>

							<div class="w-100 p-3 mt-2 d-flex flex-wrap">
								<?php
                                            if(!$pengalaman):    
                                        ?>
									<p class="fw-bold text-black" style="font-size:15px;">Data Belum Ada</p>
									<?php
                                            else:     
                                        ?>
									<?php foreach($pengalaman as $data):?>

									<!-- bagian data -->
									<div class=" w-100 mx-1 my-2 p-2 shadow">
										<!-- Atas -->
										<div class="d-flex justify-content-between">
											<!-- value 0 == masih kerja -->
											<!-- value 1 == sudah selesai kerja -->
											<?php if($data['status_kerja']  == 1 ):?>
												<div class="">
													<p class="fw-bold text-black" style="font-size:15px;"> <?= $data['bulan_mulai_kerja']?> <?= $data['tahun_mulai_kerja']?> - Sekarang</p>
												</div>
											<?php else:?>
												<div class="">
													<p class="fw-bold text-black" style="font-size:15px;"><?= $data['bulan_mulai_kerja']?> <?= $data['tahun_mulai_kerja']?> - <?= $data['bulan_akhir_kerja']?> <?= $data['tahun_akhir_kerja']?></p>
												</div>
											<?php endif;?>

											<div class="">
												<div class="d-inline p-1">
													<a class="text-center fw-bold text-info" data-bs-toggle="modal"
														data-bs-target="#editPengalaman<?= $data['id_pengalaman']?>"><i
															class="fa-solid fa-pen"></i></a>
												</div>

												<div class="d-inline">
													<a class="text-center fw-bold text-danger" data-bs-toggle="modal"
														data-bs-target="#hapusPengalaman<?= $data['id_pengalaman']?>"><i
															class="fa-solid fa-trash"></i></a>
												</div>
											</div>
										</div>

										<!-- Bawah -->
										<h2 class="fw-bold" style="margin-top:-10px; font-size:20px;">
											<?= $data['jabatan']?></h2>

										<h5 class=" text-secondary" style="font-size:18px; margin-top:-10px; font-style:italic;">
											<?= $data['nama_perusahaan']?></h5>
										<h5 class="italic" style="font-size:18px;"> <?= $data['lokasi_perusahaan']?>
										</h5>

										<h5 class="mt-2" style="font-size:18px;">Status Kerja
											<?= $data['status_pekerja']?> (<?= $data['sistem_kerja']?>)</h5>
									</div>

									<?php endforeach;?>

									<?php 
                                            endif;
                                        ?>


								</div>
							</div>

					</div>
				</div>
			</div>

			<!-- skill -->
			<div class="col-sm-12 col-md-4">
				<div class="card">
					<div class="card-body">
							<!-- Skill -->
							<div class="form-group">
								<label for="Skill" style="font-size:20px;">SKILL</label> 
								<a type="button"
									class="btn btn-primary rounded-circle text-white" data-bs-toggle="modal"
									data-bs-target="#tambahSkill" style="margin-top:-5px;"><i class="fa-solid fa-plus"></i></a>

								<div class="w-100 p-3 mt-2 d-flex flex-wrap">
									<?php
                                            if(!$skill):    
                                        ?>
									<p class="fw-bold text-black" style="font-size:15px;">Data Belum Ada</p>
									<?php
                                            else:     
                                        ?>
									<?php foreach($skill as $data):?>

									<!-- bagian data -->
									<div class=" w-100 mx-1 my-2 p-2 shadow">
										<!-- Atas -->
										<div class="d-flex justify-content-between">
											<div class="">
												<h5 class='fs-3 fw-bold'><?= $data['nama_skill']?></h5>
											</div>
											<div class="">
												<div class="d-inline p-1">
													<a class="text-center fw-bold text-info" data-bs-toggle="modal"
														data-bs-target="#editSkill<?= $data['id_skill']?>"><i
															class="fa-solid fa-pen"></i></a>
												</div>

												<div class="d-inline">
													<a class="text-center fw-bold text-danger" data-bs-toggle="modal"
														data-bs-target="#hapusSkill<?= $data['id_skill']?>"><i
															class="fa-solid fa-trash"></i></a>
												</div>
											</div>
										</div>

										<!-- Bawah -->
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

									<?php endforeach;?>

									<?php 
                                        endif;
                                    ?>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- ======================================================= PENDIDIKAN ==================================================== -->

<!-- Modal Tambah Pendidikan-->
<div class="modal fade" id="tambahPendidikan" tabindex="-1" aria-labelledby="TambahpendidikanModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="TambahpendidikanModalLabel">Pendidikan</h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('Pelamar/simpanPendidikan')?>" method="post">
					<div class="form-group">
						<label for="nama_sekolah">Nama Sekolah</label>
						<input type="text" class="form-control" name="nama_sekolah" placeholder="Masukkan nama sekolah"
							required>
					</div>
					<div class="form-group">
						<label for="jenjang_pendidikan">Jenjang Pendidikan</label>
						<select name="jenjang_pendidikan" class="form-control" id="" required>
							<option value="" hidden>-- PILIH --</option>
							<option value="SMA">SMA</option>
							<option value="SMK">SMK</option>
							<option value="D1">D1</option>
							<option value="D2">D2</option>
							<option value="D3">D3</option>
							<option value="D4">D4</option>
							<option value="S1">S1</option>
							<option value="S2">S2</option>
							<option value="S3">S3</option>
						</select>
					</div>
					<div class="form-group">
						<label for="bidang_studi">Bidang Studi</label>
						<input type="text" class="form-control" name="bidang_studi" placeholder="Masukkan Bidang Studi"
							required>
					</div>
					<div class="form-group">
						<label for="bulan_mulai">Bulan Mulai Sekolah</label>
						<select name="bulan_mulai" class="form-control" id="" required>
							<option value="" hidden>-- PILIH --</option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun_mulai">Tahun Mulai Sekolah</label>
						<input type="number" class="form-control" name="tahun_mulai" placeholder="Tahun mulai sekolah"
							min="0" required>
					</div>
					<div class="form-group">
						<label for="bulan_akhir">Bulan Tamat Sekolah</label>
						<select name="bulan_akhir" class="form-control" id="" required>
							<option value="" hidden>-- PILIH --</option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun_mulai">Tahun Tamat Sekolah</label>
						<input type="number" class="form-control" name="tahun_akhir" placeholder="Tahun akhir sekolah"
							min="0" required>
					</div>
					<div class="form-group">
						<label for="nilai_akhir">Nilai Akhir</label>
						<input type="text" class="form-control" name="nilai_akhir" placeholder="Nilai Akhir" required>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<!-- modal edit Pendidikan -->
<?php foreach($pendidikan as $key):?>
<div class="modal fade" id="editPendidikan<?= $key['id_pendidikan']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Data Pendidikan</h5>
			</div>

			<div class="modal-body">
				<form action="<?php echo base_url('Pelamar/updatePendidikan')?>" method="post">
					<input type="hidden" name="pendidikan" value="<?= $key['id_pendidikan']?>">

					<div class="form-group">
						<label for="nama_sekolah">Nama Sekolah</label>
						<input type="text" class="form-control" name="nama_sekolah" placeholder="Masukkan nama sekolah"
							value="<?= $key['nama_sekolah']?>" required>
					</div>
					<div class="form-group">
						<label for="jenjang_pendidikan">Jenjang Pendidikan</label>
						<select name="jenjang_pendidikan" class="form-control" id="" required>
							<option hidden value="<?= $key['jenjang_pendidikan']?>"><?= $key['jenjang_pendidikan']?>
							</option>
							<option value="SMA">SMA</option>
							<option value="SMK">SMK</option>
							<option value="D1">D1</option>
							<option value="D2">D2</option>
							<option value="D3">D3</option>
							<option value="D4">D4</option>
							<option value="S1">S1</option>
							<option value="S2">S2</option>
							<option value="S3">S3</option>
						</select>
					</div>
					<div class="form-group">
						<label for="bidang_studi">Bidang Studi</label>
						<input type="text" class="form-control" name="bidang_studi" value="<?= $key['bidang_studi']?>"
							placeholder="Masukkan Bidang Studi" required>
					</div>
					<div class="form-group">
						<label for="bulan_mulai">Bulan Mulai Sekolah</label>
						<select name="bulan_mulai" class="form-control" id="" required>
							<option hidden value="<?= $key['bulan_mulai']?>"><?= $key['bulan_mulai']?></option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun_mulai">Tahun Mulai Sekolah</label>
						<input type="number" class="form-control" name="tahun_mulai" value="<?= $key['tahun_mulai']?>"
							placeholder="Tahun mulai sekolah" min="0" required>
					</div>
					<div class="form-group">
						<label for="bulan_akhir">Bulan Tamat Sekolah</label>
						<select name="bulan_akhir" class="form-control" id="" required>
							<option hidden value="<?= $key['bulan_akhir']?>"><?= $key['bulan_akhir']?></option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tahun_mulai">Tahun Tamat Sekolah</label>
						<input type="number" class="form-control" name="tahun_akhir" value="<?= $key['tahun_akhir']?>"
							placeholder="Tahun akhir sekolah" min="0" required>
					</div>
					<div class="form-group">
						<label for="nilai_akhir">Nilai Akhir</label>
						<input type="text" class="form-control" name="nilai_akhir" value="<?= $key['nilai_akhir']?>"
							placeholder="Nilai Akhir" required>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>

<!-- modal Hapus Pendidikan -->
<?php foreach($pendidikan as $key):?>
<div class="modal fade" id="hapusPendidikan<?= $key['id_pendidikan']?>" tabindex="-1"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data Pendidikan</h5>
			</div>

			<div class="modal-body">
				Ingin Menghapus Data Pendidikan <b><?= $key['nama_sekolah']?></b>?
			</div>

			<div class="modal-footer">
				<form action="<?php echo base_url('Pelamar/hapusPendidikan/'.$key['id_pendidikan'])?>" method="post">
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>

<!-- ======================================================= PENGALAMAN ==================================================== -->

<!-- Modal Tambah pengalaman-->
<div class="modal fade" id="tambahPengalaman" tabindex="-1" aria-labelledby="TambahpendidikanModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="TambahpendidikanModalLabel">Pengalaman</h5>
			</div>

			<div class="modal-body">
				<form action="<?php echo base_url('Pelamar/simpanPengalaman')?>" method="post">

					<div class="form-group">
						<label for="jabatan">Jabatan</label>
						<input type="text" class="form-control" name="jabatan" placeholder="Jabatan Anda" required>
					</div>

					<div class="form-group">
						<label for="nama_perusahaan">Nama Company</label>
						<input type="text" class="form-control" name="nama_perusahaan"
							placeholder="Masukkan nama Company" required>
					</div>

					<div class="form-group">
						<label for="lokasi_perusahaan">Lokasi Kota Company</label>
						<input type="text" class="form-control" name="lokasi_perusahaan"
							placeholder="Masukkan Lokasi Company" required>
					</div>

					<div class="form-group">
						<label for="status_pekerja">Status Kerja</label>
						<select name="status_pekerja" class="form-control" id="" required>
							<option value="" hidden>-- PILIH --</option>
							<option value="full-time">full-time</option>
							<option value="part-time">part-time</option>
							<option value="self-employed">self-employed</option>
							<option value="freelance">freelance</option>
							<option value="kontrak">kontrak</option>
							<option value="internship">internship</option>
							<option value="apprenticeship">apprenticeship</option>
							<option value="seasonal">seasonal</option>
						</select>
					</div>

					<div class="form-group">
						<label for="sistem_kerja">Sistem Kerja</label>
						<select name="sistem_kerja" class="form-control" id="" required>
							<option value="" hidden>-- PILIH --</option>
							<option value="on-site">on-site</option>
							<option value="remote">remote</option>
							<option value="hybrid">hybrid</option>
						</select>
					</div>

					<div class="form-group">
						<label for="bulan_mulai_kerja">Bulan Mulai Kerja</label>
						<select name="bulan_mulai_kerja" class="form-control" id="" required>
							<option value="" hidden>-- PILIH --</option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>

					<div class="form-group">
						<label for="tahun_mulai_kerja">Tahun Mulai Kerja</label>
						<input type="number" class="form-control" name="tahun_mulai_kerja"
							placeholder="Tahun mulai Kerja" min="0" required>
					</div>

					<div class="form-group">
						<label for="status_kerja">Status Kerja</label>
						<select name="status_kerja" class="form-control" id="selectStatus">
							<option value="" hidden>-- PILIH --</option>
							<option value="1">Masih Berkerja</option>
							<option value="0">Sudah Selesai Berkerja</option>
						</select>
					</div>

					<div class="form-group" id="inputan1" style="display:none;">
						<label for="bulan_akhir_kerja">Bulan Selesai Kerja</label>
						<select name="bulan_akhir_kerja" class="form-control" id="">
							<option value="" hidden>-- PILIH --</option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>

					<div class="form-group" id="inputan2" style="display:none;">
						<label for="tahun_akhir_kerja">Tahun Selesai kerja</label>
						<input type="number" class="form-control" name="tahun_akhir_kerja"
							placeholder="Tahun selesai kerja" min="0">
					</div>


					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal edit Pengalaman -->
<?php foreach($pengalaman as $key):?>
<div class="modal fade" id="editPengalaman<?= $key['id_pengalaman']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Data Pengalaman</h5>
			</div>

			<div class="modal-body">

				<form action="<?php echo base_url('Pelamar/updatePengalaman')?>" method="post">
					<input type="hidden" name="pengalaman" value="<?= $key['id_pengalaman']?>">

					<div class="form-group">
						<label for="jabatan">Jabatan</label>
						<input type="text" class="form-control" name="jabatan" value="<?= $key['jabatan']?>"
							placeholder="Jabatan Anda" required>
					</div>

					<div class="form-group">
						<label for="nama_perusahaan">Nama Company</label>
						<input type="text" class="form-control" name="nama_perusahaan"
							value="<?= $key['nama_perusahaan']?>" placeholder="Masukkan nama Company" required>
					</div>

					<div class="form-group">
						<label for="lokasi_perusahaan">Lokasi Kota Company</label>
						<input type="text" class="form-control" name="lokasi_perusahaan"
							value="<?= $key['lokasi_perusahaan']?>" placeholder="Masukkan Lokasi Company" required>
					</div>

					<div class="form-group">
						<label for="status_pekerja">Status Kerja</label>
						<select name="status_pekerja" class="form-control" id="" required>
							<option value="<?= $key['status_pekerja']?>" hidden><?= $key['status_pekerja']?> </option>
							<option value="full-time">full-time</option>
							<option value="part-time">part-time</option>
							<option value="self-employed">self-employed</option>
							<option value="freelance">freelance</option>
							<option value="kontrak">kontrak</option>
							<option value="internship">internship</option>
							<option value="apprenticeship">apprenticeship</option>
							<option value="seasonal">seasonal</option>
						</select>
					</div>

					<div class="form-group">
						<label for="sistem_kerja">Sistem Kerja</label>
						<select name="sistem_kerja" class="form-control" id="" required>
							<option value="<?= $key['sistem_kerja']?>" hidden><?= $key['jabatan']?></option>
							<option value="on-site">on-site</option>
							<option value="remote">remote</option>
							<option value="hybrid">hybrid</option>
						</select>
					</div>

					<div class="form-group">
						<label for="bulan_mulai_kerja">Bulan Mulai Kerja</label>
						<select name="bulan_mulai_kerja" class="form-control" id="" required>
							<option value="<?= $key['bulan_mulai_kerja']?>" hidden><?= $key['bulan_mulai_kerja']?>
							</option>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>

					<div class="form-group">
						<label for="tahun_mulai_kerja">Tahun Mulai Kerja</label>
						<input type="number" class="form-control" name="tahun_mulai_kerja"
							value="<?= $key['tahun_mulai_kerja']?>" placeholder="Tahun mulai Kerja" min="0" required>
					</div>

					<div class="form-group">
						<label for="status_kerja">Status Kerja</label>
						<select name="status_kerja" class="form-control" id="statusUpdate<?= $key['id_pengalaman'] ?>">
							<?php if($key['status_kerja'] == 0):?>
								<option value="<?= $key['status_kerja']?>">Sudah Selesai Berkerja</option>
								<option value="1">Masih Berkerja</option>
							<?php else:?>
								<option value="<?= $key['status_kerja']?>">Masih Berkerja</option>
								<option value="0">Sudah Selesai Berkerja</option>
							<?php endif;?>
						</select>
					</div>

					<div class="form-group" id="InputUpdate1<?= $key['id_pengalaman'] ?>" style="display:none;">
						<label for="bulan_akhir_kerja">Bulan Selesai Kerja</label>
						<select name="bulan_akhir_kerja" class="form-control" id="bulan_akhir">
							<?php if($key['bulan_akhir_kerja'] == "NULL"):?>
								<option value="" hidden>-- PILIH --</option>
							<?php else:?>
								<option value="<?= $key['bulan_akhir_kerja']?>" hidden><?= $key['bulan_akhir_kerja']?></option>
							<?php endif;?>
							<option value="Januari">Januari</option>
							<option value="Februari">Februari</option>
							<option value="Maret">Maret</option>
							<option value="April">April</option>
							<option value="Mei">Mei</option>
							<option value="Juni">Juni</option>
							<option value="Juli">Juli</option>
							<option value="Agustus">Agustus</option>
							<option value="September">September</option>
							<option value="Oktober">Oktober</option>
							<option value="November">November</option>
							<option value="Desember">Desember</option>
						</select>
					</div>

					<div class="form-group" id="InputUpdate2<?= $key['id_pengalaman'] ?>" style="display:none;">
						<label for="tahun_akhir_kerja">Tahun Selesai kerja</label>
						<input type="number" class="form-control" name="tahun_akhir_kerja"
							placeholder="Tahun Selesai kerja" min="0" value="<?= $key['tahun_akhir_kerja']?>" id="tahun_akhir">
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" id="btn">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>

<!-- modal Hapus Pengalaman -->
<?php foreach($pengalaman as $key):?>
<div class="modal fade" id="hapusPengalaman<?= $key['id_pengalaman']?>" tabindex="-1"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data Pengalaman</h5>
			</div>

			<div class="modal-body">
				Ingin Menghapus Data Pengalaman <b><?= $key['jabatan']?></b>?
			</div>

			<div class="modal-footer">
				<form action="<?php echo base_url('Pelamar/hapusPengalaman/'.$key['id_pengalaman'])?>" method="post">
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>

<!-- ==================================================================== SKILL ================================================ -->
<!-- tambah skill modal -->
<div class="modal fade" id="tambahSkill" tabindex="-1" aria-labelledby="TambahpendidikanModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="TambahpendidikanModalLabel">Skill</h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url('Pelamar/simpanSKill')?>" method="post">
					<div class="form-group">
						<label for="nama_sekolah">Nama Skill</label>
						<input type="text" class="form-control" name="nama_skill" placeholder="Masukkan Nama Skill "
							required>
					</div>
					
					<div class="form-group">
						<label for="bidang_studi">Value</label>
						<input type="number" class="form-control" name="value" min="0" max="100" placeholder="Masukkan Nilai/Value Skill Anda"
							required>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

<!-- update skill modal -->
<?php foreach($skill as $key):?>
<div class="modal fade" id="editSkill<?= $key['id_skill']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Data Skill</h5>
			</div>

			<div class="modal-body">

				<form action="<?php echo base_url('Pelamar/updateSkill')?>" method="post">

					<input type="hidden" name="skill" value="<?= $key['id_skill']?>">

					<div class="form-group">
						<label for="jabatan">SKill</label>
						<input type="text" class="form-control" name="nama_skill" value="<?= $key['nama_skill']?>"
							placeholder="Nama Skill Anda" required>
					</div>

					<div class="form-group">
						<label for="nama_perusahaan">Value</label>
						<input type="number" class="form-control" name="value"
							value="<?= $key['value']?>" placeholder="Masukkan Nilai/Value Skill Anda"  min="0" max="100" required>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>

<!-- hapus skill modal -->
<?php foreach($skill as $key):?>
<div class="modal fade" id="hapusSkill<?= $key['id_skill']?>" tabindex="-1"
	aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data Skill</h5>
			</div>

			<div class="modal-body">
				Ingin Menghapus Data Skill <b><?= $key['nama_skill']?></b>?
			</div>

			<div class="modal-footer">
				<form action="<?php echo base_url('Pelamar/hapusSkill/'.$key['id_skill'])?>" method="post">
					<button type="submit" class="btn btn-danger">Hapus</button>
				</form>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
