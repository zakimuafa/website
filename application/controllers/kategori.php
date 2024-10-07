<?php

class Kategori extends CI_Controller{
    public function abaya()
    {
        $data['abaya'] = $this->model_kategori->data_abaya()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('abaya', $data);
        $this->load->view('templates/footer');
    }

    public function hijab()
    {
        $data['hijab'] = $this->model_kategori->data_hijab()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('hijab', $data);
        $this->load->view('templates/footer');
    }
}