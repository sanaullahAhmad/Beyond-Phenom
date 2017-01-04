<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_sizes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_sizes_model');
        $this->load->library('form_validation');
    }

    public function show($prod_cat_id=null)
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'product_sizes?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'product_sizes?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'product_sizes';
            $config['first_url'] = base_url() . 'product_sizes';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Product_sizes_model->total_rows($q, $prod_cat_id);
        $product_sizes = $this->Product_sizes_model->get_limit_data($config['per_page'], $start, $q, $prod_cat_id);

        $this->load->model('Admins_model');
        $this->load->model('Product_categories_model');
        foreach ($product_sizes as $key => $layer) {
            $cr_by = $this->Admins_model->get_by_id($layer->created_by);
            $product_sizes{$key}->created_by = $cr_by->adminName;

            $cat_info = $this->Product_categories_model->get_by_id($layer->categoryId);
            $product_sizes{$key}->categoryTitle = $cat_info->categoryTitle;
            $product_sizes{$key}->categoryId = $cat_info->categoryId;
        }

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'product_sizes_data' => $product_sizes,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'product_category' => $this->Product_categories_model->get_by_id($prod_cat_id)
            );
        // $this->load->view('product_sizes_list', $data);
        $data['main'] = 'product_sizes_list';
        $this->load->view('admin/template',$data);
    }

    public function read($id) 
    {
        $row = $this->Product_sizes_model->get_by_id($id);
        if ($row) {
            $data = array(
              'sizeId' => $row->sizeId,
              'sizeTitle' => $row->sizeTitle,
              'size' => $row->size,
              'output_file_width' => $row->output_file_width,
              'output_file_height' => $row->output_file_height,
              'resize_factor' => $row->resize_factor,
              'sizeFIleSVG' => $row->sizeFIleSVG,
              'sizeFilePNG' => $row->sizeFilePNG,
              'categoryId' => $row->categoryId,
              'created_date' => $row->created_date,
              'created_by' => $row->created_by,
              'modified_date' => $row->modified_date,
              'modified_by' => $row->modified_by,
              );
            // $this->load->view('product_sizes_read', $data);

            $this->load->model('Admins_model');
            $this->load->model('Product_categories_model');

            $cr_by = $this->Admins_model->get_by_id($data['created_by']);
            $data['created_by'] = $cr_by->adminName;
            $md_by = $this->Admins_model->get_by_id($data['modified_by']);
            if($md_by)
            {
                $data['modified_by'] = $md_by->adminName;
            }
            else{
                $data['modified_by'] = '';
            }

            $cat_info = $this->Product_categories_model->get_by_id($data['categoryId']);
            $data['categoryTitle'] = $cat_info->categoryTitle;



            $data['main'] = 'product_sizes_read';
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('product_sizes'));
        }
    }

    public function create($prod_cat_id)
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('product_sizes/create_action'),
            'sizeId' => set_value('sizeId'),
            'sizeTitle' => set_value('sizeTitle'),
            'size' => set_value('size'),
            'output_file_width' => set_value('output_file_width'),
            'output_file_height' => set_value('output_file_height'),
            'ressize_factor' => set_value('ressize_factor'),
            'sizeFIleSVG' => set_value('sizeFIleSVG'),
            'sizeFilePNG' => set_value('sizeFilePNG'),
            'categoryId' => set_value('categoryId'),
            'created_date' => set_value('created_date'),
            'created_by' => set_value('created_by'),
            'modified_date' => set_value('modified_date'),
            'modified_by' => set_value('modified_by'),
            );
        // $this->load->view('product_sizes_form', $data);

        $this->load->model('Product_categories_model');
        $product_categories = $this->Product_categories_model->get_all();
        $data['product_categories'] = $product_categories;

        $data['main'] = 'product_sizes_form';
        $this->load->view('admin/template',$data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
              'sizeTitle' => $this->input->post('sizeTitle',TRUE),
              'size' => $this->input->post('size',TRUE),
              'output_file_width' => $this->input->post('output_file_width',TRUE),
              'output_file_height' => $this->input->post('output_file_height',TRUE),
              'resize_factor' => $this->input->post('resize_factor',TRUE),
              'categoryId' => $this->input->post('categoryId',TRUE),
              'created_date' => date('Y-m-d H:i:s'),
              'created_by' => $this->session->userdata('adminId')
              );
            $this->Product_sizes_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url( 'product_sizes/show/'.$this->input->post('categoryId') ));


        }
    }
    
    public function update($id) 
    {
        $row = $this->Product_sizes_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('product_sizes/update_action'),
                'sizeId' => set_value('sizeId', $row->sizeId),
                'sizeTitle' => set_value('sizeTitle', $row->sizeTitle),
                'size' => set_value('size', $row->size),
                'output_file_width' => set_value('output_file_width', $row->output_file_width),
                'output_file_height' => set_value('output_file_height', $row->output_file_height),
                'resize_factor' => set_value('resize_factor', $row->resize_factor),
                'sizeFIleSVG' => set_value('sizeFIleSVG', $row->sizeFIleSVG),
                'sizeFilePNG' => set_value('sizeFilePNG', $row->sizeFilePNG),
                'categoryId' => set_value('categoryId', $row->categoryId),
                'created_date' => set_value('created_date', $row->created_date),
                'created_by' => set_value('created_by', $row->created_by),
                'modified_date' => set_value('modified_date', $row->modified_date),
                'modified_by' => set_value('modified_by', $row->modified_by),
                );
            // $this->load->view('product_sizes_form', $data);
