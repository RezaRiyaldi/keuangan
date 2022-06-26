<div class="row">
	<div class="col-md-12">
		<div class="card mb-4">
			<h2 class="card-header">Profile Details</h2>
			<!-- Account -->
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 mb-3">
						<table class="table table-bordered table-striped">
							<tr>
								<th>Username</th>
								<td><?= $user->username ?></td>
							</tr>
							<tr>
								<th>Nama</th>
								<td><?= $user->nama_lengkap ?></td>
							</tr>
							<tr>
								<th>Jabatan</th>
								<td><?= $user->role ?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-6">
						<div class="d-flex align-items-start align-items-sm-center gap-4">
							<img src="<?= base_url() ?>assets/img/avatars/<?= $user->foto ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
							<div class="button-wrapper">
								<label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0" data-bs-toggle="modal" data-bs-target="#backDropModal">
									<span class="d-none d-sm-block">Upload new photo</span>
									<i class="bx bx-upload d-block d-sm-none"></i>
								</label>
								<a href="<?= base_url() ?>auth/hapus_foto" onclick="return confirm('Apakah anda yakin ingin menghapus foto?')" class="btn btn-outline-secondary account-image-reset mb-4">
									<i class="bx bx-reset d-block d-sm-none"></i>
									<span class="d-none d-sm-block">Reset</span>
								</a>

								<p class="alert alert-warning mb-0">Hanya boleh format JPG dan PNG</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr class="my-0" />
			<div class="card-body">
				<h3>Ubah Akun</h3>
				<form action="" method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" id="username" class="form-control" name="username" placeholder="Masukan username" value="<?= $user->username ?>" />
							<?= form_error('username', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="col-md-6 mb-3">
							<label for="nama_lengkap" class="form-label">Nama Lengkap</label>
							<input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Masukan nama lengkap" value="<?= $user->nama_lengkap ?>" />
							<?= form_error('nama_lengkap', '<small class="text-danger">', '</small>') ?>
						</div>
					</div>

					<p class="alert alert-warning">Kosongkan password apabila tidak ingin mengganti password</p>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Masukan password">
							<?= form_error('password', '<small class="text-danger">', '</small>') ?>
						</div>

						<div class="col-md-6 mb-3">
							<label for="cpassword" class="form-label">Confirm Password</label>
							<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Masukan kembali password">
							<?= form_error('cpassword', '<small class="text-danger">', '</small>') ?>
						</div>
					</div>

					<button type="submit" class="btn btn-warning">Edit Akun</button>
				</form>

			</div>
			<!-- /Account -->
		</div>
	</div>
</div>


<div class="col-lg-4 col-md-3">
	<div class="mt-3">
		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="backDropModalTitle">Ubah Foto
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<?= form_open_multipart(base_url() . 'auth/upload_foto') ?>
					<div class="modal-body">
						<label for="foto" class="form-label">Foto</label>
						<input type="file" id="foto" class="form-control" name="foto" />
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary">Upload</button>
					</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
