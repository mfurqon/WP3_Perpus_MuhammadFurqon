<?php defined('BASEPATH') or exit('No Direct Script Access Allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    // Laporan Buku
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
        $data['judul'] = 'Laporan Cetak Buku';
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori();

        $this->load->view('buku/laporan-cetak-buku', $data);
    }

    public function laporanBukuPdf()
    {
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();

        $this->load->view('buku/laporan-pdf-buku', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->load->library('pdf');

        $this->pdf->generate($html, "laporan-data-buku", $paper_size, $orientation);
    }

    public function exportExcel()
    {
        $data = array('title' => 'Laporan Buku', 'buku' => $this->ModelBuku->getBuku()->result_array());
        $this->load->view('buku/export-excel-buku', $data);
    }

    // Laporan Peminjaman
    public function laporanPinjam()
    {
        $data['judul'] = 'Laporan Data Peminjaman';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['laporan'] = $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('pinjam/laporan-pinjam', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_pinjam()
    {
        $data['laporan'] = $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();

        $this->load->view('pinjam/laporan-print-pinjam', $data);
    }

    public function laporan_pinjam_pdf()
    {
        $this->load->library('pdf');

        $data['laporan'] = $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();

        $this->load->view('pinjam/laporan-pdf-pinjam', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->pdf->generate($html, "laporan data peminjaman", $paper_size, $orientation);
    }

    public function export_excel_pinjam()
    {
        $data['title'] = 'Laporan Data Peminjaman Buku';
        $data['laporan'] = $this->db->query("SELECT * FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();

        $this->load->view('pinjam/export-excel-pinjam', $data);
    }

    // Laporan Anggota
    public function laporanAnggota()
    {
        $data['judul'] = 'Laporan Data Anggota';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['laporan'] = $this->db->query("SELECT * FROM user u, role r WHERE u.role_id=r.id")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/laporan-anggota', $data);
        $this->load->view('templates/footer');
    }

    public function cetak_laporan_anggota()
    {
        $data['judul'] = 'Cetak Laporan Anggota';
        $data['laporan'] = $this->db->query("SELECT * FROM user u, role r WHERE u.role_id=r.id")->result_array();

        $this->load->view('user/laporan-print-anggota', $data);
    }

    public function laporan_anggota_pdf()
    {
        $this->load->library('pdf');
        $data['laporan'] = $this->db->query("SELECT * FROM user u, role r WHERE u.role_id=r.id")->result_array();

        $this->load->view('user/laporan-pdf-anggota', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->pdf->generate($html, "laporan data anggota", $paper_size, $orientation);
    }

    public function export_excel_anggota()
    {
        $data['title'] = 'Laporan Data Anggota';
        $data['laporan'] = $this->db->query("SELECT * FROM user u, role r WHERE u.role_id=r.id")->result_array();

        $this->load->view('user/export-excel-anggota', $data);
    }
}