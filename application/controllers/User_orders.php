<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_orders_model');
        $this->load->library('form_validation');

        $protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
        $this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        if($this->session->userdata('adminId')==""){
            redirect('myadmin'."?next=".$this->url);
        }
    }

    public function index()
    {
        $user_orders = $this->User_orders_model->get_all();

        $this->load->model('Users_model');
        foreach ($user_orders as $key => $category) {
            $cr_by = $this->Users_model->get_wp_users($category->userId);
            //echo $cr_by[0]['username'];exit;
            if($cr_by)
            {
                $user_orders{$key}->username = $cr_by[0]['user_login'];
            }
            else{
                $user_orders{$key}->username = '';
            }
        }

        $data = array(
            'user_orders_data' => $user_orders
        );


        $data['main'] = 'user_orders_list';
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->User_orders_model->get_by_id($id);
        if ($row) {
            $data = array(
            'orderId' => $row->orderId,
            'order_price' => $row->order_price,
            'billing_address' => $row->billing_address,
            'delivery_address' => $row->delivery_address,
            'billing_method' => $row->billing_method,
            'delivery_method' => $row->delivery_method,
            'userId' => $row->userId,
            'created_date' => $row->created_date,
            );
            $this->load->model('Users_model');
            $row2 = $this->Users_model->get_user($row->userId);
            $data['username']=$row2[0]['username'];



            $this->load->model('User_orders_model');
            $this->load->model('Product_sizes_model');
            $order_details         = $this->User_orders_model->get_by_id($id);
            $data['order_details'] = $order_details;

            $this->db->where('orderId', $id);
            $row        = $this->db->get('order_product');
            $order_info = $row->result();
            $data['order_info'] = $order_info;


            $data['main'] = 'user_orders_read';
            $this->load->view('admin/template',$data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_orders'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user_orders/create_action'),
	    'orderId' => set_value('orderId'),
	    'order_price' => set_value('order_price'),
	    'billing_address' => set_value('billing_address'),
	    'delivery_address' => set_value('delivery_address'),
	    'billing_method' => set_value('billing_method'),
	    'delivery_method' => set_value('delivery_method'),
	    'userId' => set_value('userId'),
	    'created_date' => set_value('created_date'),
	);
        $this->load->view('user_orders_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'order_price' => $this->input->post('order_price',TRUE),
		'billing_address' => $this->input->post('billing_address',TRUE),
		'delivery_address' => $this->input->post('delivery_address',TRUE),
		'billing_method' => $this->input->post('billing_method',TRUE),
		'delivery_method' => $this->input->post('delivery_method',TRUE),
		'userId' => $this->input->post('userId',TRUE),
		'created_date' => $this->input->post('created_date',TRUE),
	    );

            $this->User_orders_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('user_orders'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->User_orders_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user_orders/update_action'),
		'orderId' => set_value('orderId', $row->orderId),
		'order_price' => set_value('order_price', $row->order_price),
		'billing_address' => set_value('billing_address', $row->billing_address),
		'delivery_address' => set_value('delivery_address', $row->delivery_address),
		'billing_method' => set_value('billing_method', $row->billing_method),
		'delivery_method' => set_value('delivery_method', $row->delivery_method),
		'userId' => set_value('userId', $row->userId),
		'created_date' => set_value('created_date', $row->created_date),
	    );

            $data['main'] = 'user_orders_form';
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_orders'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('orderId', TRUE));
        } else {
            $data = array(
		'order_price' => $this->input->post('order_price',TRUE),
		'billing_address' => $this->input->post('billing_address',TRUE),
		'delivery_address' => $this->input->post('delivery_address',TRUE),
		'billing_method' => $this->input->post('billing_method',TRUE),
		'delivery_method' => $this->input->post('delivery_method',TRUE),
		'userId' => $this->input->post('userId',TRUE),
		'created_date' => $this->input->post('created_date',TRUE),
	    );

            $this->User_orders_model->update($this->input->post('orderId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user_orders'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_orders_model->get_by_id($id);

        if ($row) {
            $this->User_orders_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user_orders'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user_orders'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('order_price', 'order price', 'trim|required');
	$this->form_validation->set_rules('billing_address', 'billing address', 'trim|required');
	$this->form_validation->set_rules('delivery_address', 'delivery address', 'trim|required');
	$this->form_validation->set_rules('billing_method', 'billing method', 'trim|required');
	$this->form_validation->set_rules('delivery_method', 'delivery method', 'trim|required');
	$this->form_validation->set_rules('userId', 'userid', 'trim|required');
	$this->form_validation->set_rules('created_date', 'created date', 'trim|required');

	$this->form_validation->set_rules('orderId', 'orderId', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user_orders.xls";
        $judul = "user_orders";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Order Price");
	xlsWriteLabel($tablehead, $kolomhead++, "Billing Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Delivery Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Billing Method");
	xlsWriteLabel($tablehead, $kolomhead++, "Delivery Method");
	xlsWriteLabel($tablehead, $kolomhead++, "UserId");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");

	foreach ($this->User_orders_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->order_price);
	    xlsWriteLabel($tablebody, $kolombody++, $data->billing_address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->delivery_address);
	    xlsWriteLabel($tablebody, $kolombody++, $data->billing_method);
	    xlsWriteLabel($tablebody, $kolombody++, $data->delivery_method);
	    xlsWriteNumber($tablebody, $kolombody++, $data->userId);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=user_orders.doc");

        $data = array(
            'user_orders_data' => $this->User_orders_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('user_orders_doc',$data);
    }


    public function load_manufacturers()
    {
        $userType = $this->input->post('userType');
        $orderId = $this->input->post('orderId');
        $this->db->where('userType', $userType);
        $rows = $this->db->get('users');
        $users = $rows->result();
        $select_mockup = '<select class="form-control" onchange="select_manuf(this.value, '.$orderId.')" >';
        $select_mockup .= '<option value="">--Select--</option>';
        if($users)
        {
            foreach ($users as $user)
            {
                $select_mockup .= '<option value="'.$user->userId.'">'.$user->username.'</option>';
            }
        }
        $select_mockup .= '</select>';

        echo $select_mockup;
    }
    public function select_manuf()
    {
        $manufacturerId = $this->input->post('manufacturerId');
        $orderId = $this->input->post('orderId');
        $data = array('manufacturer_permission'=>1,
            'manufacturer_id'=>$manufacturerId);
        $this->db->where('orderId', $orderId);
        $this->db->update('user_orders', $data);

    }

}

/* End of file User_orders.php */
/* Location: ./application/controllers/User_orders.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-11 09:06:31 */
/* http://harviacode.com */