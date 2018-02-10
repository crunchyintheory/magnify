<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Magnify404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['nosidebar'] = true;
        $data['sidebar'] = [];
        $data['title'] = 'Error';
        
        $this->output->set_status_header('404');
        $this->load->view('templates/header', $data);
        $this->load->view('errors/html/error_404');
        $this->load->view('templates/footer', $data);
    }
}