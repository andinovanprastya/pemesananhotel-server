<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Service extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('id_service');
		if ($id == '') {
			$service = $this->db->get('service')->result();
		} else {
			$this->db->where('id_service', $id);
			$service = $this->db->get('service')->result();
		}
		$this->response($service, 200);
		
	}

	public function index_post()
	{

		$data = array(
			'id_service' => $this->post('id_service'),
			'service' => $this->post('service'),
			'gambar' => $this->post('gambar'),
			'charge' => $this->post('charge'),
		);
		$insert = $this->db->insert('service', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('id_service');
		$data = array(
			'id_service' => $this->put('id_service'),
			'service' => $this->put('service'),
			'gambar' => $this->put('gambar'),
			'charge' => $this->put('charge'),
			
		);
		$this->db->where('id_service', $id);
		$update = $this->db->update('service', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('id_service');
		$this->db->where('id_service', $id);
		$delete = $this->db->delete('service');
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