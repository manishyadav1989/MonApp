<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Analytics_model extends CI_Model {
    /* Login Model */

    function __construct() {
        parent::__construct();
    }

    // Count all record of table "contact_info" in database. appname, userId, appTitle, sum(duration) as duration
    public function getAnalytics( $condition ) {
        $query = $this->db->select(['id', 'appname', 'appTitle', ' sum(duration) as duration', 'count(appname) as appcount'])->where($condition)->group_by(['appname','userId'])->order_by('duration','desc')->get('system_app_log');
        return $query->result();
    }
}

?>