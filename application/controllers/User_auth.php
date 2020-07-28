<?php defined('BASEPATH') or exit('No direct script access allowed');
class User_auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load user model
        $this->load->model('user');
        $this->load->library('google');
    }

    public function index()
    {
        var_dump($this->input->post());
    }
}
