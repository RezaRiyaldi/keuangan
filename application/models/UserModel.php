<?php

class UserModel extends CI_Model
{
	public function get_users()
	{
		$this->db->join("roles", "roles.id_role = users.role_id");
		return $this->db->get("users")->result();
	}

	public function get_roles()
	{
		return $this->db->get('roles')->result();
	}

	public function get_user_row($id_user)
	{
		$this->db->join("roles", "roles.id_role = users.role_id");
		$this->db->where('id_user', $id_user);
		return $this->db->get('users')->row();
	}

	public function tambah_user($input)
	{
		$response = create_response();
		$foto = '';
		$jenis_kelamin = $input->jenis_kelamin;
		// dd($input);

		if ($jenis_kelamin == 1) {
			$foto = 'default-man.png';
		} else {
			$foto = 'default-woman.png';
		}

		$data_user = [
			'username' => $input->username,
			'nama_lengkap' => ucwords(strtolower($input->nama_lengkap)),
			'password' => password_hash($input->password, PASSWORD_DEFAULT),
			'role_id' => $input->role,
			'jenis_kelamin' => $jenis_kelamin,
			'foto' => $foto
		];

		$this->db->insert('users', $data_user);
		$response->type_message = "success";
		$response->message = "Berhasil menambah user baru.";

		return $response;
	}

	public function edit_user($input, $id_user, $type)
	{
		$response = create_response();

		$user = $this->db->get_where('users', ['username' => $input->username]);

		$return = NULL;

		if ($type == 'setting_profile' || $user->row()->username == $this->session->username) {
			$return = $user->row()->username == $this->session->username;
		} else if ($type == 'edit_user') {
			$return = $user->row()->username != $this->session->username;
		}

		// dd($user->row());
		if ($return || $user->num_rows() == 0) {
			$data_user = [
				'username' => $input->username,
				'nama_lengkap' => ucwords(strtolower($input->nama_lengkap)),
			];

			if ($input->role != NULL) {
				$data_user += [
					'role_id' => $input->role
				];
			}

			if ($input->password != NULL) {
				$data_user += [
					'password' => password_hash($input->password, PASSWORD_DEFAULT)
				];
			}

			$this->db->where('id_user', $id_user);
			$this->db->update('users', $data_user);

			$response->type_message = "success";
			$response->message = "Berhasil merubah user.";

			if ($this->session->id_user == $id_user) {
				$this->db->where('id_user', $id_user);
				$this->db->join('roles', "roles.id_role = users.role_id");
				$user = $this->db->get('users')->row();

				$userdata = [
					'username' => $user->username,
					'nama_lengkap' => $user->nama_lengkap,
					'role' => $user->role
				];

				$this->session->set_userdata($userdata);
			}
		} else {
			$response->message = 'Username ini sudah ada ges';
		}

		return $response;
	}

	public function delete_user($id_user)
	{
		$response = create_response();
		$this->db->where('id_user', $id_user);
		$this->db->delete('users');

		$response->type_message = "success";
		$response->message = "Berhasil menghapus user.";

		return $response;
	}

	public function login($input)
	{
		$response = create_response();

		$this->db->where('username', $input->username);
		$this->db->join('roles', "roles.id_role = users.role_id");
		$user = $this->db->get('users')->row();

		// dd($user);
		if ($user) {
			if (password_verify($input->password, $user->password)) {
				$data_user = [
					'id_user' => $user->id_user,
					'username' => $user->username,
					'nama_lengkap' => $user->nama_lengkap,
					'foto' => $user->foto,
					'role' => $user->role,
					'logged_in' => TRUE
				];

				$response->data = $data_user;
				$response->success = TRUE;
				$response->type_message = "success";
				$response->message = "Login berhasil! Selamat datang $user->username";
			} else {
				$response->message = "Password salah!";
			}
		} else {
			$response->message = "User tidak ditemukan!";
		}

		return $response;
	}

	public function upload_foto($file_name)
	{
		$this->db->where('id_user', $this->session->id_user);
		$this->db->update('users', ['foto' => $file_name]);

		$this->session->set_userdata(['foto' => $file_name]);
	}

	public function hapus_foto($id_user)
	{
		$response = create_response();
		$user = $this->get_user_row($id_user);

		$foto = '';
		if ($user->jenis_kelamin == 'Laki - laki') {
			$foto = 'default-man.png';
		} else {
			$foto = 'default-woman.png';
		}

		$this->db->where('id_user', $id_user);
		$this->db->update('users', ['foto' => $foto]);

		$this->session->set_userdata(['foto' => $foto]);

		$response->type_message = 'success';
		$response->message = 'Berhasil menghapus foto';

		return $response;
	}
}
