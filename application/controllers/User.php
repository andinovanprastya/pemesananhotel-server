<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class User extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('user_id');
		if ($id == '') {
			$user = $this->db->get('user')->result();
		} else {
			$this->db->where('user_id', $id);
			$user = $this->db->get('user')->result();
		}
		$this->response($user, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'user_id' => $this->post('user_id'),
			'nama' => $this->post('nama'),
			'alamat' => $this->post('alamat'),
			'telp' => $this->post('telp'),
			'email' => $this->post('email'),
			'username' => $this->post('username'),
			'password' => $this->post('password'),
		);
		$insert = $this->db->insert('user', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('user_id');
		$data = array(
			'user_id' => $this->put('user_id'),
			'nama' => $this->put('nama'),
			'alamat' => $this->put('alamat'),
			'telp' => $this->put('telp'),
			'email' => $this->put('email'),
			'username' => $this->put('username'),
			'password' => $this->put('password'),
			
		);
		$this->db->where('user_id', $id);
		$update = $this->db->update('user', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('user_id');
		$this->db->where('user_id', $id);
		$delete = $this->db->delete('user');
		if ($delete) {
			$this->response(array('status' => 'success'),201);
		} else {
			$this->response(array('status' => 'fail',502));
		}
	}

}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */
 ?>