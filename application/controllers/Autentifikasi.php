<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autentifikasi extends CI_Controller
{
    public function index()
    {
        // Jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Login';
            $data['user'] = '';

            // Kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/login');
            $this->load->view('templates/aute_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->ModelUser->cekData(['email' => $email])->row_array();

        // Jika usernya ada
        if ($user) {
            // Jika user sudah aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $this->session->set_flashdata(
                                'pesan',
                                '<div class="alert alert-info alert-message" role="alert">Silakan Ubah Profile Anda Untuk Ubah Photo Profile</div>'
                            );
                        }
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata(
                        'pesan',
                        '<div class="alert alert-danger alert-message" role="alert">Password salah!!</div>'
                    );
                    redirect('autentifikasi');
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-message" role="alert">User belum diaktivasi!!</div>'
                );
                redirect('autentifikasi');
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar!!</div>'
            );
            redirect('autentifikasi');
        }
    }

    public function blok()
    {
        $this->load->view('autentifikasi/blok');
    }

    public function gagal()
    {
        $this->load->view('autentifikasi/gagal');
    }

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        // Membuat rule untuk inputan nama agar tidak boleh kosong dengan membuat pesan error dengan bahasa sendiri yaitu 'Nama Belum Diisi'
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');

        /* 
        Membuat rule untuk inputan email agar tidak boleh kosong, tidak ada spasi, format email harus valid dan email belum
        pernah dipakai sama user lain dengan membuat pesan eror dengan bahasa sendiri yaitu jika format email tidak benar maka
        pesannya 'Email Tidak Benar!!', jika email belum diisi, maka pesannya adalah 'Eamil Belum Diisi', dan jika email yang 
        diinput sudah dipakai user lain, maka pesannya 'Email Sudah Terdaftar'
        */

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]');


        /*
        Membuat rule untuk inputan password agar tidak boleh kosong, tidak ada spasi, tidak boleh kurang dari 3 digit, dan password
        harus sama dengan repeat password dengan membuat pesan error dengan bahasa sendiri, yaitu jika password dan repeat password
        tidak diinput sama, maka pesannya 'Password Tidak Sama'. Jika password diisi kurang dari 3 digit, maka pesannya adalah
        'Password Terlalu Pendek'.
        */

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

        /*
        Jika di-submit  kemudian validasi form diatas tidak berjalan, maka akan tetap berada di tampilan registrasi. Tapi jika
        di-submit kemudian validasi form di atas berjalan, maka data yang diinput akan disimpan ke dalam tabel user
        */

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Registrasi Member';
            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/registrasi');
            $this->load->view('templates/aute_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'tanggal_input' => time()
            ];

            $this->ModelUser->simpanData($data); //Menggunakan Model
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-message" role="alert">
                    Selamat!! Akun member anda sudah dibuat. Silahkan aktivasi akun anda
                </div>'
            );
            redirect('autentifikasi');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('pesan', '
                <div class="alert alert-success" role="alert">
                &#127881; Anda berhasil logout
                </div>
            ');
        redirect('autentifikasi');
    }
}