$this->load->model('Product_categories_model');
$product_categories = $this->Product_categories_model->get_all();
$data['product_categories'] = $product_categories;
$data['main'] = 'product_sizes_form';
$this->load->view('admin/template',$data);

} else {
    $this->session->set_flashdata('message', 'Record Not Found');
    redirect(site_url('product_sizes'));
}
}

public function update_action() 
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->update($this->input->post('sizeId', TRUE));
    } else {
        $data = array(
          'sizeTitle' => $this->input->post('sizeTitle',TRUE),
          'size' => $this->input->post('size',TRUE),
          'output_file_width' => $this->input->post('output_file_width',TRUE),
          'output_file_height' => $this->input->post('output_file_height',TRUE),
          'resize_factor' => $this->input->post('resize_factor',TRUE),
          'sizeFIleSVG' => $this->input->post('sizeFIleSVG',TRUE),
          'sizeFilePNG' => $this->input->post('sizeFilePNG',TRUE),
          'categoryId' => $this->input->post('categoryId',TRUE),

          'modified_date' => date('Y-m-d H:i:s'),
          'modified_by' => $this->session->userdata('adminId')
          );

        $this->Product_sizes_model->update($this->input->post('sizeId', TRUE), $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('product_sizes/show/'.$this->input->post('categoryId')));
    }
}

public function delete($id,$prod_cat_id)
{
    $row = $this->Product_sizes_model->get_by_id($id);

    if ($row) {
        $this->Product_sizes_model->delete($id);
        $this->session->set_flashdata('message', 'Delete Record Success');
        redirect(site_url('product_sizes/show/'.$prod_cat_id));
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('product_sizes/show/'.$prod_cat_id));
    }
}

public function _rules() 
{
 $this->form_validation->set_rules('sizeTitle', 'sizetitle', 'trim|required');
 $this->form_validation->set_rules('size', 'size', 'trim|required');
 $this->form_validation->set_rules('output_file_width', 'output_file_width', 'trim|required');
 $this->form_validation->set_rules('output_file_height', 'output_file_height', 'trim|required');
 // $this->form_validation->set_rules('output_file_height', 'output_file_height', 'trim');
       /*$this->form_validation->set_rules('sizeFIleSVG', 'sizefilesvg', 'trim|required');
       $this->form_validation->set_rules('sizeFilePNG', 'sizefilepng', 'trim|required');*/
       $this->form_validation->set_rules('categoryId', 'categoryid', 'trim|required');
       /*$this->form_validation->set_rules('created_date', 'created date', 'trim|required');
       $this->form_validation->set_rules('created_by', 'created by', 'trim|required');
       $this->form_validation->set_rules('modified_date', 'modified date', 'trim|required');
       $this->form_validation->set_rules('modified_by', 'modified by', 'trim|required');*/

       $this->form_validation->set_rules('sizeId', 'sizeId', 'trim');
       $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
   }

   public function excel()
   {
    $this->load->helper('exportexcel');
    $namaFile = "product_sizes.xls";
    $judul = "product_sizes";
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
    xlsWriteLabel($tablehead, $kolomhead++, "SizeTitle");
    xlsWriteLabel($tablehead, $kolomhead++, "Size");
    xlsWriteLabel($tablehead, $kolomhead++, "SizeFIleSVG");
    xlsWriteLabel($tablehead, $kolomhead++, "SizeFilePNG");
    xlsWriteLabel($tablehead, $kolomhead++, "CategoryId");
    xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
    xlsWriteLabel($tablehead, $kolomhead++, "Created By");
    xlsWriteLabel($tablehead, $kolomhead++, "Modified Date");
    xlsWriteLabel($tablehead, $kolomhead++, "Modified By");

    foreach ($this->Product_sizes_model->get_all() as $data) {
        $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
        xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->sizeTitle);
        xlsWriteLabel($tablebody, $kolombody++, $data->size);
        xlsWriteLabel($tablebody, $kolombody++, $data->sizeFIleSVG);
        xlsWriteLabel($tablebody, $kolombody++, $data->sizeFilePNG);
        xlsWriteNumber($tablebody, $kolombody++, $data->categoryId);
        xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
        xlsWriteNumber($tablebody, $kolombody++, $data->created_by);
        xlsWriteLabel($tablebody, $kolombody++, $data->modified_date);
        xlsWriteNumber($tablebody, $kolombody++, $data->modified_by);

        $tablebody++;
        $nourut++;
    }

    xlsEOF();
    exit();
}

public function word()
{
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=product_sizes.doc");

    $data = array(
        'product_sizes_data' => $this->Product_sizes_model->get_all(),
        'start' => 0
        );

    $this->load->view('product_sizes_doc',$data);
}

}

/* End of file Product_sizes.php */
/* Location: ./application/controllers/Product_sizes.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-09-08 08:52:04 */
/* http://harviacode.com */