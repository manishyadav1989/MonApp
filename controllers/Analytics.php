<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Analytics extends CI_Controller {

	private $data = array();
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->model('login_model');
        $this->load->model('custom_model');
        $this->load->model('analytics_model');

		//is_logged_in();
		define('CONTROLLER', strtolower(__CLASS__));
    }

	public function index(){
		$this->getFiltersData();

		$this->load->view('analytics', $this->data );
	}

	// get data filters
	public function getFiltersData(){

		$url = base_url().'index.php/analytics?';
		$this->data['userUrl'] = $url;
		$this->data['comUrl'] = $url;
		$this->data['users'] = $this->custom_model->getAllUsers();
		$this->data['comps'] = $this->custom_model->getComName();

	}

	// get users application log
	public function getUserApplogs(){

		$records = $this->analytics_model->getAnalytics( ['1'=>'1'] );
		$totalCounts = 0;
		if( count($records) > 0 ){
			foreach ($records as $key => $value) {
				$totalCounts += $value->appcount;
			}
		}
		
		return array('records'=>$records, 'app_counts'=> $totalCounts );
	}

	// app black list
	public function appBlackList(){
		return $blacklist = ['FAHWindow64.exe', '296', 'igfxtray.exe', 'SynTPEnh.exe', 'msseces.exe', 'tv_w32.exe', 'tv_x64.exe', 'QLBCTRL.exe', 'VolCtrl.exe', 'hkcmd.exe', 'winlogon.exe', 'explorer.exe', 'nircmd.exe', 'taskhost.exe', 'tasklist.exe', 'conhost.exe', 'msiexec.exe', 'powershell.exe', 'csrss.exe', 'BingSvc.exe', 'igfxpers.exe'];
	}

	// 
	public function applicationData(){
		$record = $this->getUserApplogs(); // get app logs records
		$this->getFiltersData(); // get filters list

		$this->data['appsLog'] = $record['records'];
		$this->data['app_counts'] = $record['app_counts'];
		$this->load->view('application-analytics', $this->data);
	}
}