<div class="card">
	<div class="card-header d-flex justify-content-between">
		<h5 class="align-middle my-auto"><?= $title ?></h5>
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
						</tr>

					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td class="text-center" colspan="3">Data masih kosong</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
