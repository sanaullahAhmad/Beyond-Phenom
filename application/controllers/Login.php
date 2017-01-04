<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_categories_model');
        $this->categories = $this->Product_categories_model->get_all();
    }

	public function index($value='')
	{
		
	}
	public function login($value='')
	{
		$data['indexx'] = $value;
        $this->session->unset_userdata('manufacture');
		$this->load->view('users/login', $data);
	}
	public function login_action($value='')
	{
		if($this->input->post('username') && $this->input->post('password'))
		{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			                  // print_r($this->input->post());exit;
			$this->load->model('Login_model', 'lm');
            if($this->session->manufacture == 'manufacture'){
                if( $userdata =$this->lm->login_action($username, md5($this->input->post('password')))){

                        //$userdata = $this->lm->login_action($username, $this->input->post('password'));
                        $this->session->set_userdata('manufacturerId', $userdata[0]['userId']);
                        $this->session->set_userdata('manufacturerName', $userdata[0]['username']);
                        redirect('manufacturer_dashboard');

                }
                else
                {
                    $this->session->set_flashdata('message','Incorrent Credentials. Please try again.');

                    if(isset($_GET['redirect']))
                    {
                        redirect('login?redirect='.$_GET['redirect']);
                    }
                    else{
                        redirect('manufacturer');
                    }
                }
            }
            else
            {
                if( $userdata =$this->lm->wp_login_action($username, $this->input->post('password'))){

                    //$userdata = $this->lm->wp_login_action($username, $this->input->post('password'));
                    $this->session->set_userdata('userId', $userdata[0]['ID']);
                    $this->session->set_userdata('username', $userdata[0]['user_nicename']);
                    $this->session->set_userdata('is_user_logged_id', true);
                    if(isset($_GET['redirect']))
                    {
                        //redirect($_GET['redirect']);
                        redirect(''.$_GET['redirect']);
                    }
                    else
                    {
                        redirect('welcome_dashboard');
                    }

                }
                else
                {
                    $this->session->set_flashdata('message','Incorrent Credentials. Please try again.');

                    if(isset($_GET['redirect']))
                    {
                        redirect('login?redirect='.$_GET['redirect']);
                    }
                    else{
                        redirect('login');
                    }
                }

            }
		
		}
		else
		{
			$this->session->set_flashdata('message','Enter your data. Please try again.');
            redirect('login');
		}
	}
	public function signup($value='')
	{
		$data['indexx'] = $value;
		$this->load->view('users/signup', $data);
	}
	public function signup_action()
	{   
	    $this->load->library('form_validation');
	    $this->load->model('Login_model', 'lm');

	    $userEmail = $this->input->post('email');

	    $username = $this->input->post('username');
	    /*print_r($username);
	    exit;*/

	    $userPassword = md5($this->input->post('password'));

	    $this->form_validation->set_rules('email', 'User Email', 'required|trim');
	    $this->form_validation->set_rules('username', 'User Name', 'required|trim|min_length[4]|is_unique[users.username]');
	    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[4]');

	    if ($this->form_validation->run() == FALSE) {

	        $this->session->set_flashdata('message','User name is alread exits name!');
	        $data['indexx'] = '';
	        $this->load->view('users/signup', $data);
	    }
	    else
	    {
	        $data = array(
	            'userEmail' => $userEmail ,
	            'username'=> $username,
                'userPassword' => $userPassword,
                'userFirstName' => $this->input->post('userFirstName'),
                'userLastName' => $this->input->post('userLastName'),
                'userDob' => $this->input->post('userDob'),
                'userGender' => $this->input->post('userGender'),
                'userSex' => $this->input->post('userGender'),
                'userInfo' => $this->input->post('userInfo'),
                'userAddress' => $this->input->post('userAddress'),
                'userTelephone' => $this->input->post('userTelephone'),
                'userCity' => $this->input->post('userCity'),
                'userCountry' => $this->input->post('userCountry'),
                'userType' => '1',
                'userStatus' => '1',
                'userRegistrationDate' => date('Y-m-d H:i:s'),
	            );
            $config['upload_path'] = './public/uploads/users';
            $config['allowed_types'] = '*';
            $config['file_ext_tolower'] = TRUE;
            $config['max_size'] = 999000;
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->set_allowed_types('*');
            if (!empty($_FILES['userProfilePicture']['name'])) {
                $this->upload->initialize($config);
                if ($this->upload->do_upload('userProfilePicture')) {
                    $up_data = $this->upload->data();
                    $data['userProfilePicture'] = $up_data['file_name'];
                }
            }

	        $result = $this->lm->insert($data);
	        if ($result == FALSE) {
	        	/*if ($this->url->segments) {
	        		# code...
	        	}*/
                $userdata = $this->lm->login_action($username, $userPassword);
                $this->session->set_userdata('userId', $userdata[0]['userId']);
                $this->session->set_userdata('username', $userdata[0]['username']);
                $this->session->set_userdata('is_user_logged_id', true);
                if(isset($_GET['redirect']))
                {
                    redirect($_GET['redirect']);
                }
                else{
                    redirect('welcome_dashboard');
                }
	                // send varify email link
	        }
	        else
	        {
	            echo "Login failed!";
	        }
	    }
	}
	public function welcome_dashboard()
	{
        if($this->session->userdata('userId')=='')
        {
            redirect('login');
        }
		$data['indexx'] = '';
        $this->db->where('userId', $this->session->userdata('userId'));
        $this->db->order_by('orderId', 'desc');
        $orders = $this->db->get('user_orders');
        $row = $orders->result();
        $data['orders']= $row;
	    $this->load->view('users/welcome_dashboard',$data);
	}
	function logout(){
	    $this->session->sess_destroy();
	    redirect(site_url('login'));
	         // $message = "You have been successfully Logged Out!";
	              // $this->index($message);
	}
	public function manufacturer($value='')
	{
		$data['indexx'] = '';
		$this->session->set_userdata('manufacture', 'manufacture');
        $this->load->view('users/login', $data);
		
	}
    public function manufacturer_dashboard($value='')
    {
        if($this->session->userdata('manufacturerId')=='')
        {
            redirect('manufacturer');
        }
        $data['indexx'] = '';
        //for getting manufacturer orders
        $this->db->where('manufacturer_permission', '1');
        $this->db->where('manufacturer_id', $this->session->userdata('manufacturerId'));
        $orders         = $this->db->get('user_orders');
        $row            = $orders->result();
        $data['orders'] = $row;
        //for getting manufacturer orders
        $this->load->view('users/manufacturer_dashboard', $data);
    }
    public function change_status()
    {
        $status = $this->input->post('status');
        $order_id = $this->input->post('order_id');
        $data = array('orderStatus' => $status);
        $this->db->where('orderId', $order_id);
        $this->db->update('user_orders', $data);
    }
}