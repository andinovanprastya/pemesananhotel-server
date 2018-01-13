<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Pembayaran extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('id_pembayaran');
		if ($id == '') {
			$pembayaran = $this->db->get('pembayaran')->result();
		} else {
			$this->db->where('id_pembayaran', $id);
			$pembayaran = $this->db->get('pembayaran')->result();
		}
		$this->response($pembayaran, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'id_pembayaran' => $this->post('id_pembayaran'),
			'id_booking' => $this->post('id_booking'),
			'tgl_bayar' => $this->post('tgl_bayar'),
			'total' => $this->post('total'),
			'status' => $this->post('status'),
			
		);
		$insert = $this->db->insert('pembayaran', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('id_pembayaran');
		$data = array(
			'id_pembayaran' => $this->put('id_pembayaran'),
			'pembayarantype_id' => $this->put('pembayarantype_id'),
			'tgl_bayar' => $this->put('tgl_bayar'),
			'total' => $this->put('total'),
			'status' => $this->put('status'),
			
			
		);
		$this->db->where('id_pembayaran', $id);
		$update = $this->db->update('pembayaran', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('id_pembayaran');
		$this->db->where('id_pembayaran', $id);
		$delete = $this->db->delete('pembayaran');
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