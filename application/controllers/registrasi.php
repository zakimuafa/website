<?php

class Registrasi extends CI_Controller{
    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required'  => 'Nama wajib diisi!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required'  => 'Username wajib diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|matches[ulangi_password]', [
            'required'  => 'Password wajib diisi!',
            'matches'   => 'Password tidak cocok!'
        ]);
        $this->form_validation->set_rules('ulangi_password', 'Password', 'required|matches[password]');
        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header');
            $this->load->view('registrasi');
            $this->load->view('templates/footer');
        }else {
            $data = array(
                'id'            => '',
                'nama'          => $this->input->post('nama'),
                'username'      => $this->input->post('username'),
                'password'      => $this->input->post('password'),
                'role_id'       => 2,
            );

            $this->db->insert('tb_user', $data);
            redirect('auth/login');
        }
        
    }
}