<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Memuat helper URL untuk menggunakan redirect()
        $this->load->library('logging'); // Memuat library logging CodeIgniter
    }

    public function redirect_to_specific_url() {
        // Log bahwa ada permintaan redirect
        log_message('info', 'Redirecting from /image/?piw=' . $_SERVER['QUERY_STRING']);

        // Redirect ke URL spesifik
        redirect('https://siakad.erudioindonesia.sch.id/janganmacemmacem');
    }
}
?>
