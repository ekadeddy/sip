<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sync_google_calendar
 *
 * @author eka.ds
 */
class sync_google_calendar {
    public function __construct()
	{
            $this->CI =& get_instance();
            //service calendar
            require_once APPPATH.'third_party/src/Google_Client.php';
            require_once APPPATH.'third_party/src/contrib/Google_CalendarService.php';
            date_default_timezone_set('Asia/Jakarta');
            
	}
        
        //synch kalendar JADWAL
        public function sync_i_c_jd($event)
        {
            $gClient = new Google_Client();
            $gClient->setAccessToken($_SESSION['token']);
            $googleCal = new Google_CalendarService($gClient);
            
            $event_save = new Google_Event($event);
            $calendarId = 'pcr.ac.id_h2dcflu336s8ichefm2v9ouku0@group.calendar.google.com';
            
            $googleCal->events->insert($calendarId, $event_save);
            
        }
        
        //synch kalendar JADWAL GANTI
        public function sync_i_c_jd_ganti($event)
        {
            $gClient = new Google_Client();
            $gClient->setAccessToken($_SESSION['token']);
            $googleCal = new Google_CalendarService($gClient);
            
            $event_save = new Google_Event($event);
            $calendarId = 'pcr.ac.id_ee3fgm2o45af8ic2qseobu3ea0@group.calendar.google.com';
            
            $googleCal->events->insert($calendarId, $event_save);
            
        }
        
        
        
}
