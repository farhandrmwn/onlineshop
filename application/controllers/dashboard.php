<?php

class Dashboard extends CI_Controller
{
	public function index()
	{
		$data['barang'] = $this->model_barang->tampil_data()->result();
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('dashboard.php', $data);
		$this->load->view('templates/footer.php');
	}

	public function tambah_ke_keranjang($id){
		$barang = $this->model_barang->find($id);

		$data = array(
			'id'		=> $barang->id_brg,
			'qty'		=> 1,
			'price'		=> $barang->harga,
			'name'		=> $barang->nama_brg
		);

		$this->cart->insert($data);
		redirect('dashboard');
	}

	public function detail_keranjang(){
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('keranjang');
		$this->load->view('templates/footer.php');
	}

	public function hapus_keranjang(){
		$this->cart->destroy();
		redirect('dashboard/index');
	}

	public function pembayaran(){
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('pembayaran');
		$this->load->view('templates/footer.php');
	}

	public function proses_pesanan(){
		$is_processed = $this->model_invoice->index();
		if($is_processed){
			$this->cart->destroy();
			$this->load->view('templates/header.php');
			$this->load->view('templates/sidebar.php');
			$this->load->view('proses_pesanan');
			$this->load->view('templates/footer.php');
		}else{
			echo 'Maaf Pesanan anda Gagal diproses!';
		}
		
	}
}