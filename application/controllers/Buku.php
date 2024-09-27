<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    // Manajemen Buku
    public function index()
    {
        $data['judul'] = 'Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->getBuku()->result_array();
        $data['kategori'] = $this->ModelBuku->getKategori();

        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric');
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        // Konfigurasi Sebelum Gambar Di-Upload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg|webp';
        $config['max_size'] = '2048';
        $config['max_width'] = '1024';
        $config['max_height'] = '2048';
        $config['file_name'] = $this->input->post('judul_buku');

        // Memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('buku');
            }

            $data = [
                'judul_buku' => $this->input->post('judul_buku', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit' => $this->input->post('penerbit', true),
                'tahun_terbit' => $this->input->post('tahun_terbit', true),
                'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'dipinjam' => 0,
                'dibooking' => 0,
                'image' => $gambar
            ];

            $this->ModelBuku->tambahBuku($data);

            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Data buku berhasil ditambah
                </div>
            ');
            redirect('buku');
        }
    }

    public function kategori()
    {
        $data['judul'] = 'Kategori Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->getKategori();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];

            $this->ModelBuku->tambahKategori($data);

            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Kategori berhasil ditambah
                </div>
            ');
            redirect('buku/kategori');
        }
    }

    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Kategori Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelBuku->kategoriWhere(['id' => $this->uri->segment(3)])->row_array();

        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/ubah-kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];

            $this->ModelBuku->updateKategori($data, ['id' => $this->input->post('id')]);

            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Kategori berhasil diubah
                </div>
            ');
            redirect('buku/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelBuku->hapusKategori($where);

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Kategori berhasil dihapus
                </div>
            ');
        redirect('buku/kategori');
    }

    public function ubahBuku()
    {
        $data['judul'] = 'Ubah Data Buku';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->ModelBuku->bukuWhere(['id' => $this->uri->segment(3)])->row_array();
        $data['kategori'] = $this->ModelBuku->getKategori();

        $this->form_validation->set_rules('judul_buku', 'Judul Buku', 'required|min_length[3]');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('pengarang', 'Nama Pengarang', 'required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]');
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric');
        $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
        $this->form_validation->set_rules('dipinjam', 'Dipinjam', 'required|numeric');
        $this->form_validation->set_rules('dibooking', 'Dibooking', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('buku/ubah-buku', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id', true);
            $judul_buku = $this->input->post('judul_buku', true);
            $id_kategori = $this->input->post('id_kategori', true);
            $pengarang = $this->input->post('pengarang', true);
            $penerbit = $this->input->post('penerbit', true);
            $tahun_terbit = $this->input->post('tahun_terbit', true);
            $isbn = $this->input->post('isbn', true);
            $stok = $this->input->post('stok', true);

            // Jika ada gambar yang akan di-upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|webp';
                $config['max_size'] = '2048';
                $config['max_width'] = '1024';
                $config['max_height'] = '2048';
                $config['file_name'] = $this->input->post('judul_buku');

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['buku']['image'];
                    unlink(FCPATH . 'assets/img/upload/' . $gambar_lama);

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('buku');
                }
            }

            $this->db->set('judul_buku', $judul_buku);
            $this->db->set('id_kategori', $id_kategori);
            $this->db->set('pengarang', $pengarang);
            $this->db->set('penerbit', $penerbit);
            $this->db->set('tahun_terbit', $tahun_terbit);
            $this->db->set('isbn', $isbn);
            $this->db->set('stok', $stok);
            $this->db->where('id', $id);
            $this->db->update('buku');

            $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Data Buku berhasil diubah
                </div>
            ');
            redirect('buku');
        }
    }

    public function hapusBuku()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelBuku->hapusBuku($where);

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Data Buku berhasil dihapus
                </div>
            ');
        redirect('buku');
    }
}
