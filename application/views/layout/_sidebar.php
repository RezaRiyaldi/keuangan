<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="index.html" class="app-brand-link">
			<span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize">Keuangan</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1">
		<!-- Dashboard -->
		<li class="menu-item <?= $this->uri->segment(1) == '' ? 'active' : ''; ?>">
			<a href="<?= base_url() ?>" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div data-i18n="Dashboard">Dashboard</div>
			</a>
		</li>

		<li class="menu-item 
			<?php
			if (
				$this->uri->segment(1) == 'user-manage' ||
				$this->uri->segment(1) == 'list-users' ||
				$this->uri->segment(1) == 'setting-profile' ||
				$this->uri->segment(2) == 'edit-user'
			) {
				echo 'active open';
			} ?>">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons bx bx-user"></i>
				<div data-i18n="User">User</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item <?= $this->uri->segment(1) == 'list-users' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>list-users" class="menu-link">
						<div data-i18n="List Users">List Users</div>
					</a>
				</li>

				<li class="menu-item <?= $this->uri->segment(1) == 'setting-profile' ? 'active' : '' ?>">
					<a href="<?= base_url() ?>setting-profile" class="menu-link">
						<div data-i18n="Setting Profile">Setting Profile</div>
					</a>
				</li>
				<?php if ($this->session->role == 'Admin') : ?>
					<li class="menu-item <?= $this->uri->segment(1) == 'user-manage' ||  $this->uri->segment(2) == 'edit-user' ? 'active' : '' ?>">
						<a href="<?= base_url() ?>user-manage" class="menu-link">
							<div data-i18n="User Management">User Management</div>
						</a>
					</li>
				<?php endif ?>
			</ul>
		</li>

		<li class="menu-item <?= $this->uri->segment(1) == 'kas' ? 'active' : '' ?>">
			<a href="<?= base_url() ?>kas" class="menu-link">
				<i class='menu-icon bx bx-wallet'></i>
				<div data-i18n="Kas">Kas</div>
			</a>
		</li>
		<!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Parkir</span></li> -->
		<li class="menu-item 
			<?php
			if (
				$this->uri->segment(1) == 'parkir-manage' ||
				$this->uri->segment(2) == 'tambah-parkir' ||
				$this->uri->segment(1) == 'jenis-kendaraan-manage' ||
				$this->uri->segment(2) == 'tambah-jenis-kendaraan' ||
				$this->uri->segment(2) == 'edit-jenis-kendaraan'
			) {
				echo 'active open';
			} ?>">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class='menu-icon bx bxs-car-garage'></i>
				<div data-i18n="Parkir">Parkir</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item 
					<?php
					if (
						$this->uri->segment(1) == 'parkir-manage' ||  $this->uri->segment(2) == 'tambah-parkir'
					) {
						echo 'active';
					} ?>">
					<a href="<?= base_url() ?>parkir-manage" class="menu-link">
						<div data-i18n="Parkir Management">Parkir Management</div>
					</a>
				</li>
				<li class="menu-item 
				<?php
				if (
					$this->uri->segment(1) == 'jenis-kendaraan-manage' ||
					$this->uri->segment(2) == 'tambah-jenis-kendaraan' ||
					$this->uri->segment(2) == 'edit-jenis-kendaraan'
				) {
					echo "active";
				} ?>">
					<a href="<?= base_url() ?>jenis-kendaraan-manage" class="menu-link">
						<div data-i18n="Jenis Kendaraan">Jenis Kendaraan Management</div>
					</a>
				</li>
			</ul>
		</li>
	</ul>
</aside>

<!-- Layout container -->
<div class="layout-page">
