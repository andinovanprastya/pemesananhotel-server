<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Room extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('room_id');
		if ($id == '') {
			$room = $this->db->get('room')->result();
		} else {
			$this->db->where('room_id', $id);
			$room = $this->db->get('room')->result();
		}
		$this->response($room, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'room_id' => $this->post('room_id'),
			'roomtype_id' => $this->post('roomtype_id'),
			'id_service' => $this->post('id_service'),
			
		);
		$insert = $this->db->insert('room', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('room_id');
		$data = array(
			'room_id' => $this->put('room_id'),
			'roomtype_id' => $this->put('roomtype_id'),
			'id_service' => $this->put('id_service'),
			
			
		);
		$this->db->where('room_id', $id);
		$update = $this->db->update('room', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('room_id');
		$this->db->where('room_id', $id);
		$delete = $this->db->delete('room');
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