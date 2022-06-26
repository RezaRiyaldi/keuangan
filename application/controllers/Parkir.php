<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Parkir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ParkirModel', 'parkir');

		if (!$this->session->logged_in) {
			redirect('/');
		} else if ($this->session->role != 'Parkir' && $this->session->role != 'Admin') {
			redirect('403');
		}
	}

	public function cetak_laporan_parkir()
	{	
		$all_parkir = $this->parkir->get_all_parkir();

		// dd($all_parkir);
		$spreadsheet = new Spreadsheet();
		$filename = 'laporan-parkir_' . date('Y-m-d_H-i-s');
		$no = 1;
		$x = 2;

		// Setting Value
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Jenis Kendaraan');
		$sheet->setCellValue('C1', 'Nomor Polisi');
		$sheet->setCellValue('D1', 'Status');
		$sheet->setCellValue('E1', 'Waktu Masuk');
		$sheet->setCellValue('F1', 'Waktu Keluar');
		$sheet->setCellValue('G1', 'Harga Parkir');

		foreach ($all_parkir as $parkir) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $parkir->jenis_kendaraan);
			$sheet->setCellValue('C' . $x, $parkir->plat);
			$sheet->setCellValue('D' . $x, $parkir->status);
			$sheet->setCellValue('E' . $x, $parkir->jam_masuk . " " . $parkir->tanggal_parkir);
			$spreadsheet->getActiveSheet()->setCellValue('F' . $x, $parkir->jam_keluar . " " . $parkir->tanggal_keluar);
			$spreadsheet->getActiveSheet()->setCellValue('G' . $x, $parkir->harga_parkir);

			$x++;
		}


		// header('Content-Type: application/');
		header('Content-Disposition: attachment;filename=' . $filename . ".xlsx");
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function parkir_manage()
	{
		$get_all_parkir = $this->parkir->get_all_parkir();
		$get_all_jenis_kendaraan = $this->parkir->get_all_jenis_kendaraan();

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

	public function delete_parkir($id_parkir)
	{
		$delete = $this->parkir->delete_parkir($id_parkir);

		$this->session->set_flashdata($delete->type_message, $delete->message);

		redirect('parkir-manage');
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
