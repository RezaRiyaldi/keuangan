<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('KasModel', 'kas');
		if (!$this->session->logged_in) {
			redirect('/');
		} else if ($this->session->role != 'Keuangan' && $this->session->role != 'Admin') {
			redirect('403');
		}
	}

	public function index()
	{
		$kas = $this->kas->get_all_kas();
		$kas_masuk = $this->kas->get_all_kas(1);
		$kas_keluar = $this->kas->get_all_kas(0);
		$total_saldo = $this->kas->get_saldo_kas();

		// dd($kas_masuk);
		$data = [
			'title' => 'Kas',
			'content' => 'kas/v_kas',
			'kas_semua' => $kas,	
			'kas_masuk' => $kas_masuk,
			'kas_keluar' => $kas_keluar,
			'total' => $total_saldo
		];

		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_pengeluaran()
	{
		$this->form_validation->set_rules(
			'jenis_pengeluaran',
			'Alokasi',
			'required|trim',
			[
				'required' => 'Alokasi atau tujuan pengeluaran wajib diisi ges'
			]
		);
		$this->form_validation->set_rules(
			'jumlah',
			'Nominal',
			'required|trim',
			[
				'required' => 'Nominal wajib diisi ges'
			]
		);

		if ($this->form_validation->run() === FALSE) {
			$data = [
				'title' => 'Kas',
				'content' => 'kas/v_tambah_pengeluaran',
			];

			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$insert = $this->kas->tambah_pengeluaran($input);
			$this->session->set_flashdata($insert->type_message, $insert->message);

			redirect('kas');
		}
	}

	public function cetak_laporan_kas()
	{
		$semua_kas = $this->kas->get_all_kas();
		$total_saldo = $this->kas->get_saldo_kas();

		$spreadsheet = new Spreadsheet();
		$filename = 'laporan-kas_' . date('Y-m-d_H-i-s');
		$no = 1;
		$x = 2;

		// Setting Value
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Tipe Transaksi');
		$sheet->setCellValue('C1', 'Keterangan');
		$sheet->setCellValue('D1', 'Tanggal Transaksi');
		$sheet->setCellValue('E1', 'Jumlah');

		foreach ($semua_kas as $kas) {
			$sheet->setCellValue('A' . $x, $no++);
			$sheet->setCellValue('B' . $x, $kas->tipe_transaksi == 1 ? "Pemasukan" : "Pengeluaran");
			$sheet->setCellValue('C' . $x, $kas->jenis_transaksi);
			$sheet->setCellValue('D' . $x, $kas->tanggal_transaksi);
			$sheet->setCellValue('E' . $x, $kas->tipe_transaksi == 0 ? "Rp. -" . $kas->jumlah : "Rp. " . $kas->jumlah);

			$x++;
		}

		$sheet->setCellValue('D' . $x, "Total");
		$sheet->setCellValue('E' . $x, $total_saldo);


		// header('Content-Type: application/');
		header('Content-Disposition: attachment;filename=' . $filename . ".xlsx");
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
