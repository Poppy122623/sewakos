<?php
class admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
    }



    public function dashboard()
    {
        $this->load->view('admin/dashboard');
    }
}
?>