<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH .'/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;

	class Peminjaman extends REST_Controller{

		function __construct($config = 'rest'){
			parent::__construct($config);
			$this->load->database();
		}

		function index_get(){
			$id = $this->get('id_peminjaman');
			if($id ==''){
				$peminjaman = $this->db->get('peminjaman')->result();
			}else{
				$this->db->where('id_peminjaman',$id);
				$peminjaman = $this->db->get('peminjaman')->result();
			}
			$this->response($peminjaman,200);
		}

		function index_post(){
			$data = array(
				'id_peminjaman' => $this->post('id_peminjaman'),
				'id_peminjam' => $this->post('id_peminjam'),
				'tanggal_pinjam' => $this->post('tanggal_pinjam'),
				'tanggal_kembali' => $this->post('tanggal_kembali'),
				'id_buku' => $this->post('id_buku'));
			$insert = $this->db->insert('peminjaman',$data);
			if($insert){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_put(){
			$id = $this->put('id_peminjaman');
			$data = array(
				'id_peminjaman' => $this->put('id_peminjaman'),
				'id_peminjam' => $this->put('id_peminjam'),
				'tanggal_pinjam' => $this->put('tanggal_pinjam'),
				'tanggal_kembali' => $this->put('tanggal_kembali'),
				'id_buku' => $this->put('id_buku'));
			$this->db->where('id_peminjaman',$id);
			$update = $this->db->update('peminjaman',$data);
			if($update){
				$this->response($data,200);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}

		function index_delete(){
			$id = $this->delete('id_peminjaman');
			$this->db->where('id_peminjaman',$id);
			$delete = $this->db->delete('peminjaman');
			if($delete){
				$this->response(array('status'=>'success'),201);
			}else{
				$this->response(array('status'=>'fail',502));
			}
		}
	}
?>