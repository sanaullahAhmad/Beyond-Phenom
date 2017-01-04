<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_categories_model extends CI_Model
{

    public $table = 'product_categories';
    public $id = 'categoryId';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('categoryId', $q);
	$this->db->or_like('categoryTitle', $q);
        $this->db->or_like('categoryBase', $q);
        $this->db->or_like('categoryMiddle', $q);
        $this->db->or_like('categoryTop', $q);
	$this->db->or_like('categoryObjFile', $q);
	$this->db->or_like('categoryMTLFile', $q);
	$this->db->or_like('categoryModelPatternFile', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modified_date', $q);
	$this->db->or_like('modified_by', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('categoryId', $q);
	$this->db->or_like('categoryTitle', $q);
        $this->db->or_like('categoryBase', $q);
        $this->db->or_like('categoryMiddle', $q);
        $this->db->or_like('categoryTop', $q);
	$this->db->or_like('categoryObjFile', $q);
	$this->db->or_like('categoryMTLFile', $q);
	$this->db->or_like('categoryModelPatternFile', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modified_date', $q);
	$this->db->or_like('modified_by', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Product_categories_model.php */
/* Location: ./application/models/Product_categories_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-09-08 08:42:10 */
/* http://harviacode.com */