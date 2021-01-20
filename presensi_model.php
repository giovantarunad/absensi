<?php
defined('BASEPATH') or exit('No direct script access');

class Presensi_model extends CI_MODEL
{

    public $variable;

    public function __construct()
    {
        parent::__construct();
    }

    public function getRolebyId($id)
    {
        return $this->db->get_where('presensi', ['id_presen' => $id])->row_array();
    }

    function get_presensi()
    {
        $query = "SELECT `presensi`.*, `user`.*
        FROM `user` JOIN `presensi`
        ON `user`.`id` = `presensi`.`id_user`
        ";
        return $this->db->query($query)->result_array();
    }

    public function delete_presensi($presensi_id)
    {
        $this->db->where('id_presen', $presensi_id);
        $this->db->delete('presensi');
    }

    public function edit_presensi($id_presen)
    {
        $data = [
            "id_presen" => $this->input->post('id_presen', true),
            "status" => $this->input->post('status', true)
        ];

        $this->db->where('id_presen', $this->input->post('id_presen'));
        $this->db->update('presensi', $data);
    }

    function get_presensi_siswa($id)
    {
        $query = "SELECT * FROM USER JOIN presensi 
        on USER.id = presensi.id_user 
        WHERE presensi.id_user = $id";

        return $this->db->query($query)->result_array();
    }

    //function insert($data){
    //  $this->db->insert('presensi', $data);
    //return $this->db->insert_id();
    //}

    function get_daftar_siswa()
    {
        $query = "SELECT * FROM USER
		WHERE role_id = 2;
        ";
        return $this->db->query($query)->result_array();
    }

    function get_jam()
    {
        $query = "SELECT jam_datang, jam_pulang FROM jam";
        return $this->db->query($query)->row();
    }

    function cek_absen($id_user, $tanggalHariIni)
    {
        $query = "SELECT * FROM presensi
		WHERE id_user = '$id_user' AND tanggal = '$tanggalHariIni' ";

        return $this->db->query($query)->result_array();
    }
}
