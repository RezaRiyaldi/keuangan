<?php

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel', 'user');
	}	

	public function user_manage()
	{
		if (!$this->session->logged_in) {
			redirect('/');
		} else if ($this->session->role != 'Admin'){
			redirect('403');
		}

		$get_users = $this->user->get_users();
		$get_roles = $this->user->get_roles();
		$data = [
			'title' => 'User Management',
			'content' => 'user/v_user_management',
			'users' => $get_users,
			'roles' => $get_roles
		];

		$this->load->view('layout/wrapper', $data);
	}

	public function tambah_user()
	{
		if (!$this->session->logged_in) {
			redirect('/');
		} else if ($this->session->role != 'Admin'){
			redirect('403');
		}

		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|trim|min_length[4]|is_unique[users.username]',
			[
				'min_length' => 'Username minimal memiliki 4 karakter.',
				'required' => 'Username wajib diisi ges',
				'is_unique' => 'Username sudah digunakan, silahkan pakai username lain'
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
			'required|trim|min_length[4]',
			[
				'min_length' => 'Password minimal memiliki 4 karakter.',
				'required' => 'Password wajib diisi ges'
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
			$get_roles = $this->user->get_roles();
			$data = [
				'title' => 'Tambah User',
				'content' => 'user/v_tambah_user',
				'roles' => $get_roles
			];

			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$insert = $this->user->tambah_user($input);
			$this->session->set_flashdata($insert->type_message, $insert->message);

			redirect('user-manage');
		}
	}

	public function list_users()
	{
		if (!$this->session->logged_in) {
			redirect('/');
		}
		
		$get_users = $this->user->get_users();
		$data = [
			'title' => 'List Users',
			'content' => 'user/v_list_users',
			'users' => $get_users
		];

		$this->load->view('layout/wrapper', $data);
	}

	public function edit_user($id_user)
	{
		if (!$this->session->logged_in) {
			redirect('/');
		} else if ($this->session->role != 'Admin'){
			redirect('403');
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
			$get_user = $this->user->get_user_row($id_user);
			$get_roles = $this->user->get_roles();

			$data = [
				'title' => 'Edit User',
				'content' => 'user/v_edit_user',
				'user' => $get_user,
				'roles' => $get_roles
			];

			$this->load->view('layout/wrapper', $data);
		} else {
			$input = (object) $this->input->post();

			$insert = $this->user->edit_user($input, $id_user, 'edit_user');
			$this->session->set_flashdata($insert->type_message, $insert->message);

			redirect('user-manage');
		}
	}

	public function delete_user($id_user)
	{
		$delete = $this->user->delete_user($id_user);

		$this->session->set_flashdata($delete->type_message, $delete->message);

		redirect('user-manage');
	}
}
