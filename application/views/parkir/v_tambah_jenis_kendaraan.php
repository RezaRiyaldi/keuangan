<div class="card">
	<div class="card-header">
		<h5>Tambah Jenis Kendaraan</h5>
	</div>
	<div class="card-body">
		<form action="" method="POST">
			<div class="mb-3">
				<label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
				<input type="text" id="jenis_kendaraan" class="form-control" name="jenis_kendaraan" placeholder="Masukan jenis kendaraan" value="<?= set_value('jenis_kendaraan') ?>" />
				<?= form_error('jenis_kendaraan', '<small class="text-danger">', '</small>') ?>
			</div>

			<div class="mb-3">
				<label for="harga_perhari" class="form-label">Harga Perhari</label>
				<input type="number" id="harga_perhari" class="form-control" name="harga_perhari" placeholder="Masukan harga perhari" value="<?= set_value('harga_perhari') ?>" />
				<?= form_error('harga_perhari', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-success">Tambah Jenis Kendaraan</button>
		</form>
	</div>
</div>
