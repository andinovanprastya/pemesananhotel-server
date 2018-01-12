<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH .'/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;


class Buku extends REST_Controller {

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	public function index_get()
	{
		$id = $this->get('id_buku');
		if ($id == '') {
			$buku = $this->db->get('buku')->result();
		} else {
			$this->db->where('id_buku', $id);
			$buku = $this->db->get('buku')->result();
		}
		$this->response($buku, 200);
		
	}

	public function index_post()
	{
		$data = array(
			'id_buku' => $this->post('id_buku'),
			'judul' => $this->post('judul'),
			'pengarang' => $this->post('pengarang'),
			'tahun_terbit' => $this->post('tahun_terbit')
		);
		$insert = $this->db->insert('buku', $data);
		if ($insert) {
			$this->response($data, 200);
		} else {
			$this->response(array('status'=>'fail', 502));
		}
		
	}

	function index_put()
	{
		$id = $this->put('id_buku');
		$data = array(
			'id_buku' =>$this->put('id_buku') ,
			'judul' =>$this->put('judul') ,
			'pengarang' => $this->put('pengarang'),
			'tahun_terbit' => $this->put('tahun_terbit')
		);
		$this->db->where('id_buku', $id);
		$update = $this->db->update('buku', $data);
		if ($update) {
			$this->response($data,200);
		} else {
			$this->response(array('status' => 'fail',502));
		}
		
	}

	function index_delete()
	{
		$id=$this->delete('id_buku');
		$this->db->where('id_buku', $id);
		$delete = $this->db->delete('buku');
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