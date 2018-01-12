<?php
	Class Room extends CI_Controller{
		var $API="";

		function __construct(){
			parent::__construct();
			$this->API="http://localhost/pemesananhotel/index.php";
			$this->load->library('session');
			$this->load->library('curl');
			$this->load->helper('form');
			$this->load->helper('url');
		}

		//Menampilkan data room
		function index(){
			$data['dataroom']=json_decode($this->curl->simple_get($this->API.'/room'));
			$this->load->view('room/list',$data);
		}

		//insert data room
		function create(){
			if(isset($_POST['submit'])){
				$data = array(
				'id_room' => $this->input->post('id_room'),
				'roomtype_id' => $this->input->post('roomtype_id'),
				'id_service' => $this->input->post('id_service'));
				$insert = $this->curl->simple_post($this->API.'/room',$data,array(CURLOPT_BUFFERSIZE =>10));
				if($insert){
					$this->session->set_flashdata('hasil','Insert Data Berhasil');
				}else{
					$this->session->set_flashdata('hasil','Insert Data Gagal');
				}
				redirect('room');
			}else{
				$this->load->view('room/create');
			}
		}

		//edit data room
		function edit(){
			if(isset($_POST['submit'])){
				$data = array(
				'id_room' => $this->input->post('id_room'),
				'roomtype_id' => $this->input->post('roomtype_id'),
				'id_service' => $this->input->post('id_service'));
				$update = $this->curl->simple_put($this->API.'/room',$data,array(CURLOPT_BUFFERSIZE =>10));
				if($update){
					$this->session->set_flashdata('hasil','Update Data Berhasil');
				}else{
					$this->session->set_flashdata('hasil','UpdateData Gagal');
				}
				redirect('room','refresh');
			}else{
				$params = array('id_room'=> $this->uri->segment(3));
				$data['dataroom'] = json_decode($this->curl->simple_get($this->API.'/room',$params));
				$this->load->view('room/edit',$data);
			}
		}

		//delete data room
		function delete($id){
			if(empty($id)){
				rediret('room');
			}else{
				$delete = $this->curl->simple_delete($this->API.'/room',array('id_room'=>$id), array(CURLOPT_BUFFERSIZE => 10));
				if($delete){
					$this->session->set_flashdata('hasil','Delete Data Berhasil');
				}else{
					$this->session->set_flashdata('hasil','Delete Data Gagal');
				}
				redirect('room');
			}
		}
	}
?>