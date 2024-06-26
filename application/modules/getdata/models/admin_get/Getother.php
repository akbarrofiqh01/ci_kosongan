<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Getother extends CI_Model
{

    private static $data = [
        'status'     => true,
        'message'     => null,
    ];

    public function __construct()
    {
        parent::__construct();
        Self::$data['csrf_data']     = $this->security->get_csrf_hash();
    }

    function cariusers()
    {
        $username   = $this->input->get('username');

        $this->db->where('username', $username);
        $cekUserInternal  = $this->db->get('tb_users');
        if ($cekUserInternal->num_rows() != 0) {
            $userdata = $cekUserInternal->row();
            Self::$data['result'] = $userdata;
        } else {
            Self::$data['status']   = false;
            Self::$data['message']  = "Username Tujuan Tidak Ditemukan";
            Self::$data['type']     = 'error';
            Self::$data['result']   = array();
        }
        return Self::$data;
    }

    function showDataKategori(){
        $dataKategori = $this->db->get('tb_kategori');
        if($dataKategori->num_rows() != 0){
            foreach ($dataKategori as $valueKategori) {
                $json[] = [
                    $valueKategori->kategori_nama,
                    $valueKategori->kategori_date,
                    '<a data-href="<?php echo site_url("modal/admin/member-update?code="'$valueKategori->kategori_code') ?>" data-bs-title="Edit Kategori" data-bs-remote="false" data-bs-toggle="modal" data-bs-target="#dinamicModal" data-bs-backdrop="static" data-bs-keyboard="false" title="Edit Kategori" class="btn btn-sm btn-primary text-white mb-1">Edit</a>'. 
                ];
            }
            $response = array();
        }
    }
}
