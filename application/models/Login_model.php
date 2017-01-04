<?php

class Login_model extends CI_Model{
    public $table = 'users';
    function __construct(){
        parent::__construct();
        
    }
        // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
       // $this->db->insert('user_profile', array('userId' => $this->db->insert_id()));
    }

    function login_action($user, $pass)
    {
        if($pass!== ""){
            $this->db->select('*');
            $this->db->where(['username' => $user, 'userPassword' => $pass]);
            return $this->db->get($this->table)->result_array();
        }else return false;
    }
    function wp_login_action($user, $pass)
    {
        if($pass!== ""){
            $this->db->where(['user_login' => $user]);
            $wp_users =  $this->db->get('wp_users')->row();
            //echo $wp_users->user_pass;exit;
            
            include ('wordpress/wp-includes/class-phpass.php');

            global $wp_hasher;
            if ( empty($wp_hasher) ) {
                $wp_hasher = new PasswordHash(8, true);
            }
            $hash = $wp_hasher->HashPassword( trim( $pass ) );
            $wp_users_pass ='';
            if($wp_users)
            {
                $wp_users_pass=$wp_users->user_pass;
            }
            if($wp_hasher->CheckPassword($pass, $wp_users_pass) || md5($pass)==$wp_users_pass) {
                $this->db->where(['user_login' => $user]);
                $results =  $this->db->get('wp_users')->result_array();
                //echo $this->db->last_query();exit;
                return $results;
            } else {
                return false;
            }


        }else return false;
    }
    public function signup_action($value='')
    {
        # code...
    }

}