<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TestingUnit extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Calculation');
		$this->load->library('unit_test');
	}
	public function index()
	{	
		echo "Testing module";
		$test=$this->Calculation->calculator("I","I","+");
		$expectted_result="II";
		$test_name="Add ";
		echo $this->unit->run($test,$expectted_result,$test_name);

		$test=$this->Calculation->calculator("II","I","-");
		$expectted_result="I";
		$test_name="Substruct ";
		echo $this->unit->run($test,$expectted_result,$test_name);

		$test=$this->Calculation->calculator("II","I","-");
		$expectted_result="II";
		$test_name="Substruct ";
		echo $this->unit->run($test,$expectted_result,$test_name);
	}
}
