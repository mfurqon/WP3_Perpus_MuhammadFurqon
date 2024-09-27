<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    public function getAllUser()
    {
        return $this->db->get('user');
    }

    public function getAllRole()
    {
        return $this->db->get('role');
    }

    public function simpanData($data = null)
    {
        $this->db->insert('user', $data);
    }

    public function hapusAnggota($where = null)
    {
        $this->db->delete('user', $where);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit(10, 0);
        return $this->db->get();
    }

    public function getByRoleId()
    {
        $this->db->select('
            user.* role, role.name
        ');
        $this->db->join('role', 'user.role = role.id');
        $this->db->from('user');
        $query = $this->db->get();
        return $query->result();
    }

    public function joinRoleIdById($where)
    {
        $this->db->select('user.*, role.role');
        $this->db->from('user');
        $this->db->join('role', 'user.role_id = role.id');
        $this->db->where($where);
        return $this->db->get();
    }
}
