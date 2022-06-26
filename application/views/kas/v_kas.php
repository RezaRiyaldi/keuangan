<div class="card mb-3">
	<div class="card-header">
		<h3 class="align-middle my-auto">Kas</h3>
	</div>
</div>

<div class="nav-align-top mb-4">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#pemasukan" aria-controls="pemasukan" aria-selected="true">
				<i class="tf-icons bx bx-download"></i> Pemasukan
			</button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#pengeluaran" aria-controls="pengeluaran" aria-selected="false">
				<i class="tf-icons bx bx-upload"></i> Pengeluaran
			</button>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade table-responsive show active" id="pemasukan" role="tabpanel">
			<table class="table nowrap" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis</th>
						<th>Jumlah</th>
						<th>Tanggal</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$no = 1;
					foreach ($kas_masuk as $kas) :
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $kas->jenis_transaksi ?></td>
							<td>Rp. <?= $kas->jumlah ?></td>
							<td><?= $kas->tanggal_transaksi ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade table-responsive" id="pengeluaran" role="tabpanel">
			<a href="<?= base_url() ?>kas/tambah-pengeluaran" class="btn btn-warning mb-3">+ Pengeluaran</a>
			<table class="table nowrap" id="example2">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis</th>
						<th>Jumlah</th>
						<th>Tanggal</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$no = 1;
					foreach ($kas_keluar as $kas) :
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $kas->jenis_transaksi ?></td>
							<td>Rp. <?= $kas->jumlah ?></td>
							<td><?= $kas->tanggal_transaksi ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card">
	<h4 class="card-header">Saldo</h4>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table nowrap">
				<thead>
					<tr>
						<th>No</th>
						<th>Tipe Kas</th>
						<th>Jenis</th>
						<th>Tanggal</th>
						<th>Jumlah</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$no = 1;
					foreach ($kas_semua as $kas) :
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td>
								<span class="badge <?= $kas->tipe_transaksi == 1 ? 'bg-success' : 'bg-danger' ?>">
									<?= $kas->tipe_transaksi == 1 ? 'Pemasukan' : 'Pengeluaran' ?>
								</span>
							</td>
							<td><?= $kas->jenis_transaksi ?></td>
							<td><?= $kas->tanggal_transaksi ?></td>
							<td>Rp. <?= $kas->tipe_transaksi == 1 ? '' : '-' ?><?= $kas->jumlah ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4" class="text-center">Total Saldo</th>
						<td>Rp. <?= $total ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
