<div class="card mb-3">
	<!-- <div class="card-body"> -->
	<div class="card-header d-flex justify-content-between">
		<h5 class="align-middle my-auto">Parkir Management</h5>
		<a href="<?= base_url() ?>parkir/tambah-parkir" class="btn btn-success">+ Parkir</a>
	</div>
</div>
<div class="nav-align-top mb-4">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#status-active" aria-controls="status-active" aria-selected="true">
				<i class="tf-icons bx bx-home"></i> Active
				<span class="badge bg-warning"><?= $this->db->get_where('parkir', ['status' => 'active'])->num_rows() ?></span>
			</button>
		</li>
		<li class="nav-item">
			<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#status-non-active" aria-controls="status-non-active" aria-selected="false">
				<i class="tf-icons bx bx-user"></i> Non-active
				<span class="badge bg-danger"><?= $this->db->get_where('parkir', ['status' => 'non-active'])->num_rows() ?></span>
			</button>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade table-responsive show active" id="status-active" role="tabpanel">
			<table class="table nowrap" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Status</th>
						<th>Jenis Kendaraan</th>
						<th>Plat Nomer</th>
						<th>Waktu Masuk</th>
						<th>Aksi</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$no = 1;
					// dd($all_parkir);
					if ($all_parkir != NULL) :
						foreach ($all_parkir as $parkir) :
							if ($parkir->status == "active") :
					?>
							<tr>
								<td><?= $no++ ?></td>
								<td>
									<p class="badge <?= $parkir->status == 'active' ? 'bg-info' : 'bg-danger' ?> mb-0"><?= $parkir->status ?></p>
								</td>
								<td><?= $parkir->jenis_kendaraan ?></td>
								<td><?= $parkir->plat ?></td>
								<td><?= $parkir->jam_masuk . " " . $parkir->tanggal_parkir ?></td>
								<td>
									<?php if ($parkir->status == 'active') { ?>
										<a class="btn btn-warning btn-sm" href="<?= base_url() ?>parkir/selesai/<?= $parkir->id_parkir ?>" onclick="return confirm('Anda yakin kendaraan dengan Plat: <?= $parkir->plat ?> ingin keluar?')">Keluar</a>
									<?php } else { ?>
										<button disabled="disabled" class="btn btn-secondary btn-sm">Selesai</button>
									<?php } ?>
								</td>
							</tr>

						<?php endif; endforeach; ?>
					<?php else : ?>
						<tr>
							<td class="text-center" colspan="6">Data masih kosong</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade table-responsive" id="status-non-active" role="tabpanel">
			<table class="table nowrap" id="example2">
				<thead>
					<tr>
						<th>No</th>
						<th>Status</th>
						<th>Waktu Masuk</th>
						<th>Jenis Kendaraan</th>
						<th>Plat Nomer</th>
						<th>Petugas</th>
					</tr>
				</thead>

				<tbody>
					<?php
					$no = 1;
					// dd($all_parkir);
					if ($all_parkir != NULL) :
						foreach ($all_parkir as $parkir) :
							if ($parkir->status == "non-active") :
					?>
								<tr>
									<td><?= $no++ ?></td>
									<td>
										<p class="badge bg-danger mb-0"><?= $parkir->status ?></p>
									</td>
									<td width="20%"><?= $parkir->jam_masuk . " " . $parkir->tanggal_parkir ?></td>
									<td><?= $parkir->jenis_kendaraan ?></td>
									<td><?= $parkir->plat ?></td>
									<td><?= $parkir->nama_lengkap ?></td>
								</tr>

						<?php endif;
						endforeach; ?>
					<?php else : ?>
						<tr>
							<td class="text-center" colspan="6">Data masih kosong</td>
						</tr>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
