<?php
class Parkir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ParkirModel', 'parkir');
		if (!$this->session->logged_in) {
			redirect('/');
		} else if ($this->session->role != 'Parkir') {
			redirect('403');
		}
	}

	public function parkir_manage()
	{
		$get_all_parkir = $this->parkir->get_all_parkir();
		$get_all_jenis_kendaraan = $this->parkir->get_all_jenis_kendaraan();

		// dd($get_all_parkir);

		if (!$get_all_jenis_kendaraan) {
			$this->session->set_flashdata('error', 'Mohon tambahkan jenis kendaraan terlebih dahulu!');
			redirect('jenis-kendaraan-manage');
		}

		$data = [
			'title' => 'Parkir Management',
			'content' => 'parkir/v_parkir_management',
			'all_parkir' => $get_all_parkir,
			'all_jenis_kendaraan' => $get_all_jenis_kendaraan,
		];

		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_parkir()
	{
		$this->form_validation->set_rules(
			'jenis_kendaraan',
			'Parkir',
			'required|trim',
			[
				'required' => 'Parkir wajib diisi ges'
			]
		);
		$this->form_validation->set_rules(
			'plat',
			'Plat',
			'required|trim',
			[
				'required' => 'Plat wajib diisi ges'
			]
		);

		if ($this->form_validation->run() === FALSE) {
			$get_all_jenis_kendaraan = $this->parkir->get_all_jenis_kendaraan();
			$data = [
				'title' => 'Tambah Parkir',
				'content' => 'parkir/v_tambah_parkir',
				'all_jenis_kendaraan' => $get_all_jenis_kendaraan
			];

			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$insert = $this->parkir->tambah_parkir($input);
			$this->session->set_flashdata($insert->type_message, $insert->message);

			if ($insert->success) {
				redirect('parkir-manage');
			} else {
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function selesai($id_parkir)
	{
		$selesai = $this->parkir->selesai_parkir($id_parkir);

		$this->session->set_flashdata($selesai->type_message, $selesai->message);

		redirect('parkir-manage');
	}

	public function jenis_kendaraan_manage()
	{
		$get_all_jenis_kendaraan = $this->parkir->get_all_jenis_kendaraan();
		$data = [
			'title' => 'Jenis Kendaraan',
			'content' => 'parkir/v_jenis_kendaraan_management',
			'all_jenis_kendaraan' => $get_all_jenis_kendaraan,
		];

		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_jenis_kendaraan()
	{
		$this->form_validation->set_rules(
			'jenis_kendaraan',
			'Jenis Kendaraan',
			'required|trim|is_unique[jenis_kendaraan.jenis_kendaraan]',
			[
				'required' => 'Jenis Kendaraan wajib diisi ges',
				'is_unique' => 'Jenis Kendaraan ini sudah pernah ditambahkan'
			]
		);
		$this->form_validation->set_rules(
			'harga_perhari',
			'Harga Perhari',
			'required|trim',
			[
				'required' => 'Harga Perhari wajib diisi ges'
			]
		);

		if ($this->form_validation->run() === FALSE) {
			$data = [
				'title' => 'Tambah Jenis Kendaraan',
				'content' => 'parkir/v_tambah_jenis_kendaraan'
			];

			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$insert = $this->parkir->tambah_jenis_kendaraan($input);
			$this->session->set_flashdata($insert->type_message, $insert->message);

			redirect('jenis-kendaraan-manage');
		}
	}

	public function edit_jenis_kendaraan($id_jenis_kendaraan)
	{
		$this->form_validation->set_rules(
			'jenis_kendaraan',
			'Jenis Kendaraan',
			'required|trim',
			[
				'required' => 'Jenis Kendaraan wajib diisi ges'
			]
		);
		$this->form_validation->set_rules(
			'harga_perhari',
			'Harga Perhari',
			'required|trim',
			[
				'required' => 'Harga Perhari wajib diisi ges'
			]
		);

		if ($this->form_validation->run() === FALSE) {
			$get_jenis_kendaraan = $this->parkir->get_jenis_kendaraan($id_jenis_kendaraan);

			$data = [
				'title' => 'Edit Jenis Kendaraan',
				'content' => 'parkir/v_edit_jenis_kendaraan',
				'jenis_kendaraan' => $get_jenis_kendaraan
			];

			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$update = $this->parkir->edit_jenis_kendaraan($input, $id_jenis_kendaraan);
			$this->session->set_flashdata($update->type_message, $update->message);

			redirect('jenis-kendaraan-manage');
		}
	}

	public function delete_jenis_kendaraan($id_jenis_kendaraan)
	{
		$delete = $this->parkir->delete_jenis_kendaraan($id_jenis_kendaraan);

		$this->session->set_flashdata($delete->type_message, $delete->message);

		redirect('jenis-kendaraan-manage');
	}
}
