<div class="card">
	<div class="card-header">
		<h5>Tambah Parkir</h5>
	</div>
	<div class="card-body">
		<form action="" method="POST">
			<div class="mb-3">
				<label for="" class="form-label">Jenis Kendaraan</label>
				<select name="jenis_kendaraan" id="" class="form-select">
					<option value="">- Pilih Jenis Kendaraan -</option>

					<?php foreach ($all_jenis_kendaraan as $jenis_kendaraan) : ?>
						<option value="<?= $jenis_kendaraan->id_jenis_kendaraan ?>"><?= $jenis_kendaraan->jenis_kendaraan ?></option>
						<?php endforeach ?>
				</select>
			</div>

			<div class="mb-3">
				<label for="plat" class="form-label">Plat</label>
				<input type="text" id="plat" class="form-control" name="plat" placeholder="Masukan Plat Nomer" value="<?= set_value('plat') ?>" />
				<?= form_error('plat', '<small class="text-danger">', '</small>') ?>
			</div>
			<button type="submit" class="btn btn-success">Tambah Parkir</button>
		</form>
	</div>
</div>
