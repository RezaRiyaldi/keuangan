<?php

class ParkirModel extends CI_Model
{
	public function get_all_parkir()
	{
		$this->db->join('users', 'users.id_user = parkir.petugas_id', 'left');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.id_jenis_kendaraan = parkir.jenis_kendaraan_id');
		$this->db->order_by('status', 'asc');
		$this->db->order_by('jenis_kendaraan', 'asc');
		return $this->db->get('parkir')->result();
	}

	public function get_jumlah_parkir($status)
	{
		$jumlah_parkir = $this->db->select('count(jenis_kendaraan_id) as jumlah, jenis_kendaraan')
			->from('parkir')
			->join('jenis_kendaraan', 'parkir.jenis_kendaraan_id = jenis_kendaraan.id_jenis_kendaraan')
			->where('status', $status)
			->group_by('jenis_kendaraan')
			->get()->result();

		return $jumlah_parkir;
	}

	public function get_parkir($id_parkir)
	{
		$this->db->join('users', 'users.id_user = parkir.petugas_id', 'left');
		$this->db->join('jenis_kendaraan', 'jenis_kendaraan.id_jenis_kendaraan = parkir.jenis_kendaraan_id');
		$this->db->where('id_parkir', $id_parkir);
		return $this->db->get('parkir')->row();
	}

	public function get_all_jenis_kendaraan()
	{
		return $this->db->get('jenis_kendaraan')->result();
	}

	public function get_jenis_kendaraan($id_jenis_kendaraan)
	{
		$this->db->where('id_jenis_kendaraan', $id_jenis_kendaraan);
		return $this->db->get('jenis_kendaraan')->row();
	}

	public function get_jumlah_kas($jangka, $tipe_transaksi)
	{
		$jumlah = $this->db->select_sum('jumlah')
			->from('kas')
			->where('tipe_transaksi', $tipe_transaksi);

		if ($jangka == 'tahun') {
			$jumlah->where("YEAR(tanggal_transaksi)", date('Y'));
		} else if ($jangka == 'bulan') {
			$jumlah->where("YEAR(tanggal_transaksi)", date('Y'));
			$jumlah->where("MONTH(tanggal_transaksi)", date('m'));
		} else if ($jangka == 'hari') {
			$jumlah->where("tanggal_transaksi", date('Y-m-d'));
		}

		$jumlah = $jumlah->get()->row();

		// dd($jumlah);

		return $jumlah;
	}

	public function tambah_parkir($input)
	{
		$response = create_response();
		$this->db->where('plat', $input->plat);
		$this->db->where('status', 'active');
		$cek_kendaraan_parkir = $this->db->get('parkir')->num_rows();
		// dd($cek_kendaraan_parkir);
		$plat = strtoupper($input->plat);

		if ($cek_kendaraan_parkir < 1) {
			$data_kendaraan = [
				'plat' => $plat,
				'jenis_kendaraan_id' => $input->jenis_kendaraan,
				'jam_masuk' => date('H:i:s'),
				'tanggal_parkir' => date('Y-m-d')
			];

			$this->db->insert('parkir', $data_kendaraan);

			$response->type_message = "success";
			$response->message = "Berhasil menambah jenis kendaraan baru.";
			$response->success = TRUE;
		} else {
			$response->type_message = "error";
			$response->message = "Kendaraan dengan plat $plat masih terparkir.";
		}

		return $response;
	}

	public function selesai_parkir($id_parkir)
	{
		$response = create_response();
		$parkir = $this->get_parkir($id_parkir);

		// Hitung Parkir
		$tanggal_masuk = new DateTime($parkir->tanggal_parkir);
		$tanggal_keluar = new DateTime();
		$total_hari = $tanggal_keluar->diff($tanggal_masuk)->days + 1;
		$harga_parkir = $parkir->harga_perhari * $total_hari;

		$data_parkir = [
			'status' => 'non-active',
			'jam_keluar' => date('H:i:s'),
			'tanggal_keluar' => date('Y-m-d'),
			'harga_parkir' => $harga_parkir,
			'petugas_id' => $this->session->id_user
		];

		$data_kas = [
			'tipe_transaksi' => 1,
			'jenis_transaksi' => 'Parkir',
			'jumlah' => $harga_parkir,
			'tanggal_transaksi' => date('Y-m-d'),
		];

		// Update data parkir
		$this->db->where('id_parkir', $id_parkir);
		$this->db->update('parkir', $data_parkir);

		// Insert laporan Keuangan
		$this->db->insert('kas', $data_kas);

		$response->type_message = 'success';
		$response->message = 'Check out berhasil, terima kasih telah berkunjung, semoga harimu menyenangkan';

		return $response;
	}

	public function delete_parkir($id_parkir)
	{
		$response = create_response();
		$this->db->where('id_parkir', $id_parkir);
		$this->db->delete('parkir');

		$response->type_message = "success";
		$response->message = "Berhasil menghapus Jenis Kendaraan.";

		return $response;
	}

	public function tambah_jenis_kendaraan($input)
	{
		$response = create_response();
		$data_kendaraan = [
			'jenis_kendaraan' => ucwords(strtolower($input->jenis_kendaraan)),
			'harga_perhari' => $input->harga_perhari
		];

		$this->db->insert('jenis_kendaraan', $data_kendaraan);
		$response->type_message = "success";
		$response->message = "Berhasil menambah jenis kendaraan baru.";

		return $response;
	}

	public function edit_jenis_kendaraan($input, $id_jenis_kendaraan)
	{
		$response = create_response();
		$data_kendaraan = [
			'jenis_kendaraan' => ucwords(strtolower($input->jenis_kendaraan)),
			'harga_perhari' => $input->harga_perhari
		];

		$this->db->where('id_jenis_kendaraan', $id_jenis_kendaraan);
		$this->db->update('jenis_kendaraan', $data_kendaraan);
		$response->type_message = "success";
		$response->message = "Berhasil merubah jenis kendaraan.";

		return $response;
	}

	public function delete_jenis_kendaraan($id_jenis_kendaraan)
	{
		$response = create_response();
		$this->db->where('id_jenis_kendaraan', $id_jenis_kendaraan);
		$this->db->delete('jenis_kendaraan');

		$response->type_message = "success";
		$response->message = "Berhasil menghapus Jenis Kendaraan.";

		return $response;
	}
}
