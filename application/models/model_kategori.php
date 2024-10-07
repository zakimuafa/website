<?php

class Model_kategori extends CI_Model{
    public function data_abaya()
    {
        return $this->db->get_where('tb_barang', array('kategori' => 'abaya'));
    }

    public function data_hijab()
    {
        return $this->db->get_where('tb_barang', array('kategori' => 'hijab'));
    }
}