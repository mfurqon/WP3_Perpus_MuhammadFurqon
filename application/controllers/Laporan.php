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

    public function laporanBukuPdf()
    {
        $this->load->library('dompdf_gen');

        $data['buku'] = $this->ModelBuku->getBuku()->result_array();

        $this->load->view('buku/laporan-pdf-buku', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("laporan-data-buku.pdf", array('Attachment' => 0));
    }

    public function exportExcel()
    {
        $data = array('title' => 'Laporan Buku', 'buku' => $this->ModelBuku->getBuku()->result_array());
        $this->load->view('buku/export-excel-buku', $data);
    }
}