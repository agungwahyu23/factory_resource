<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('M_user');
	}

	public function index()
	{
		$data['page'] 		= "Login";
		$this->load->view('admin/login',$data);
	}

    public function cek_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

		$cek = $this->M_user->cek_login($username, $password);
		
		if(!empty($cek)){
			foreach($cek as $user) {
				$session_data = [
				'username' => $user['username'],
				'level' => $user['level'],
				'id_user' => $user['id_user'],
			];
				$this->session->set_userdata($session_data);
				if ($user['level'] == 'admin') {
					$out['status'] = 'berhasil';
				}else{
					$out['status'] = 'gagal';
				} 
			}
		}else{
			$out['status'] = 'gagal';
		} 
		
		echo json_encode($out);
	} 

	public function logout()
    {
        $params = array('id_user', 'username');
        $this->session->unset_userdata($params);
        redirect('login');
    }
}