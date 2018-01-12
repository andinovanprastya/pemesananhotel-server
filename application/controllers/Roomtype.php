<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Roomtype extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('roomtype_id');
		if ($id == '') {
			$roomtype = $this->db->get('room_type')->result();
		} else {
			$this->db->where('roomtype_id', $id);
			$roomtype = $this->db->get('room_type')->result();
		}
		$this->response($roomtype, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'roomtype_id' => $this->post('roomtype_id'),
			'room_name' => $this->post('room_name'),
			'stok' => $this->post('stok'),
			'price' => $this->post('price'),
		);
		$insert = $this->db->insert('room_type', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('roomtype_id');
		$data = array(
			'roomtype_id' => $this->put('roomtype_id'),
			'room_name' => $this->put('room_name'),
			'stok' => $this->put('stok'),
			'price' => $this->put('price'),
			
		);
		$this->db->where('roomtype_id', $id);
		$update = $this->db->update('room_type', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('roomtype_id');
		$this->db->where('roomtype_id', $id);
		$delete = $this->db->delete('room_type');
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