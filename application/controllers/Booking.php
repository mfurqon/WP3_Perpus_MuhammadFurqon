<?php
defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        // $this->load->model(['ModelBooking', 'ModelUser']);
    }

    public function index()
    {
        $id = ['bo.id_user' => $this->uri->segment(3)];
        $id_user = $this->session->userdata('id_user');
        $data['booking'] = $this->ModelBooking->joinOrder($id)->result();

        $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        foreach ($user as $a) {
            $data['image'] = $user['image'];
            $data['user'] = $user['nama'];
            $data['email'] = $user['email'];
            $data['tanggal_input'] = $user['tanggal_input'];
        }
        $dtb = $this->ModelBooking->showTemp(['id_user' => $id_user])->num_rows();

        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Tidak ada buku di keranjang</div>');
            redirect(base_url());
        } else {
            $data['temp'] = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit, id_buku from temp where id_user='$id_user'")->result_array();
        }

        $data['judul'] = "Data Booking";

        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/data-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    }

    public function tambahBooking()
    {
        $id_buku = $this->uri->segment(3);

        // Memilih data buku untuk dimasukkan ke table temp/keranjang melalui variable $isi
        $d = $this->db->query("Select*from buku where id='$id_buku'")->row();

        // Berupa data-data yang akan disimpan ke dalam teble temp/keranjang
        $isi = [
            'id_buku' => $id_buku,
            'judul_buku' => $d->judul_buku,
            'id_user' => $this->session->userdata('id_user'),
            'email_user' => $this->session->userdata('email'),
            'tgl_booking' => date('Y-m-d H:i:s'),
            'image' => $d->image,
            'penulis' => $d->pengarang,
            'penerbit' => $d->penerbit,
            'tahun_terbit' => $d->tahun_terbit
        ];

        // Cek apakah buku yang di klik booking sudah ada di keranjang
        $temp = $this->ModelBooking->getDataWhere('temp', ['id_buku' => $id_buku])->num_rows();

        $user_id = $this->session->userdata('id_user');

        // Cek jika sudah memasukkan 3 buku untuk dibooking dalam keranjang
        $temp_user = $this->db->query("select*from temp where id_user = '$user_id'")->num_rows();

        // Cek jika masih ada booking buku yang belum diambil
        $data_booking = $this->db->query("select*from booking where id_user = '$user_id'")->num_rows();

        if ($data_booking > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Masih ada booking buku sebelumnya yang belum diambil.<br> Ambil buku yang di-booking atau tunggu 1x24 jam untuk bisa booking kembali</div>');
            redirect(base_url());
        }

        // Jika buku yang diklik booking sudah ada di keranjang
        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Buku ini sudah anda booking</div>');
            redirect(base_url('home'));
        }

        // Jika buku yang akan di-booking sudah mencapai 3 item
        if ($temp_user == 3) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Booking buku tidak boleh lebih dari 3 item</div>');
            redirect(base_url('home'));
        }

        // Membuat table temp jika belum ada
        $this->ModelBooking->createTemp();
        $this->ModelBooking->insertData('temp', $isi);

        // Pesan ketika berhasil memasukkan buku ke keranjang
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Buku berhasil ditambahkan ke keranjang</div>');
        redirect(base_url('home'));
    }

    public function hapusBooking()
    {
        $id_buku = $this->uri->segment(3);
        $id_user = $this->session->userdata('id_user');

        $this->ModelBooking->deleteData(['id_buku' => $id_buku], 'temp');
        $kosong = $this->db->query("select*from temp where id_user = '$id_user'")->num_rows();

        if ($kosong < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Tidak ada buku di keranjang</div>');
            redirect(base_url());
        } else {
            redirect(base_url('booking'));
        }
    }

    public function bookingSelesai($where)
    {
        // Meng-update stok dan di-booking di table buku saat proses booking diselesaikan
        $this->db->query("UPDATE buku, temp SET buku.dibooking=buku.dibooking+1, buku.stok=buku.stok-1 WHERE buku.id=temp.id_buku");

        $tgl_sekarang = date('Y-m-d');
        $isi_booking = [
            'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
            'tgl_booking' => date('Y-m-d H:m:s'),
            'batas_ambil' => date('Y-m-d', strtotime('+2 days', strtotime($tgl_sekarang))),
            'id_user' => $where
        ];

        // Menyimpan ke table booking dan detail booking, dan mengosongkan table temporary
        $this->ModelBooking->insertData('booking', $isi_booking);
        $this->ModelBooking->simpanDetail($where);
        $this->ModelBooking->kosongkanData('temp');

        redirect(base_url('booking/info'));
    }

    public function info()
    {
        $where = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Selesai Booking";
        $data['user_aktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("SELECT*FROM booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id and bo.id_user='$where'")->result_array();

        $this->load->view('templates/templates-user/header', $data);
        $this->load->view('booking/info-booking', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    }

    public function exportToPdf()
    {
        $id_user = $this->session->userdata('id_user');
        $nama = $this->session->userdata('nama');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Cetak Bukti Booking";
        $data['user_aktif'] = $this->ModelUser->cekData(['id' => $id_user])->result();
        $data['items'] = $this->db->query("SELECT*FROM booking bo, booking_detail d, buku bu WHERE d.id_booking=bo.id_booking AND d.id_buku=bu.id AND bo.id_user='$id_user'")->result_array();

        $this->load->library('dompdf_gen');

        $this->load->view('booking/bukti-pdf', $data);

        $paper_size = 'A4'; //ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("bukti-booking-$nama.pdf", array('Attachment' => 0)); //nama PDF yang dihasilkan
    }
}