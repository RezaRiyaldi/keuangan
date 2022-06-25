<div class="card mb-3">
	<h3 class="card-header">Laporan Keuangan</h3>
</div>
<div class="row mb-3">
	<div class="col-md-4 mb-3">
		<div class="card">
			<h5 class="card-header">Hari Ini (<?= date('d F') ?>)</h5>
			<div class="card-body">
				<p class="mb-0">Pemasukan: <b>Rp. <?= $jumlah_kas['per_hari']->jumlah == '' ? '0' : $jumlah_kas['per_hari']->jumlah ?></b></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<h5 class="card-header">Bulan Ini (<?= date('F Y') ?>)</h5>
			<div class="card-body">
				<p class="mb-0">Pemasukan: <b>Rp. <?= $jumlah_kas['per_bulan']->jumlah == '' ? '0' : $jumlah_kas['per_bulan']->jumlah ?></b></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<h5 class="card-header">Tahun Ini (<?= date('Y') ?>)</h5>
			<div class="card-body">
				<p class="mb-0">Pemasukan: <b>Rp. <?= $jumlah_kas['per_tahun']->jumlah == '' ? '0' : $jumlah_kas['per_tahun']->jumlah ?></b></p>
			</div>
		</div>
	</div>
</div>

<div class="card mb-3">
	<h3 class="card-header">Laporan Parkir</h3>
</div>

<div class="row">
	<div class="col-md-6 mb-3">
		<div class="card">
			<h5 class="card-header">Kendaraan yang Masih Parkir</h5>
			<div class="card-body">
				<table class="table table-striped table-bordered">
					<tr class="text-center">
						<th>Jenis Kendaraan</th>
						<th>Jumlah Kendaraan</th>
					</tr>
					<?php
					if ($parkir_active != NULL) :
						foreach ($parkir_active as $parkir_1) : ?>
							<tr>
								<td><?= $parkir_1->jenis_kendaraan ?></td>
								<td class="text-center"><?= $parkir_1->jumlah ?></td>
							</tr>
						<?php endforeach ?>
					<?php else : ?>
						<tr>
							<td class="text-center" colspan="2">Data Masih Kosong</td>
						</tr>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6 mb-3">
		<div class="card">
			<h5 class="card-header">Kendaraan yang Pernah Parkir</h5>
			<div class="card-body">
				<table class="table table-striped table-bordered">
					<tr class="text-center">
						<th>Jenis Kendaraan</th>
						<th>Jumlah Kendaraan</th>
					</tr>
					<?php
					if ($parkir_non_active != NULL) :
						foreach ($parkir_non_active as $parkir_0) : ?>
							<tr>
								<td><?= $parkir_0->jenis_kendaraan ?></td>
								<td class="text-center"><?= $parkir_0->jumlah ?></td>
							</tr>
						<?php endforeach ?>
					<?php else : ?>
						<tr>
							<td class="text-center" colspan="2">Data Masih Kosong</td>
						</tr>
					<?php endif ?>
				</table>
			</div>
		</div>
	</div>
</div>
