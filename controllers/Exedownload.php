<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exedownload extends CI_Controller {
/* Login Controller*/
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->model('exedownload_model');
		is_logged_in();
    }

    public function exedownload_frm() {
        /* Login View */
        $data['menu'] = $this->load->view('monitoringHeader', NULL, TRUE);
        $this->load->view('dashboard/newExedownload', $data);
		$this->load->view('footer');
    }
	public function addexedownloadUser() { 
	$result = $this->exedownload_model->addexedownloadUser();
        if ($result > 0) {
            $this->session->set_flashdata('success', 'Your Record is Added Successfully.');
            redirect('ecase/exedownload_frm');
        } else {
            $this->session->set_flashdata('error', 'Your Record is Not Added.');
            redirect('ecase/exedownload_frm');
            exit();
        }
	}
	public function download_exe() {
		$result =$this->exedownload_model->addexedownloadUser();
		//$data = file_get_contents(base_url(). "uploads/photo.jpg"); // Read the file's contents
		$data = file_get_contents(base_url(). "uploads/ems.exe"); 

		//$name = 'myphoto.jpg';
		$name = 'ems.exe';
		force_download($name, $data);
		
	}

}

?>