<div class="card">
	<div class="card-header">
		<h5>Edit Jenis Kendaraan</h5>
	</div>
	<div class="card-body">
		<form action="<?= base_url() ?>parkir/edit-jenis-kendaraan/<?= $jenis_kendaraan->id_jenis_kendaraan ?>" method="POST">
			<div class="mb-3">
				<label for="jenis_kendaraan" class="form-label">Jenis Kendaraan</label>
				<input type="text" id="jenis_kendaraan" class="form-control" name="jenis_kendaraan" placeholder="Masukan jenis kendaraan" value="<?= $jenis_kendaraan->jenis_kendaraan ?>" />
				<?= form_error('jenis_kendaraan', '<small class="text-danger">', '</small>') ?>
			</div>

			<div class="mb-3">
				<label for="harga_perhari" class="form-label">Harga Perhari</label>
				<input type="number" id="harga_perhari" class="form-control" name="harga_perhari" placeholder="Masukan harga perhari" value="<?= $jenis_kendaraan->harga_perhari ?>" />
				<?= form_error('harga_perhari', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-warning">Edit Jenis Kendaraan</button>
		</form>
	</div>
</div>
