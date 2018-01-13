<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Booking extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('id_booking');
		if ($id == '') {
			$booking = $this->db->get('booking')->result();
		} else {
			$this->db->where('id_booking', $id);
			$booking = $this->db->get('booking')->result();
		}
		$this->response($booking, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'id_booking' => $this->post('id_booking'),
			'user_id' => $this->post('user_id'),
			'room_id' => $this->post('room_id'),
			'booking_date' => $this->post('booking_date'),
			'checkin' => $this->post('checkin'),
			'checkout' => $this->post('checkout'),
			'status' => $this->post('status'),
			
		);
		$insert = $this->db->insert('booking', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('checkin'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('id_booking');
		$data = array(
			'id_booking' => $this->put('id_booking'),
			'user_id' => $this->put('user_id'),
			'room_id' => $this->put('room_id'),
			'booking_date' => $this->put('booking_date'),
			'checkin' => $this->put('checkin'),
			'checkout' => $this->put('checkout'),
			'status' => $this->put('status'),
			
			
		);
		$this->db->where('id_booking', $id);
		$update = $this->db->update('booking', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('id_booking');
		$this->db->where('id_booking', $id);
		$delete = $this->db->delete('booking');
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