<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Memuat library session
        $this->load->library('session');

        // Cek apakah user sudah login
        if($this->session->userdata('role_id') != '2') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        Anda Belum Login!
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>');
            redirect('auth/login');
        }
    }

    public function index() {
        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_ke_keranjang($id) {
        $barang = $this->model_barang->find($id);

        $data = array(
            'id'      => $barang->id_brg,
            'qty'     => 1,
            'price'   => $barang->harga,
            'name'    => $barang->nama_brg
        );
        
        $this->cart->insert($data);
        redirect('welcome');
    }

    public function detail_keranjang() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('keranjang');
        $this->load->view('templates/footer');
    }

    public function hapus_keranjang() {
        $this->cart->destroy();
        redirect('welcome');
    }

    public function lanjutkan_belanja() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }

    public function pembayaran() {
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pembayaran');
        $this->load->view('templates/footer');
    }

    public function proses_pesanan() {
        $is_processed = $this->model_invoice->index();
        if ($is_processed) {
            $this->cart->destroy();
            $this->load->view('templates/header');
            $this->load->view('templates/sidebar');
            $this->load->view('proses_pesanan');
            $this->load->view('templates/footer');
        } else {
            echo "Maaf, Pesanan Anda Gagal diproses!";
        }
    }

    public function detail($id_brg) {
        $data['barang'] = $this->model_barang->detail_brg($id_brg);
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('detail_barang', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_keranjang($id) {
        $barang = $this->model_barang->find($id);

        $data = array(
            'id'      => $barang->id_brg,
            'qty'     => 1,
            'price'   => $barang->harga,
            'name'    => $barang->nama_brg
        );

        $this->cart->insert($data);

        // Save to tb_cart table
        $this->db->insert('tb_cart', [
            'user_id' => $this->session->userdata('user_id'), // Ensure user_id is set
            'product_id' => $barang->id_brg,
            'quantity' => 1,
            'price' => $barang->harga
        ]);

        redirect('welcome');
    }

    // Tambahkan fungsi update_grand_total di sini
    public function update_grand_total() {
        $grand_total = $this->input->post('grand_total');
        $this->session->set_userdata('grand_total', $grand_total);
        echo json_encode(array('status' => 'success'));
    }
}
?>
