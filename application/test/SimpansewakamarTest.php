<?php
use PHPUnit\Framework\TestCase;

class SimpansewakamarTest extends TestCase
{
    public function testSimpansewakamar()
    {
        // Buat instance dari CI_Controller (Controller CodeIgniter) yang akan diuji
        $controller = new Simpansewakamar();

        // Buat objek CI_Session sesuai kebutuhan
        // Misalnya, jika Anda menggunakan database session, Anda perlu menginisialisasi objek session
        // $this->load->library('session');

        // Buat request HTTP POST yang sesuai
        $_POST['no_kamar'] = '123'; // Isi sesuai kebutuhan
        $_POST['tanggal_awal'] = '2023-01-01'; // Isi sesuai kebutuhan
        $_POST['tanggal_akhir'] = '2023-01-10'; // Isi sesuai kebutuhan

        // Inisialisasi session (jika diperlukan)
        $controller->session = $this->getMockBuilder('CI_Session')->disableOriginalConstructor()->getMock();

        // Jalankan fungsi yang akan diuji
        $controller->simpansewakamar();

        // Lakukan pengujian assertions di sini sesuai dengan logika bisnis Anda
        // Misalnya, Anda dapat memeriksa pesan flashdata, pengalihan, atau hasil dari fungsi yang diharapkan
        $this->assertEquals('Anda berhasil membuat sewa kamar', $controller->session->flashdata('msg_info'));
        $this->assertRedirect('penyewa/sewakamar');
    }
}