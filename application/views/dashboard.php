<div class="card">
	<h2 class="card-header">Laporan Keuangan</h2>
</div>
<div class="row mt-3 mb-4">
	<div class="col-md-4 mb-3">
		<div class="card">
			<h5 class="card-header">Hari Ini</h5>
			<div class="card-body">
				<p class="mb-0">Pemasukan: <b>Rp. <?= $jumlah_kas['per_hari']->jumlah ?></b></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<h5 class="card-header">Bulan Ini</h5>
			<div class="card-body">
				<p class="mb-0">Pemasukan: <b>Rp. <?= $jumlah_kas['per_bulan']->jumlah ?></b></p>
			</div>
		</div>
	</div>
	<div class="col-md-4 mb-3">
		<div class="card">
			<h5 class="card-header">Tahun Ini</h5>
			<div class="card-body">
				<p class="mb-0">Pemasukan: <b>Rp. <?= $jumlah_kas['per_tahun']->jumlah ?></b></p>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<h2 class="card-header">Laporan Parkir</h2>
</div>

<div class="row mt-3 mb-5">
	<div class="col-md-3">
		<div class="card">
			<h5 class="card-header">Kendaraan Terparkir</h5>
			<div class="card-body"></div>
		</div>
	</div>
</div>
