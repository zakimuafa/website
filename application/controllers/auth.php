<?php

class Auth extends CI_Controller{
    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', [
            'required'  => 'Username wajib diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required', [
            'required'  => 'Password wajib diisi!'
        ]);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header');
            $this->load->view('form_login');
            $this->load->view('templates/footer');
        }else {
            $auth = $this->model_auth->cek_login();
            $user_id = $this->session->userdata('user_id');
            $query = $this->db->get_where('tb_cart', ['user_id' => $user_id]);
            foreach ($query->result() as $item) {
            $data = array(
                'id'      => $item->product_id,
                'qty'     => $item->quantity,
                'price'   => $item->price,
                'name'    => $this->model_barang->find($item->product_id)->nama_brg // Fetch name
            );
        $this->cart->insert($data);
    }

    $this->db->delete('tb_cart', ['user_id' => $user_id]);

            if($auth == FALSE)
            {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            Username atau Password Salah!
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>');
                redirect('auth/login');
            }else {
                $this->session->set_userdata('username', $auth->username);
                $this->session->set_userdata('role_id', $auth->role_id);

                switch($auth->role_id){
                    case 1  : redirect('admin/dashboard_admin');
                              break;
                    case 2  : redirect('welcome');
                              break;
                    default : break;
                }
            }
        }
    }

    public function logout()
   {
    // Clear only the user-related session data
    $this->session->unset_userdata(['user_id', 'role_id']); // Adjust according to your session data keys
    redirect('auth/login');
   }
}