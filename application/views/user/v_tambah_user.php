<div class="card">
	<div class="card-header">
		<h5>Tambah User</h5>
	</div>
	<div class="card-body">
		<form action="" method="POST">
			<div class="row">
				<div class="col mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" id="username" class="form-control" name="username" placeholder="Masukan username" value="<?= set_value('username') ?>" />
					<?= form_error('username', '<small class="text-danger">', '</small>') ?>
				</div>

				<div class="col mb-3">
					<label for="nama_lengkap" class="form-label">Nama Lengkap</label>
					<input type="text" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Masukan nama lengkap"  value="<?= set_value('nama_lengkap') ?>" />
					<?= form_error('nama_lengkap', '<small class="text-danger">', '</small>') ?>
				</div>

				<div class="col mb-3">
					<label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
					<select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
						<option value="">- Pilih Jenis Kelamin</option>
						<option value="1">Laki - laki</option>
						<option value="2">Perempuan</option>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Masukan password">
					<?= form_error('password', '<small class="text-danger">', '</small>') ?>
				</div>

				<div class="col mb-3">
					<label for="cpassword" class="form-label">Confirm Password</label>
					<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Masukan kembali password">
					<?= form_error('cpassword', '<small class="text-danger">', '</small>') ?>
				</div>
			</div>

			<div class="mb-3">
				<label for="role" class="form-label">Role</label>
				<select name="role" id="role" class="form-select">
					<option value="">- Pilih Role User -</option>
					<?php foreach ($roles as $role) : ?>
						<option value="<?= $role->id_role ?>"><?= $role->role ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<button type="submit" class="btn btn-success">Tambah User</button>
		</form>
	</div>
</div>
