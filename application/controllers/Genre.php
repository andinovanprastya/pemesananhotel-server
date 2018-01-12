<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Genre extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('genre_id');
		if ($id == '') {
			$genre = $this->db->get('genre')->result();
		} else {
			$this->db->where('genre_id', $id);
			$genre = $this->db->get('genre')->result();
		}
		$this->response($genre, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'genre_id' => $this->post('genre_id'),
			'genre' => $this->post('genre'),
		);
		$insert = $this->db->insert('genre', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('genre_id');
		$data = array(
			'genre_id' =>$this->put('genre_id') ,
			'genre' =>$this->put('genre') ,
			
		);
		$this->db->where('genre_id', $id);
		$update = $this->db->update('genre', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('genre_id');
		$this->db->where('genre_id', $id);
		$delete = $this->db->delete('genre');
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