<div class="card">
	<div class="card-header">
		<h5>Tambah Pengeluaran</h5>
	</div>
	<div class="card-body">
		<form action="" method="POST">

			<div class="mb-3">
				<label for="jenis_pengeluaran" class="form-label">Alokasi</label>
				<input type="text" id="jenis_pengeluaran" class="form-control" name="jenis_pengeluaran" placeholder="Masukan Jenis Pengeluaran" value="<?= set_value('jenis_pengeluaran') ?>" />
				<?= form_error('jenis_pengeluaran', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="mb-3">
				<label for="nominal" class="form-label">Nominal</label>
				<input type="number" id="nominal" class="form-control" name="jumlah" placeholder="Masukan nominal" value="<?= set_value('nominal') ?>" />
				<?= form_error('nominal', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-warning">Tambah Pengeluaran</button>
		</form>
	</div>
</div>
