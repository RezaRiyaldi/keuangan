<div class="content-wrapper">
	<!-- Content -->

	<div class="container-xxl flex-grow-1 container-p-y">
		<?php
		if (!empty($this->session->error)) { ?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<?= $this->session->error ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
		} else if (!empty($this->session->success)) { ?>
			<div class="alert alert-primary alert-dismissible fade show" role="alert">
				<?= $this->session->success ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php
		}
		?>
		<?php
		if (isset($content)) {
			$this->load->view($content);
		}
		?>
	</div>
	<!-- / Content -->

	<div class="content-backdrop fade"></div>
</div>
