<?php defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function laporanBuku()
    {
        $data['judul'] = 'Laporan Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('buku/laporan-buku', $data);
        $this->load->view('templates/footer');
    }

    public function cetakLaporanBuku()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori();

        $this->load->view('buku/laporan-cetak-buku', $data);
    }
}