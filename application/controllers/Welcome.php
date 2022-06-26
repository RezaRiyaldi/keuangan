<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ParkirModel', 'parkir');
	}

	public function index()
	{
		if (!$this->session->logged_in) {
			redirect('user/login');
		}

		$kas_masuk = [
			'per_tahun' => $this->parkir->get_jumlah_kas('tahun', 1),
			'per_bulan' => $this->parkir->get_jumlah_kas('bulan', 1),
			'per_hari' => $this->parkir->get_jumlah_kas('hari', 1)
		];

		$kas_keluar = [
			'per_tahun' => $this->parkir->get_jumlah_kas('tahun', 0),
			'per_bulan' => $this->parkir->get_jumlah_kas('bulan', 0),
			'per_hari' => $this->parkir->get_jumlah_kas('hari', 0)
		];

		$parkir_active = $this->parkir->get_jumlah_parkir('active');
		$parkir_non_active = $this->parkir->get_jumlah_parkir('non-active');

		$data = [
			'title' => 'Dashboard',
			'content' => 'dashboard',
			'jumlah_kas_masuk' => $kas_masuk,
			'jumlah_kas_keluar' => $kas_keluar,
			'parkir_active' => $parkir_active,
			'parkir_non_active' => $parkir_non_active
		];

		// dd($data);
		$this->load->view('layout/wrapper', $data);
	}

	public function not_found()
	{
		$this->load->view('not_found');
	}

	public function forbidden()
	{
		$this->load->view('forbidden403');
	}
}
