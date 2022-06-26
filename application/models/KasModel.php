<?php

class KasModel extends CI_Model
{
	public function get_all_kas($tipe_transaksi = "")
	{
		$kas = $this->db->select("*")
			->from('kas');

		if ($tipe_transaksi != "") {
			$kas->where('tipe_transaksi', $tipe_transaksi);
		}

		$kas = $kas->get()->result();

		// dd($this->db->last_query());

		return $kas;
	}

	public function get_saldo_kas()
	{
		$pemasukan = $this->db->select_sum('jumlah')
			->from('kas')
			->where('tipe_transaksi', 1)
			->get()
			->row();

		$pengeluaran = $this->db->select_sum('jumlah')
			->from('kas')
			->where('tipe_transaksi', 0)
			->get()
			->row();

		$total_saldo = $pemasukan->jumlah - $pengeluaran->jumlah;

		return $total_saldo;
	}

	public function tambah_pengeluaran($input)
	{
		$response = create_response();

		$data_pengeluaran = [
			'tipe_transaksi' => 0,
			'jenis_transaksi' => $input->jenis_pengeluaran,
			'jumlah' => $input->jumlah,
			'tanggal_transaksi' => date('Y-m-d')
		];

		$this->db->insert('kas', $data_pengeluaran);

		$response->type_message = 'success';
		$response->message = 'Berhasil menambahkan pengeluaran';

		return $response;
	}
}
