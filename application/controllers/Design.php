<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
        $protocol = explode('/',$_SERVER['SERVER_PROTOCOL']);
        $this->url = urlencode($protocol[0]."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		$this->load->helper('session_array_helper');
        $this->load->model('Product_categories_model');
        $this->categories = $this->Product_categories_model->get_all();
        //echo "<pre>";print_r($categories);exit;
		$this->allProd = array(
				0 => 
						['product_name'=>'athlete-shorts', 'base_svg'=>'Base-v2', 'middle_svg'=>'Design-v2', 'top_svg'=>'Logo-v2', 
						 'model_obj'=>'Athletic_Shorts', 'model_mtl' =>'Athletic_Shorts', 'generate_file_name'=>'Shorts.jpg'],
				1 => 
						['product_name'=>'female-tights','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleTightsc4D1', 'model_mtl' =>'FemaleTightsc4D1', 'generate_file_name'=>'FemaleTights.jpg'], 
				2 => 	
						['product_name'=>'female-tank','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemapleTankC4D1', 'model_mtl' =>'FemapleTankC4D1', 'generate_file_name'=>'FemaleTank.jpg'], 
				3 => 
						['product_name'=>'sports-bra','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'SportsBraC4D', 'model_mtl' =>'SportsBraC4D', 'generate_file_name'=>'SportsBraMAT.jpg'], 
				4 => 
						['product_name'=>'female-short-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleShortSleevesC4DA', 'model_mtl' =>'FemaleShortSleevesC4DA', 'generate_file_name'=>'FSS.jpg'], 
				5 => 
						['product_name'=>'female-long-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleLongSleevesC4D1', 'model_mtl' =>'FemaleLongSleevesC4D1', 'generate_file_name'=>'FLS1.jpg'], 
				6 => 
						['product_name'=>'female-mid-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'FemaleMidSleevesC4DA', 'model_mtl' =>'FemaleMidSleevesC4DA', 'generate_file_name'=>'FMS.jpg'], 

				7 => 
						['product_name'=>'male-tights','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleTightsC4D1', 'model_mtl' =>'MaleTightsC4D1', 'generate_file_name'=>'MaleTights.jpg'], 
				8 => 
						['product_name'=>'male-sleeveless','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleSleevelessC4D', 'model_mtl' =>'MaleSleevelessC4D', 'generate_file_name'=>'MaleSleeveless.jpg'], 
				9 => 
						['product_name'=>'male-mid-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleMidSleevesC4D', 'model_mtl' =>'MaleMidSleevesC4D', 'generate_file_name'=>'MalemidSleeve.jpg'], 
				10 => 
						['product_name'=>'male-short-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleShortSleevesC4D', 'model_mtl' =>'MaleShortSleevesC4D', 'generate_file_name'=>'MaleShortSleeve.jpg'], 
				11 => 
						['product_name'=>'male-long-sleeves','base_svg'=>'Base', 'middle_svg'=>'Design', 'top_svg'=>'Logo', 
						 'model_obj'=>'MaleLongSleevesC4D', 'model_mtl' =>'MaleLongSleevesC4D', 'generate_file_name'=>'MaleLongSleeves.jpg'], 
				 );
	}
	public function index($product=null)
	{
        $this->load->model('Product_categories_model');
        $categories             = $this->Product_categories_model->get_all();
        $url_slashes ='../';
        if(!$product)
        {
            $product=$categories{0}->categoryId;
            $url_slashes ='';
            //echo $product;exit;
        }

        $this->load->model('Product_sizes_model');
        $this->load->model('Patterns_model');
        $product_sizes    = $this->Product_sizes_model->get_limit_data(100, 0, '', $product);
        $patterns         = $this->Patterns_model->get_all();

        $data['indexx']         = $product;
        $data['url_slashes']    = $url_slashes;
        $data['categories']     = $categories;
        $data['patterns']     = $patterns;
        $data['product_sizes']  = $product_sizes;
		$this->load->view('frontend/landing_page', $data);
	}
    public function cart()
    {
        $this->load->model('Product_sizes_model');
        $data = array();
        if($this->session->userdata('userId'))
        {
            $this->load->model('Users_model');
            $wp_user = $this->Users_model->get_wp_users($this->session->userdata('userId'));
            $wp_usermeta = $this->Users_model->get_wp_usermeta($this->session->userdata('userId'));
            foreach($wp_usermeta as $value)
            {
                $wp_user[0][$value['meta_key']]=$value['meta_value'];
            }
            //$user_info = array_merge($wp_user,$wp_usermeta);
            //echo "<pre>";print_r($wp_user);
            $data['user_info'] = $wp_user;
        }

        $this->load->view('frontend/cart', $data);
    }
    public function order($order_id)
    {
        $this->load->model('User_orders_model');
        $this->load->model('Product_sizes_model');
        $order_details         = $this->User_orders_model->get_by_id($order_id);
        $data['order_details'] = $order_details;

        $this->db->where('orderId', $order_id);
        $row        = $this->db->get('order_product');
        $order_info = $row->result();
        $data['order_info'] = $order_info;

        $this->load->view('frontend/order', $data);
    }
    public function download($order_id)
    {
        if($this->session->userdata('manufacturerId')==""){
            redirect(base_url()."?next=".$this->url);
        }
        $this->load->model('User_orders_model');
        $this->load->model('Product_sizes_model');
        $this->load->model('product_size_pattern_layers_model');
        
        $order_details         = $this->User_orders_model->get_by_id($order_id);
        $data['order_details'] = $order_details;

        $this->db->where('orderId', $order_id);
        $row        = $this->db->get('order_product');
        $order_infos = $row->result();
        //print_r($order_info);exit;
        $data['order_infos'] = $order_infos;
        $data['print_layers'] = $this->product_size_pattern_layers_model->get_by_size_id($order_infos[0]->productId);

        $this->load->view('frontend/download', $data);
    }
    public function check_out()
    {
        //echo dirname(__FILE__);exit;
        //echo '<pre>';print_r($this->session->userdata('cart'));exit;
        if(isset($_POST['order'])) {
            if(!$this->session->userdata('is_user_logged_id'))
            {
                redirect(site_url('login?redirect=cart'));
            }
            if ($this->session->userdata('cart') && $this->session->userdata('cart') != "") {
                //echo'<pre>';print_r($this->session->userdata('cart'));exit;
                $grant_total = 0;
                $order_pro_ids = array(0);
                $count =0;
                foreach ($this->session->userdata('cart') as $key => $val) {
                    $session_user = $val['session_user'];

                    $sizidmarkup ='0';
                    $sizqtymarkup ='0';
                    $cur_tot=0;
                    foreach ($val['size_qty'] as $sizeid => $sizeqty)
                    {
                        $cur_tot += $val['price'] * $sizeqty;
                        $grant_total += $val['price'] * $sizeqty;
                        $sizidmarkup .=','.$sizeid;
                        $sizqtymarkup .=','.$sizeqty;
                    }

                    $data[$count] = array(
                        'productId'          =>  $key,
                        'name'               =>  $val['product_name'],
                        'sizes'              =>  $sizidmarkup,
                        'quantities'         =>  $sizqtymarkup,
                        'base_svg'           =>  $val['base_svg'],
                        'price'              =>  $val['price'],
                        'middle_svg'         =>  $val['middle_svg'],
                        'top_svg'            =>  $val['top_svg'],
                        'model_obj'          =>  $val['model_obj'],
                        'model_mtl'          =>  $val['model_mtl'],
                        'generate_file_name' =>  $val['generate_file_name'],
                        'session_user'       =>  $val['session_user'],
                        'imgoffsety'         =>  $val['imgoffsety'],
                        'imgoffsetx'         =>  $val['imgoffsetx'],
                        'imgangle'           =>  $val['imgangle'],
                        'myRange'            =>  $val['myRange'],
                        'imgrepeat'          =>  $val['imgrepeat'],
                        'patterenused'       =>  $val['patterenused'],

                        'imgoffsety_design'         =>  $val['imgoffsety_design'],
                        'imgoffsetx_design'         =>  $val['imgoffsetx_design'],
                        'imgangle_design'           =>  $val['imgangle_design'],
                        'myRange_design'            =>  $val['myRange_design'],
                        'imgrepeat_design'          =>  $val['imgrepeat_design'],
                        'patterenused_design'       =>  $val['patterenused_design'],

                        'base_color'         =>  $val['base_color'],
                        'middle_color'       =>  $val['middle_color'],
                        'top_color'          =>  $val['top_color'],
                        'total'              =>  $cur_tot,
                    );

                    $count++;
                }

                $order=new stdClass();
                $order->billing_first_name  =$_POST['billing_first_name'];
                $order->billing_last_name   =$_POST['billing_last_name'];
                $order->billing_company     =$_POST['billing_company'];
                $order->billing_address_1   =$_POST['billing_address_1'];
                $order->billing_address_2   =$_POST['billing_address_2'];
                $order->billing_city        =$_POST['billing_city'];
                $order->billing_postcode    =$_POST['billing_postcode'];
                $order->billing_country     =$_POST['billing_country'];
                $order->billing_state       =$_POST['billing_state'];
                $order->billing_email       =$_POST['billing_email'];
                $order->billing_phone       =$_POST['billing_phone'];
                $order->id='22';
                $order->userid              =$this->session->userdata('userId');
                $this->load->library('firstdata');
                $res = $this->firstdata->process_payment($order);
                if($res['result']=='success')
                {
                    //echo "success";
                    foreach ($data as $mydata)
                    {
                        $this->db->insert('order_product', $mydata);
                        array_push($order_pro_ids, $this->db->insert_id());
                    }
                    $data = array(
                        'userId'          =>  $this->session->userdata('userId'),
                        'order_price'     =>  $grant_total,
                        'billing_address' =>  $_POST['billing_address_1'],
                        'delivery_address'=>  $_POST['billing_address_1'],
                        'created_date'    =>  date('Y-m-d H:i:s')
                    );
                    $this->db->insert('user_orders', $data);

                    foreach ($order_pro_ids as $vert) {
                        $data = array('orderId' =>  $this->db->insert_id());
                        $this->db->where('orderId', $vert);
                        $this->db->update('order_product', $data);
                    }
                    $this->session->unset_userdata('cart');
                }
                else{
                    //echo "failure";
                    $this->session->set_flashdata('warning',$res['r_error']);
                    redirect(base_url().'cart');
                }



                // process the payment card
                /*$this->load->library('convergeapi');
                $response = $this->convergeapi->ccauthonly(array(
                    'ssl_amount'            => $grant_total,
                    'ssl_invoice_number'    => 01,
                    'ssl_card_number'       => $_POST['cardNumber'],//5300721113696477,
                    'ssl_cvv2cvc2'          => $_POST['ccvv'],
                    'ssl_exp_date'          => $_POST['expiryDate'],
                    'ssl_first_name'        => $this->session->userdata('username'),
                    'ssl_last_name'         => $this->session->userdata('username')
                ));*/



                //Empty Cart

            }
        }
        $this->load->view('frontend/check_out', $data);
    }
	//add to cart
    function addTocart(){
    	if(isset($_POST['cart'])){
    		$prod=$this->input->post('cart');

            $data_cat = $this->Product_categories_model->get_by_id($prod);
            $product_arr = array('product_name'=>$data_cat->categoryTitle,
                                'price'=>$data_cat->price,
                                'base_svg'=>pathinfo($data_cat->categoryBase, PATHINFO_FILENAME),
                                'middle_svg'=>pathinfo($data_cat->categoryMiddle, PATHINFO_FILENAME),
                                'top_svg'=>pathinfo($data_cat->categoryTop, PATHINFO_FILENAME),
                                'model_obj'=>pathinfo($data_cat->categoryObjFile, PATHINFO_FILENAME),
                                'model_mtl' =>pathinfo($data_cat->categoryMTLFile, PATHINFO_FILENAME),
                                'generate_file_name'=>$this->input->post('generate_file_name'));

    		if(is_numeric($prod)){
    			$curerntQty="";
    			if(!$this->session->userdata('cart')){
    				$activeProd=$product_arr;
    				$activeProd['session_user'] =$this->session->userdata('sid');
                    $activeProd['product_qty']  =1;

                    $activeProd['imgoffsety']   =$this->input->post('imgoffsety');
                    $activeProd['imgoffsetx']   =$this->input->post('imgoffsetx');
                    $activeProd['imgangle']     =$this->input->post('imgangle');
                    $activeProd['myRange']      =$this->input->post('myRange');
                    $activeProd['imgrepeat']    =$this->input->post('imgrepeat');
                    $activeProd['patterenused'] =$this->input->post('patterenused');

                    $activeProd['imgoffsety_design']   =$this->input->post('imgoffsety_design');
                    $activeProd['imgoffsetx_design']   =$this->input->post('imgoffsetx_design');
                    $activeProd['imgangle_design']     =$this->input->post('imgangle_design');
                    $activeProd['myRange_design']      =$this->input->post('myRange_design');
                    $activeProd['imgrepeat_design']    =$this->input->post('imgrepeat_design');
                    $activeProd['patterenused_design'] =$this->input->post('patterenused_design');

                    $activeProd['base_color']   =$this->input->post('base_color');
                    $activeProd['middle_color'] =$this->input->post('middle_color');
                    $activeProd['top_color']    =$this->input->post('top_color');

                    $activeProd['size_qty'] = array();
                    if($_POST['size_qty'])
                    {
                        foreach($_POST['size_qty'] as $item)
                        {
                            foreach ($item as $key=>$value)
                            {
                                $activeProd['size_qty'][$key]=$value;
                            }

                        }
                    }


    				$cartProd[$prod]=$activeProd;
    			}else{
    				if(array_key_exists($prod,$this->session->userdata('cart'))){
    					$oldProd=$this->session->userdata('cart')[$prod];
    				    $oldProd['product_qty']=$oldProd['product_qty']+1;

                        $oldProd['size_qty'] = array();
                        if($_POST['size_qty'])
                        {
                            foreach($_POST['size_qty'] as $item)
                            {
                                foreach ($item as $key=>$value)
                                {
                                    $oldProd['size_qty'][$key]=$value;
                                }
                            }
                        }

    				    if($oldProd['session_user']!=$this->session->userdata('sid')){
    				    	$this->session->unset_userdata('cart');
    				    	$cartProd="";
    				    }else{
    				    	$cartProd[$prod]=$oldProd;
    				    }
    				}else{
    				$activeProd=$product_arr;
    				$activeProd['session_user'] =$this->session->userdata('sid');
    				$activeProd['product_qty']  =1;

                    $activeProd['imgoffsety']   =$this->input->post('imgoffsety');
                    $activeProd['imgoffsetx']   =$this->input->post('imgoffsetx');
                    $activeProd['imgangle']     =$this->input->post('imgangle');
                    $activeProd['myRange']      =$this->input->post('myRange');
                    $activeProd['imgrepeat']    =$this->input->post('imgrepeat');
                    $activeProd['patterenused'] =$this->input->post('patterenused');

                    $activeProd['imgoffsety_design']   =$this->input->post('imgoffsety_design');
                    $activeProd['imgoffsetx_design']   =$this->input->post('imgoffsetx_design');
                    $activeProd['imgangle_design']     =$this->input->post('imgangle_design');
                    $activeProd['myRange_design']      =$this->input->post('myRange_design');
                    $activeProd['imgrepeat_design']    =$this->input->post('imgrepeat_design');
                    $activeProd['patterenused_design'] =$this->input->post('patterenused_design');

                    $activeProd['base_color']   =$this->input->post('base_color');
                    $activeProd['middle_color'] =$this->input->post('middle_color');
                    $activeProd['top_color']    =$this->input->post('top_color');

                        $activeProd['size_qty'] = array();
                        if($_POST['size_qty'])
                        {
                            foreach($_POST['size_qty'] as $item)
                            {
                                foreach ($item as $key=>$value)
                                {
                                    $activeProd['size_qty'][$key]=$value;
                                }
                            }
                        }
    				$cartProd[$prod]=$activeProd;
    				}
    			}
    			if($cartProd!=""){
    				//push to session array
    				push_session_array('cart',$cartProd);
    			}else{
    				echo 'error';
    			}
    			//echo '<pre>';print_r($this->session->userdata('cart'));exit;
    		}
    	}

    }
    function emptyCart(){
    	if(isset($_POST['emptycart'])){
    		$this->session->unset_userdata('cart');
    	}
    }
	function save_image($product=null)
	{
	    //echo "success";
		if(isset($_POST['json']))
		{
			$json = $_POST['json'];
			$this->session->set_userdata('jsn', $this->input->post('jsn'));
			$base64 = htmlspecialchars_decode($json);
			$splited = explode(',', substr( $base64 , 5 ) , 2);
        // print_r($splited); exit;
        // $mime=$splited[0];
			$data=base64_decode($splited[1]);
        // write_file('./public/uploads/templates/'.$output_file_without_extentnion.'_image.json', $splited[1]);
        // echo $data; exit;
        // $mime_split_without_base64=explode(';', $mime,2);
        // $mime_split=explode('/', $mime_split_without_base64[0],2);
        // if(count($mime_split)==2)
        // {
            // $extension=$mime_split[1];
            // if($extension=='jpeg')$extension='jpg';
            // if(file_exists('shorts.jpg')) unlink('shorts.jpg');

            // $output_file_with_extentnion= 'shorts.png';
            // echo 'done';
        // }
        // else echo 'problem with json'; 

			$myfile = fopen("./public/uploads/product_categories/".$this->input->post('product')."/".$this->input->post('file'), "w") or die("Unable to open file!");
			if(fwrite($myfile, $data)) echo 'done';
			else echo 'unable to write';
			fclose($myfile);


        // if(!write_file('./'.$output_file_with_extentnion, $data)) echo "cannot write canvas image";
    	// else echo 'done';
		}else echo 'no post request';

	}
}
