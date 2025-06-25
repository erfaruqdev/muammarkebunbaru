<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends CI_Model
{
    public $userId;
    public function __construct()
    {
        $this->userId = $this->session->userdata('user_id');
    }

    public function user()
    {
        return $this->db->get_where('users', ['id' => $this->userId])->row_object();
    }

    public function update()
    {
        $name = $this->input->post('name', true);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        if ($name == '' || $username == '' || $password == '') {
            return [
                'status' => 400,
                'message' => 'Pastikan semua bidang inputan sudah diisi'
            ];
        }

        $user = $this->user();
        if (!$user){
            return [
                'status' => 400,
                'message' => 'Data user tidak valid'
            ];
        }

        $regex = "/^[a-z]+$/";
        if (!preg_match($regex, $username)){
            return [
                'status' => 400,
                'message' => 'Username harus berufa huruf kecil tanpa spasi'
            ];
        }

        if (strlen($username) < 6){
            return [
                'status' => 400,
                'message' => 'Username harus minimal 6 karakter'
            ];
        }

        if (!password_verify($password, $user->password)){
            return [
                'status' => 400,
                'message' => 'Password salah'
            ];
        }

        $this->db->where('id', $this->userId)->update('users', [
            'name' => strtoupper($name),
            'username' => $username
        ]);

        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Gagal memperbarui profil'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }

    public function updatePassword()
    {
        $currentPassword = $this->input->post('current_password', true);
        $newPassword = $this->input->post('new_password', true);
        $passwordConfirmation = $this->input->post('password_confirmation', true);
        if ($currentPassword == '' || $newPassword == '' || $passwordConfirmation == ''){
            return [
                'status' => 400,
                'message' => 'Pastikan semua bidang inputan sudah diisi'
            ];
        }

        $user = $this->user();
        if (!$user){
            return [
                'status' => 400,
                'message' => 'Data user tidak valid'
            ];
        }

        if (strlen($newPassword) < 6){
            return [
                'status' => 400,
                'message' => 'Username harus minimal 6 karakter'
            ];
        }

        if ($newPassword != $passwordConfirmation){
            return [
                'status' => 400,
                'message' => 'Password tidak valid'
            ];
        }

        if (!password_verify($currentPassword, $user->password)){
            return [
                'status' => 400,
                'message' => 'Password saat ini salah'
            ];
        }

        $this->db->where('id', $this->userId)->update('users', [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);
        if ($this->db->affected_rows() <= 0) {
            return [
                'status' => 400,
                'message' => 'Gagal memperbarui password'
            ];
        }

        return [
            'status' => 200,
            'message' => 'Sukses'
        ];
    }
}
