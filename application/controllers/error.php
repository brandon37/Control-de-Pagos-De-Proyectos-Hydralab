<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function error404() 
    { 
        $this->load->view('ehtml/headerError');
        $this->load->view('error/error404');
        $this->load->view('ehtml/footerError');
    } 
} 
?>