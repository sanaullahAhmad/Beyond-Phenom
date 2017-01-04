<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Order_product_model');
        $this->load->library('form_validation');
        date_default_timezone_set('America/New_York');
    }

    public function index()
    {
        $order_product = $this->Order_product_model->get_all();

        $data = array(
            'order_product_data' => $order_product
        );

        $data['main'] = 'order_product_list';
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Order_product_model->get_by_id($id);
        if ($row) {
            $data = array(
		'order_product_id' => $row->order_product_id,
		'orderId' => $row->orderId,
		'productId' => $row->productId,
		'name' => $row->name,
		'base_svg' => $row->base_svg,
		'sizes' => $row->sizes,
		'quantities' => $row->quantities,
		'price' => $row->price,
		'total' => $row->total,
		'middle_svg' => $row->middle_svg,
		'top_svg' => $row->top_svg,
		'model_obj' => $row->model_obj,
		'model_mtl' => $row->model_mtl,
		'generate_file_name' => $row->generate_file_name,
		'session_user' => $row->session_user,
		'imgoffsety' => $row->imgoffsety,
		'imgoffsetx' => $row->imgoffsetx,
		'imgangle' => $row->imgangle,
		'myRange' => $row->myRange,
		'imgrepeat' => $row->imgrepeat,
		'patterenused' => $row->patterenused,
		'tax' => $row->tax,
		'reward' => $row->reward,
	    );

            $data['main'] = 'order_product_read';
            $this->load->view('admin/template',$data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order_product'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('order_product/create_action'),
	    'order_product_id' => set_value('order_product_id'),
	    'orderId' => set_value('orderId'),
	    'productId' => set_value('productId'),
	    'name' => set_value('name'),
	    'base_svg' => set_value('base_svg'),
	    'sizes' => set_value('sizes'),
	    'quantities' => set_value('quantities'),
	    'price' => set_value('price'),
	    'total' => set_value('total'),
	    'middle_svg' => set_value('middle_svg'),
	    'top_svg' => set_value('top_svg'),
	    'model_obj' => set_value('model_obj'),
	    'model_mtl' => set_value('model_mtl'),
	    'generate_file_name' => set_value('generate_file_name'),
	    'session_user' => set_value('session_user'),
	    'imgoffsety' => set_value('imgoffsety'),
	    'imgoffsetx' => set_value('imgoffsetx'),
	    'imgangle' => set_value('imgangle'),
	    'myRange' => set_value('myRange'),
	    'imgrepeat' => set_value('imgrepeat'),
	    'patterenused' => set_value('patterenused'),
	    'tax' => set_value('tax'),
	    'reward' => set_value('reward'),
	);

        $data['main'] = 'order_product_form';
        $this->load->view('admin/template',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'orderId' => $this->input->post('orderId',TRUE),
		'productId' => $this->input->post('productId',TRUE),
		'name' => $this->input->post('name',TRUE),
		'base_svg' => $this->input->post('base_svg',TRUE),
		'sizes' => $this->input->post('sizes',TRUE),
		'quantities' => $this->input->post('quantities',TRUE),
		'price' => $this->input->post('price',TRUE),
		'total' => $this->input->post('total',TRUE),
		'middle_svg' => $this->input->post('middle_svg',TRUE),
		'top_svg' => $this->input->post('top_svg',TRUE),
		'model_obj' => $this->input->post('model_obj',TRUE),
		'model_mtl' => $this->input->post('model_mtl',TRUE),
		'generate_file_name' => $this->input->post('generate_file_name',TRUE),
		'session_user' => $this->input->post('session_user',TRUE),
		'imgoffsety' => $this->input->post('imgoffsety',TRUE),
		'imgoffsetx' => $this->input->post('imgoffsetx',TRUE),
		'imgangle' => $this->input->post('imgangle',TRUE),
		'myRange' => $this->input->post('myRange',TRUE),
		'imgrepeat' => $this->input->post('imgrepeat',TRUE),
		'patterenused' => $this->input->post('patterenused',TRUE),
		'tax' => $this->input->post('tax',TRUE),
		'reward' => $this->input->post('reward',TRUE),
	    );

            $this->Order_product_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('order_product'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Order_product_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('order_product/update_action'),
		'order_product_id' => set_value('order_product_id', $row->order_product_id),
		'orderId' => set_value('orderId', $row->orderId),
		'productId' => set_value('productId', $row->productId),
		'name' => set_value('name', $row->name),
		'base_svg' => set_value('base_svg', $row->base_svg),
		'sizes' => set_value('sizes', $row->sizes),
		'quantities' => set_value('quantities', $row->quantities),
		'price' => set_value('price', $row->price),
		'total' => set_value('total', $row->total),
		'middle_svg' => set_value('middle_svg', $row->middle_svg),
		'top_svg' => set_value('top_svg', $row->top_svg),
		'model_obj' => set_value('model_obj', $row->model_obj),
		'model_mtl' => set_value('model_mtl', $row->model_mtl),
		'generate_file_name' => set_value('generate_file_name', $row->generate_file_name),
		'session_user' => set_value('session_user', $row->session_user),
		'imgoffsety' => set_value('imgoffsety', $row->imgoffsety),
		'imgoffsetx' => set_value('imgoffsetx', $row->imgoffsetx),
		'imgangle' => set_value('imgangle', $row->imgangle),
		'myRange' => set_value('myRange', $row->myRange),
		'imgrepeat' => set_value('imgrepeat', $row->imgrepeat),
		'patterenused' => set_value('patterenused', $row->patterenused),
		'tax' => set_value('tax', $row->tax),
		'reward' => set_value('reward', $row->reward),
	    );

            $data['main'] = 'order_product_form';
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order_product'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('order_product_id', TRUE));
        } else {
            $data = array(
		'orderId' => $this->input->post('orderId',TRUE),
		'productId' => $this->input->post('productId',TRUE),
		'name' => $this->input->post('name',TRUE),
		'base_svg' => $this->input->post('base_svg',TRUE),
		'sizes' => $this->input->post('sizes',TRUE),
		'quantities' => $this->input->post('quantities',TRUE),
		'price' => $this->input->post('price',TRUE),
		'total' => $this->input->post('total',TRUE),
		'middle_svg' => $this->input->post('middle_svg',TRUE),
		'top_svg' => $this->input->post('top_svg',TRUE),
		'model_obj' => $this->input->post('model_obj',TRUE),
		'model_mtl' => $this->input->post('model_mtl',TRUE),
		'generate_file_name' => $this->input->post('generate_file_name',TRUE),
		'session_user' => $this->input->post('session_user',TRUE),
		'imgoffsety' => $this->input->post('imgoffsety',TRUE),
		'imgoffsetx' => $this->input->post('imgoffsetx',TRUE),
		'imgangle' => $this->input->post('imgangle',TRUE),
		'myRange' => $this->input->post('myRange',TRUE),
		'imgrepeat' => $this->input->post('imgrepeat',TRUE),
		'patterenused' => $this->input->post('patterenused',TRUE),
		'tax' => $this->input->post('tax',TRUE),
		'reward' => $this->input->post('reward',TRUE),
	    );

            $this->Order_product_model->update($this->input->post('order_product_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('order_product'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Order_product_model->get_by_id($id);

        if ($row) {
            $this->Order_product_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('order_product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('order_product'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('orderId', 'orderid', 'trim|required');
	$this->form_validation->set_rules('productId', 'productid', 'trim|required');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('base_svg', 'base svg', 'trim|required');
	$this->form_validation->set_rules('sizes', 'sizes', 'trim|required');
	$this->form_validation->set_rules('quantities', 'quantities', 'trim|required');
	$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
	$this->form_validation->set_rules('total', 'total', 'trim|required|numeric');
	$this->form_validation->set_rules('middle_svg', 'middle svg', 'trim|required');
	$this->form_validation->set_rules('top_svg', 'top svg', 'trim|required');
	$this->form_validation->set_rules('model_obj', 'model obj', 'trim|required');
	$this->form_validation->set_rules('model_mtl', 'model mtl', 'trim|required');
	$this->form_validation->set_rules('generate_file_name', 'generate file name', 'trim|required');
	$this->form_validation->set_rules('session_user', 'session user', 'trim|required');
	$this->form_validation->set_rules('imgoffsety', 'imgoffsety', 'trim|required');
	$this->form_validation->set_rules('imgoffsetx', 'imgoffsetx', 'trim|required');
	$this->form_validation->set_rules('imgangle', 'imgangle', 'trim|required');
	$this->form_validation->set_rules('myRange', 'myrange', 'trim|required');
	$this->form_validation->set_rules('imgrepeat', 'imgrepeat', 'trim|required');
	$this->form_validation->set_rules('patterenused', 'patterenused', 'trim|required');
	$this->form_validation->set_rules('tax', 'tax', 'trim|required|numeric');
	$this->form_validation->set_rules('reward', 'reward', 'trim|required');

	$this->form_validation->set_rules('order_product_id', 'order_product_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "order_product.xls";
        $judul = "order_product";
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
	xlsWriteLabel($tablehead, $kolomhead++, "OrderId");
	xlsWriteLabel($tablehead, $kolomhead++, "ProductId");
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Base Svg");
	xlsWriteLabel($tablehead, $kolomhead++, "Sizes");
	xlsWriteLabel($tablehead, $kolomhead++, "Quantities");
	xlsWriteLabel($tablehead, $kolomhead++, "Price");
	xlsWriteLabel($tablehead, $kolomhead++, "Total");
	xlsWriteLabel($tablehead, $kolomhead++, "Middle Svg");
	xlsWriteLabel($tablehead, $kolomhead++, "Top Svg");
	xlsWriteLabel($tablehead, $kolomhead++, "Model Obj");
	xlsWriteLabel($tablehead, $kolomhead++, "Model Mtl");
	xlsWriteLabel($tablehead, $kolomhead++, "Generate File Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Session User");
	xlsWriteLabel($tablehead, $kolomhead++, "Imgoffsety");
	xlsWriteLabel($tablehead, $kolomhead++, "Imgoffsetx");
	xlsWriteLabel($tablehead, $kolomhead++, "Imgangle");
	xlsWriteLabel($tablehead, $kolomhead++, "MyRange");
	xlsWriteLabel($tablehead, $kolomhead++, "Imgrepeat");
	xlsWriteLabel($tablehead, $kolomhead++, "Patterenused");
	xlsWriteLabel($tablehead, $kolomhead++, "Tax");
	xlsWriteLabel($tablehead, $kolomhead++, "Reward");

	foreach ($this->Order_product_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->orderId);
	    xlsWriteNumber($tablebody, $kolombody++, $data->productId);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->base_svg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->sizes);
	    xlsWriteLabel($tablebody, $kolombody++, $data->quantities);
	    xlsWriteNumber($tablebody, $kolombody++, $data->price);
	    xlsWriteNumber($tablebody, $kolombody++, $data->total);
	    xlsWriteLabel($tablebody, $kolombody++, $data->middle_svg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->top_svg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->model_obj);
	    xlsWriteLabel($tablebody, $kolombody++, $data->model_mtl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->generate_file_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->session_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->imgoffsety);
	    xlsWriteLabel($tablebody, $kolombody++, $data->imgoffsetx);
	    xlsWriteLabel($tablebody, $kolombody++, $data->imgangle);
	    xlsWriteLabel($tablebody, $kolombody++, $data->myRange);
	    xlsWriteLabel($tablebody, $kolombody++, $data->imgrepeat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->patterenused);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tax);
	    xlsWriteNumber($tablebody, $kolombody++, $data->reward);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=order_product.doc");

        $data = array(
            'order_product_data' => $this->Order_product_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('order_product_doc',$data);
    }

}

/* End of file Order_product.php */
/* Location: ./application/controllers/Order_product.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-11 09:05:39 */
/* http://harviacode.com */