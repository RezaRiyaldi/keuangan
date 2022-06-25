<?php

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel', 'user');
	}

	public function login()
	{
		if ($this->session->logged_in) {
			redirect('/');
		}

		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|trim|min_length[4]',
			[
				'min_length' => 'Username minimal memiliki 4 karakter.',
				'required' => 'Username wajib diisi ges'
			]
		);

		if ($this->form_validation->run() === FALSE) {
			$data = [
				'title' => 'Login'
			];

			$this->load->view('user/auth/v_login', $data);
		} else {
			$input = (object) $this->input->post();

			$check = $this->user->login($input);
			$this->session->set_flashdata($check->type_message, $check->message);

			if ($check->success) {
				$this->session->set_userdata($check->data);
				redirect('/');
			} else {
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function logout()
	{
		$data_user = [
			'username', 'nama_lengkap', 'role', 'foto', 'logged_in'
		];

		$this->session->unset_userdata($data_user);
		$this->session->set_flashdata('success', "Logout berhasil, semoga harimu menyenangkan");

		redirect('user/login');
	}

	public function setting_profile()
	{
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|trim|min_length[4]',
			[
				'min_length' => 'Username minimal memiliki 4 karakter.',
				'required' => 'Username wajib diisi ges'
			]
		);

		$this->form_validation->set_rules(
			'nama_lengkap',
			'Nama Lengkap',
			'required|trim',
			[
				'required' => 'Nama Lengkap wajib diisi ges'
			]
		);

		$this->form_validation->set_rules(
			'password',
			'Password',
			'trim|min_length[4]',
			[
				'min_length' => 'Password minimal memiliki 4 karakter.'
			]
		);

		$this->form_validation->set_rules(
			'cpassword',
			'Confirm Password',
			'matches[password]',
			[
				'matches' => 'Confirm Password harus sama dengan password'
			]
		);

		if ($this->form_validation->run() === FALSE) {
			$account = $this->user->get_user_row($this->session->id_user);
			$data = [
				'title' => 'Setting Profile',
				'content' => 'user/auth/v_setting_profile',
				'user' => $account
			];
	
			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$insert = $this->user->edit_user($input, $this->session->id_user, 'setting_profile');
			$this->session->set_flashdata($insert->type_message, $insert->message);

			redirect('setting-profile');
		}
	}

	public function upload_foto()
	{
		$response = create_response();

		$config = [
			'upload_path' => "./assets/img/avatars/",
			'allowed_types' => 'jpg|png',
			'encrypt_name' => TRUE
		];

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('foto')) {
			$response->message = $this->upload->display_errors();
		} else {
			$data_gambar = $this->upload->data();

			$this->user->upload_foto($data_gambar['file_name']);

			$response->type_message = 'success';
			$response->message = 'Berhasil merubah gambar';
		}

		$this->session->set_flashdata($response->type_message, $response->message);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function hapus_foto()
	{
		$delete = $this->user->hapus_foto($this->session->id_user);

		$this->session->set_flashdata($delete->type_message, $delete->message);

		redirect($_SERVER['HTTP_REFERER']);
	}
}
