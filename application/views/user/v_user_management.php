<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h5 class="align-middle my-auto">User Management</h5>
		<a href="<?= base_url() ?>user/tambah-user" class="btn btn-success">+ User</a>
	</div>
	<div class="card-body">
		<table class="table table-responsive" id="example">
			<thead>
				<tr>
					<th>No</th>
					<th>Foto</th>
					<th>Username</th>
					<th>Nama Lengkap</th>
					<th>Roles</th>
					<th>Aksi</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$no = 1;
				if ($users != NULL) :
					foreach ($users as $user) :
				?>
						<tr>
							<td><?= $no++ ?></td>
							<td>
								<img src="<?= base_url() ?>assets/img/avatars/<?= $user->foto ?>" alt="" class="rounded-circle" style="width: 35px;">
							</td>
							<td><?= $user->username ?></td>
							<td><?= $user->nama_lengkap ?></td>
							<td><?= $user->role ?></td>
							<td>
								<div class="dropdown">
									<button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="bx bx-dots-vertical-rounded"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
										<a class="dropdown-item" href="<?= base_url() ?>user/edit-user/<?= $user->id_user ?>">Edit</a>
										<a class="dropdown-item" href="<?= base_url() ?>user/delete-user/<?= $user->id_user ?>" onclick="return confirm('Apakah anda yakin ingin menghapus <?= $user->nama_lengkap ?>?')">Delete</a>
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
