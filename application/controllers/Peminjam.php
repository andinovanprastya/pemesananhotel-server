<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Peminjam extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('id_peminjam');
		if ($id == '') {
			$peminjam = $this->db->get('peminjam')->result();
		} else {
			$this->db->where('id_peminjam', $id);
			$peminjam = $this->db->get('peminjam')->result();
		}
		$this->response($peminjam, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'id_peminjam' => $this->post('id_peminjam'),
			'nama' => $this->post('nama'),
			'alamat' => $this->post('alamat'),
			'telpn' => $this->post('telpn')
		);
		$insert = $this->db->insert('peminjam', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('id_peminjam');
		$data = array(
			'id_peminjam' =>$this->put('id_peminjam') ,
			'nama' =>$this->put('nama') ,
			'alamat' => $this->put('alamat'),
			'telpn' => $this->put('telpn')
		);
		$this->db->where('id_peminjam', $id);
		$update = $this->db->update('peminjam', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('id_peminjam');
		$this->db->where('id_peminjam', $id);
		$delete = $this->db->delete('peminjam');
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