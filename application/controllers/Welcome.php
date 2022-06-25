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

		$kas = [
			'per_tahun' => $this->parkir->get_jumlah_kas('tahun'),
			'per_bulan' => $this->parkir->get_jumlah_kas('bulan'),
			'per_hari' => $this->parkir->get_jumlah_kas('hari')
		];

		$parkir_active = $this->parkir->get_jumlah_parkir('active');
		$parkir_non_active = $this->parkir->get_jumlah_parkir('non-active');

		$data = [
			'title' => 'Dashboard',
			'content' => 'dashboard',
			'jumlah_kas' => $kas,
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
