<?php
class Penyewa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_penyewa');
        $this->load->model('M_sewa');
    }



    public function dashboard()
    {
        $data['username'] = $this->session->userdata('userPublik')['username'];
        $this->load->view('penyewa/dashboard', $data);
    }

    public function profil()
    {
        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {
            $this->load->model('m_penyewa'); // Menggunakan model dengan huruf kecil
            $penyewa_result = $this->m_penyewa->data_penyewa($getiduser);

            if (!empty($penyewa_result)) {
                $data = array(
                    'username' => $this->session->userdata('userPublik')['username'],
                    'penyewa_result' => $penyewa_result
                );

                $this->load->view('penyewa/profil', $data);
            } else {
                // Eksepsi: Data penyewa tidak ditemukan
                show_error("Data penyewa tidak ditemukan", 404);
            }
        } else {
            // Eksepsi: Pengguna belum login
            show_error("Anda belum login", 401);
        }
    }


    public function sewakamar()
    {
        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {
            $this->load->model('m_penyewa'); // Menggunakan model dengan huruf kecil
            $penyewa_result = $this->m_penyewa->getid_penyewa($getiduser);

            if (!empty($penyewa_result)) {


                // Panggil model 'm_sewa' dengan parameter 'id_penyewa'
                $sewa_kamar = $this->M_sewa->get_all($penyewa_result['id_penyewa']);

                $data = array(
                    'username' => $this->session->userdata('userPublik')['username'],
                    'sewakamar' => $sewa_kamar
                );

                $this->load->view('penyewa/sewa_kamar', $data);
            } else {
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                <strong>Data penyewa tidak ditemukan</strong>
                 </div>');
                redirect('login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Anda belum login</strong>
        </div>');
            redirect('login', 'refresh');
        }
    }

    public function tagihan()
    {
        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {
            $this->load->model('m_penyewa'); // Menggunakan model dengan huruf kecil
            $penyewa_result = $this->m_penyewa->getid_penyewa($getiduser);

            if (!empty($penyewa_result)) {

                $this->load->model('m_tagihan');
                // Panggil model 'm_tagihan' dengan parameter 'id_penyewa'
                $data_tagihan = $this->m_tagihan->get_all($penyewa_result['id_penyewa']);
                $data = array(
                    'username' => $this->session->userdata('userPublik')['username'],
                    'datatagihan' => $data_tagihan
                );

                $this->load->view('penyewa/tagihan', $data);
            }
        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Anda belum login</strong>
        </div>');
            redirect('login', 'refresh');
        }
    }



    public function createsewakamar()
    {
        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {



            $this->load->model('m_kamar');
            $data_kamar = $this->m_kamar->get_all();

            if (!empty($data_kamar)) {
                $data = array(
                    'username' => $this->session->userdata('userPublik')['username'],
                    'datakamar' => $data_kamar
                );

                $this->load->view('penyewa/create_sewa_kamar', $data);
            } else {
                // Data_kamar kosong, atur pesan kesalahan
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                <strong>Data kamar kosong. Tambahkan data kamar terlebih dahulu.</strong>
                </div>');
                redirect('penyewa/daftarkamar', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Anda belum login</strong>
            </div>');
            redirect('login', 'refresh');
        }
    }

    public function edit_sewa($id_sewa)
    {
        // $getiduser = $this->session->userdata('userPublik')['id'];

        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {



            $this->load->model('m_kamar');
            $data_kamar = $this->m_kamar->get_all();

            if (!empty($data_kamar)) {


                $this->load->model('m_sewa');
                $data_sewa = $this->m_sewa->get_datasewa($id_sewa);
                $data = array(
                    'username' => $this->session->userdata('userPublik')['username'],
                    'datakamar' => $data_kamar,
                    'datasewa' => $data_sewa

                );

                $this->load->view('penyewa/edit_sewa_kamar', $data);
            } else {
                // Data_kamar kosong, atur pesan kesalahan
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                <strong>Data kamar kosong. Tambahkan data kamar terlebih dahulu.</strong>
                </div>');
                redirect('penyewa/daftarkamar', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Anda belum login</strong>
            </div>');
            redirect('login', 'refresh');
        }
    }



    public function simpansewakamar()
    {
        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {
            $no_kamar = $this->input->post('no_kamar');
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            if (empty($no_kamar) || empty($tanggal_awal) || empty($tanggal_akhir)) {
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Semua kolom harus diisi</strong>
            </div>');
                redirect('penyewa/create_sewa_kamar', 'refresh');
                return; // Jangan melanjutkan eksekusi jika ada data yang tidak valid
            } else {
                $this->load->model('m_penyewa'); // Menggunakan model dengan huruf kecil
                $penyewa_result = $this->m_penyewa->getid_penyewa($getiduser);

                if (!empty($penyewa_result)) {
                    $this->load->model('m_sewa');
                    $simpan_sewa = $this->m_sewa->simpan_sewa($penyewa_result['id_penyewa'], $no_kamar, $tanggal_awal, $tanggal_akhir);

                    if ($simpan_sewa) {
                        $this->session->set_flashdata('msg_info', '<div class="px-3 py-2 bg-gradient-primary text-white">
                        <strong>Anda berhasil membuat sewa kamar</strong>
                        </div>');
                        redirect('penyewa/sewakamar', 'refresh');
                    } else {
                        // Penyimpanan gagal, Anda dapat menangani kesalahan di sini atau menampilkan pesan kesalahan
                        $this->session->set_flashdata('msg_info', '<div class="px-3 py-2 bg-gradient-danger text-white"><strong>Gagal menyimpan data sewa.</strong></div>');
                        redirect('penyewa/create_sewa_kamar', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                <strong>Data penyewa tidak ditemukan</strong>
                 </div>');
                    redirect('login', 'refresh');
                }

            }

        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Anda belum login</strong>
            </div>');
            redirect('login', 'refresh');
        }

    }



    public function updatesewakamar()
    {
        $getiduser = $this->session->userdata('userPublik')['id'];

        if ($getiduser != '') {
            $no_kamar = $this->input->post('no_kamar');
            $idsewa = $this->input->post('idsewa');
            $tanggal_awal = $this->input->post('tanggal_awal');
            $tanggal_akhir = $this->input->post('tanggal_akhir');
            if (empty($no_kamar) || empty($tanggal_awal) || empty($tanggal_akhir)) {
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
            <strong>Semua kolom harus diisi</strong>
            </div>');
                redirect('penyewa/edit_sewa', 'refresh');
                return; // Jangan melanjutkan eksekusi jika ada data yang tidak valid
            } else {
                $this->load->model('m_penyewa');
                $penyewa_result = $this->m_penyewa->getid_penyewa($getiduser);

                if (!empty($penyewa_result)) {
                    $this->load->model('m_sewa');
                    $update_sewa = $this->m_sewa->update_sewa($idsewa, $penyewa_result['id_penyewa'], $no_kamar, $tanggal_awal, $tanggal_akhir);

                    if ($update_sewa) {
                        $this->session->set_flashdata('msg_info', '<div class="px-3 py-2 bg-gradient-primary text-white">
                    <strong>Anda berhasil update sewa kamar</strong>
                    </div>');
                        redirect('penyewa/sewakamar', 'refresh');
                    } else {
                        // Penyimpanan gagal, Anda dapat menangani kesalahan di sini atau menampilkan pesan kesalahan
                        $this->session->set_flashdata('msg_info', '<div class="px-3 py-2 bg-gradient-danger text-white"><strong>Gagal menyimpan data sewa.</strong></div>');
                        redirect('penyewa/edit_sewa', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                <strong>Data penyewa tidak ditemukan</strong>
                 </div>');
                    redirect('login', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
        <strong>Anda belum login</strong>
        </div>');
            redirect('login', 'refresh');
        }
    }



    public function hapus_sewa($id_sewa)
    {
        $confirmed = $this->input->get('confirmed');

        if ($confirmed === 'true') {
            $hapus_sewa = $this->M_sewa->hapus_sewa($id_sewa);

            if ($hapus_sewa) {
                $this->session->set_flashdata('msg_info', '<div class="px-3 py-2 bg-gradient-danger text-white">
                <strong>Data berhasil dihapus</strong>
                 </div>');
                redirect('penyewa/sewakamar', 'refresh');
            } else {
                echo "Gagal menghapus data sewa.";
            }
        } else {
            // Pengguna belum mengkonfirmasi, kembalikan ke halaman sebelumnya
            redirect('penyewa/sewakamar', 'refresh');
        }
    }




}
?>