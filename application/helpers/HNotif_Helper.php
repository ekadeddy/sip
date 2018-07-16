<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('HNotif_Helper')) 
    {
        function jumlahNotifUnread($email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');

            $notifUnread = $CI->notif_mdl->getJumlahNotifUnread($email);
            return $notifUnread;
        }
        
        function notifUnread($email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');

            $notifUnread = $CI->notif_mdl->getNotifUnread($email);
            return $notifUnread;
        }
        
        
       
    }
