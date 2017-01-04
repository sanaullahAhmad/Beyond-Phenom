<?php 

/*----
This is the authentication controller, 
used to verify login, logout, check login status
----*/

class Manufacturers extends CI_Controller {

    protected $adminid = "userId";
    protected $adminname = "userName";
    protected $adminemail = "userEmail";
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_categories_model');
        $this->load->model('Users_model');
        $this->load->library('form_validation');

        $protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
        $this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        if($this->session->userdata('adminId')==""){
            redirect('myadmin'."?next=".$this->url);
        }
    }
	public function index($message=FALSE)
	{
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/manufacturers/?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/manufacturers/?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/manufacturers/';
            $config['first_url'] = base_url() . 'users/manufacturers/';
        }

        $config['per_page']             = 10;
        $config['page_query_string']    = TRUE;
        $this->load->model('Users_model');
        $manufacturers                  = $this->Users_model->get_limit_data($config['per_page'], $start, $q);
        $config['total_rows']           = count($manufacturers);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'manufacturers' => $manufacturers,
            'q'             => $q,
            'pagination'    => $this->pagination->create_links(),
            'total_rows'    => $config['total_rows'],
            'start'         => $start,
        );
        $data['main'] = 'manufacturers_list';
        $this->load->view('admin/template',$data);
	}

    public function read($id)
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
                'userId'        => $row->userId,
                'username'      => $row->username,
                'userFirstName' => $row->userFirstName,
                'userLastName'  => $row->userLastName,
                'userEmail'     => $row->userEmail,
                'userRegistrationDate' => $row->userRegistrationDate,
                'userDob'       => $row->userDob,
                'userAddress'   => $row->userAddress,
            );
            // $this->load->view('product_categories_read', $data);


            $data['main'] = 'manufacturers_read';
            $this->load->view('admin/template',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('manufacturers'));
        }
    }

    public function create()
    {
        $data = array(
            'button'                => 'Create',
            'action'                => site_url('manufacturers/create_action'),
            'userId'                => set_value('userId'),
            'username'              => set_value('username'),
            'userPassword'          => set_value('userPassword'),
            'userFirstName'         => set_value('userFirstName'),
            'userLastName'          => set_value('userLastName'),
            'userEmail'             => set_value('userEmail'),
            'userDob'               => set_value('userDob'),
            'userAddress'           => set_value('userAddress'),
        );
        //echo "<pre>";print_r($data);exit;
        // $this->load->view('product_categories_form', $data);
        $data['main'] = 'manufacturers_form';
        $this->load->view('admin/template',$data);
    }

    public function create_action()
    {
        $this->_rules();
        $files = array();
        $errors = array();
        $data = array();

        $data['username']               = $this->input->post('username',TRUE);
        $data['userPassword']           = $this->input->post('userPassword',TRUE);
        $data['userFirstName']          = $this->input->post('userFirstName',TRUE);
        $data['userLastName']           = $this->input->post('userLastName',TRUE);
        $data['userEmail']              = $this->input->post('userEmail',TRUE);
        $data['userDob']                = $this->input->post('userDob',TRUE);
        $data['userAddress']            = $this->input->post('userAddress',TRUE);
        $data['userType']               = 1;
        $data['userStatus']             = 1;
        $data['userRegistrationDate']   = date('Y-m-d H:i:s');

        if(count($errors)==0){
            $this->session->set_flashdata('message', $data);
            $this->Users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('manufacturers'));
        }
        else
        {
            $this->session->set_flashdata('message', $errors[0]);
            redirect(site_url('manufacturers'));
        }
    }

    public function update($id)
    {
        $row = $this->Users_model->get_by_id($id);

            if ($row) {
            $data = array(
                'button'                => 'Update',
                'action'                => site_url('manufacturers/update_action'),
                'userId'                => set_value('userId', $row->userId),
                'username'              => set_value('username', $row->username),
                'userPassword'          => set_value('userPassword'),//, $row->userPassword
                'userFirstName'         => set_value('userFirstName', $row->userFirstName),
                'userLastName'          => set_value('userLastName', $row->userLastName),
                'userEmail'             => set_value('userEmail', $row->userEmail),
                'userDob'               => set_value('userDob', $row->userDob),
                'userAddress'           => set_value('userAddress', $row->userAddress),
            );
            //echo "<pre>";print_r($data);exit;
            // $this->load->view('product_categories_form', $data);
            $data['main'] = 'manufacturers_form';
                $this->load->view('admin/template',$data);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('manufacturers'));
        }
    }

    public function update_action()
    {
        /*$this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('userId', TRUE));
        }
        else
        {*/
            $data = array();

            $data['username']               = $this->input->post('username',TRUE);
            if(isset($_POST['userPassword']) && $_POST['userPassword']!='')
            {
                $data['userPassword']           = md5($this->input->post('userPassword',TRUE));
            }

            $data['userFirstName']          = $this->input->post('userFirstName',TRUE);
            $data['userLastName']           = $this->input->post('userLastName',TRUE);
            $data['userEmail']              = $this->input->post('userEmail',TRUE);
            $data['userDob']                = $this->input->post('userDob',TRUE);
            $data['userAddress']            = $this->input->post('userAddress',TRUE);

            $this->Users_model->update($this->input->post('userId', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('manufacturers'));
        /*}*/
    }

    public function delete($id)
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('manufacturers'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('manufacturers'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('categoryTitle', 'categorytitle', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        /*$this->form_validation->set_rules('categoryThumbnail', 'categorythumbnail', 'trim');
        $this->form_validation->set_rules('categoryObjFile', 'categoryobjfile', 'trim');
        $this->form_validation->set_rules('categoryMTLFile', 'categorymtlfile', 'trim');
        $this->form_validation->set_rules('categoryModelPatternFile', 'categorymodelpatternfile', 'trim');*/
        // $this->form_validation->set_rules('modified_date', 'modified date', 'trim|required');
        // $this->form_validation->set_rules('modified_by', 'modified by', 'trim|required');

        $this->form_validation->set_rules('categoryId', 'categoryId', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "product_categories.xls";
        $judul = "product_categories";
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
        xlsWriteLabel($tablehead, $kolomhead++, "CategoryTitle");
        xlsWriteLabel($tablehead, $kolomhead++, "categoryBase");
        xlsWriteLabel($tablehead, $kolomhead++, "categoryMiddle");
        xlsWriteLabel($tablehead, $kolomhead++, "categoryTop");
        xlsWriteLabel($tablehead, $kolomhead++, "CategoryObjFile");
        xlsWriteLabel($tablehead, $kolomhead++, "CategoryMTLFile");
        xlsWriteLabel($tablehead, $kolomhead++, "CategoryModelPatternFile");
        xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
        xlsWriteLabel($tablehead, $kolomhead++, "Created By");
        xlsWriteLabel($tablehead, $kolomhead++, "Modified Date");
        xlsWriteLabel($tablehead, $kolomhead++, "Modified By");

        foreach ($this->Product_categories_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryTitle);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryBase);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryMiddle);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryTop);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryObjFile);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryMTLFile);
            xlsWriteLabel($tablebody, $kolombody++, $data->categoryModelPatternFile);
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
        header("Content-Disposition: attachment;Filename=product_categories.doc");

        $data = array(
            'product_categories_data' => $this->Product_categories_model->get_all(),
            'start' => 0
        );

        $this->load->view('product_categories_doc',$data);
    }


	
	
   
    
    
}
