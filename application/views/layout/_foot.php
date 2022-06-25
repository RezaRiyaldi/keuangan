<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?= base_url() ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="<?= base_url() ?>assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= base_url() ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="<?= base_url() ?>assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?= base_url() ?>assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script>
	// $(document).ready(function() {
	$('#example').DataTable({
		responsive: true
	});
	$('#example2').DataTable({
		responsive: true
	});
	// });
</script>
</body>

</html>
