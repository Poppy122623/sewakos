<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public $base_model = 'M_login';
    public $base_controller = 'login';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('M_login');
        $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        if ($this->session->userdata('logIn')) {

            $level = $this->session->userdata('userPublik')['level'];
            if ($level == 1) {
                redirect('admin/dashboard');
            } elseif ($level == 2) {
                redirect('penyewa/dashboard');
            } else {
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                    <strong>Login Error, Masukkan username dan password dengan benar!</strong>
                </div>');
                redirect('login', 'refresh');
            }

        } else {
            $this->load->view('login');
        }
    }

    public function sign_in()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $usr_result = $this->M_login->login($username, $password);

        if ($usr_result) {
            $sessiondata = array(
                'id' => $usr_result['id_user'],
                'level' => $usr_result['id_level'],
                'username' => $usr_result['username'],
            );
            $this->session->set_userdata('logIn', true);
            $this->session->set_userdata('userPublik', $sessiondata);
            $level = $this->session->userdata('userPublik')['level'];

            if ($level == 1) {
                redirect('admin/dashboard');
            } elseif ($level == 2) {
                redirect('penyewa/dashboard');
            } else {
                $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                    <strong>Login Error, Masukkan username dan password dengan benar!</strong>
                </div>');
                redirect('login', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg_info', '<div style="font-size:12px;">
                <strong>Login Error, Masukkan username dan password dengan benar!</strong>
            </div>');
            redirect('login', 'refresh');
        }
    }

    public function sign_out()
    {
        $this->session->unset_userdata('logIn');
        $this->session->unset_userdata('userPublik');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}