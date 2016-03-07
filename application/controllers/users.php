<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Users extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->model('user_model','',TRUE);
 }
 
 function index()
 {

 	 if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $type = 'General';
     $data['nameUser'] = $session_data['nameUser'];
     $data['users'] = $this->user_model->getAllUsers($type);
     $this->load->view('ehtml/header',$data);
     $this->load->helper(array('form'));
     $this->load->view('home/users',$data);
     $this->load->view('ehtml/footer');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 	

 }
  function newUser(){
      $data = array(
      'nameUser'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'passwd'=>$this->input->post('password'),
      'type'=>"General"
    );

    $this->user_model->newUser($data);
    redirect('users');
  }
  function updateUser(){
    $data = array(
      'nameUser'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'passwd'=>$this->input->post('password'),
      'type'=>"General"
    );
    $this->user_model->updateUser($this->uri->segment(3),$data);
    redirect('users');
  }
  function runViewEditUser($id){
   if($this->session->userdata('logged_in'))
     {
        $session_data = $this->session->userdata('logged_in');
        $data['nameUser'] = $session_data['nameUser'];
        $data['user'] = $this->user_model->getUser($id);
        $data['id'] = $id;
        $this->load->view('ehtml/header',$data);
        $this->load->helper(array('form'));
        $this->load->view('home/edit-user',$data);
        $this->load->view('ehtml/footer');
     }
     else
     {
       //If no session, redirect to login page
       redirect('login', 'refresh');
     }
  

  }
  function deleteUser(){
    $id = $this->uri->segment(3);
    $this->user_model->deleteUser($id);
    redirect('users');
  }
  
 
}