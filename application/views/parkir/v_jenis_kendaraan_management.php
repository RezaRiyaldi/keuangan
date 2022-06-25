<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h5 class="align-middle my-auto">Jenis Kendaraan Management</h5>
		<a href="<?= base_url() ?>parkir/tambah-jenis-kendaraan" class="btn btn-success">+ Jenis Kendaraan</a>
	</div>
	<div class="card-body table-responsive">
		<table class="table nowrap" id="example">
			<thead>
				<tr>
					<th>No</th>
					<th>Jenis Kendaraan</th>
					<th>Harga Perhari</th>
					<th>Aksi</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$no = 1;
				if ($all_jenis_kendaraan != NULL) :
					foreach ($all_jenis_kendaraan as $jenis_kendaraan) :
				?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $jenis_kendaraan->jenis_kendaraan ?></td>
							<td>Rp. <?= $jenis_kendaraan->harga_perhari ?></td>
							<td>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
										<a class="dropdown-item" href="<?= base_url() ?>parkir/edit-jenis-kendaraan/<?= $jenis_kendaraan->id_jenis_kendaraan ?>">Edit</a>
										<a class="dropdown-item" href="<?= base_url() ?>parkir/delete-jenis-kendaraan/<?= $jenis_kendaraan->id_jenis_kendaraan ?>" onclick="return confirm('Apakah anda yakin ingin menghapus <?= $jenis_kendaraan->jenis_kendaraan ?>?')">Delete</a>
									</div>
								</div>
							</td>
						</tr>

					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td class="text-center" colspan="4">Data masih kosong</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>

<?php
// dd($this->session);
