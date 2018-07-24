<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('HNotif_Helper')) 
    {
        //for admin
        function getTotNotifReq($email,$akses)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            
            $where = array ('jdg.STATUS' => 'REQ');
            $notifUnread = $CI->notif_mdl->geTotNotifReq($where,$email);
            return $notifUnread;
        }
        function getListNotifReq($email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');

            $notifUnread = $CI->notif_mdl->getNotifReq($email);
            return $notifUnread;
        }
        function jumlahNotifUnread($email,$akses)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            
            if($akses == 'Dosen')
            {
                $where = "WHERE dsn.EMAIL ='$email'";
                $where_notif = "where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='DSN'";
            }
            //print($akses); exit;
            
            $notifUnread = $CI->notif_mdl->getJumlahNotifUnread($where,$where_notif);
            return $notifUnread;
        }
        
        function notifUnread($email,$akses)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            if($akses == 'Mahasiswa')
            {
                $where = "WHERE mhs.EMAIL ='$email'";
                $where_notif = "where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='MHS'";
            }
            elseif($akses == 'Dosen')
            {
                $where = "WHERE dsn.EMAIL ='$email'";
                $where_notif = "where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='DSN'";
            }
            //print("<script>alert('$akses');</script>"); exit;    
            $notifUnread = $CI->notif_mdl->getNotifUnread($where,$where_notif);
            return $notifUnread;
        }
        
        function notifMhsUnread($email,$akses)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            if($akses == 'Mahasiswa')
            {
                $where_status = array('jdg.STATUS' => 'APV');
                $where_user = array('mhs.EMAIL' => $email);
            }
            elseif($akses == 'Dosen')
            {
                $where = "WHERE dsn.EMAIL ='$email'";
                $where_notif = "where jdn.EMAIL = '$email' and jdn.NOTIF_TIPE ='DSN'";
            }
            //print("<script>alert('$akses');</script>"); exit;    
            $notifUnread = $CI->notif_mdl->getNotifMhsUnread($email);
            return $notifUnread;
        }
        function totNotifMhsUnread($email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            //print("<script>alert('$akses');</script>"); exit;    
            $notifUnread = $CI->notif_mdl->getTotNotifMhsUnread($email);
            return $notifUnread;
        }
        function readNotif($email,$jadwal_ganti_id,$notif_tipe)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            
            $lastID = $CI->notif_mdl->getLastIdNotif();
            
            if($lastID == '')
            {
                $lastID = 'N000000001';
            }
            else
            {
                $lastID++;
            }
            
            $data_notif = array('JADWAL_NOTIF_ID' => $lastID,
                'JADWAL_GANTI_ID' => $jadwal_ganti_id,
                'EMAIL' => $email,
                'READ_STATUS' => '1',
                'NOTIF_TIPE' => $notif_tipe,
                'DTMUPD' => date('Y-m-d H:i:s'));
//            /print($notif_tipe); exit;
            $where = array (
                'JADWAL_GANTI_ID' => $jadwal_ganti_id,
                'EMAIL' => $email
                );
            $CI->notif_mdl->readNotif($data_notif,$where);
        }
        
        function setTipeNotif($userAkses)
        {
            if ($userAkses == 'Admin')
		{
			return 'ADM';
		}
		else if ($userAkses == 'Mahasiswa')
		{
			return 'MHS';
		}
		else
		{
			return 'DSN';
		}
        }
        //Read Status
        
        function readStatus($jadwal_ganti_id,$email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            
            $status = $CI->notif_mdl->readStatus($jadwal_ganti_id,$email);
            return $status;
        }
        //end read status
        
        //DOSEN list
        function notifDsnUnreadApvRjc($email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            
            $notifUnread = $CI->notif_mdl->getNotifDsnApvRjc($email);
            return $notifUnread;
        }
        //total
        function totNotifDsnUnreadApvRjc($email)
        {
            $CI = get_instance();
            $CI->load->model('notif_mdl');
            
            $notifUnread = $CI->notif_mdl->getTotNtfDsnApvRjc($email);
            return $notifUnread;
        }
        //end notif dosen
        
        
        function getStatusPergantianJadwal($stat,$rjc_by,$aprv_by,$tgl_act)
        {
            if($stat=='REQ')
            {
                return '<p class="lead text-green text-bold">REQUEST</p>';
            }
            elseif($stat == 'APV')
            {
                 return '<p class="lead text-green text-bold">APPROV</p>'
                . 'By<br>'
                . '<b>'.$aprv_by.'</b><br>'
                . 'at<br>'
                . '<b>'.ucfirst(HgetStringHari(date('D', strtotime($tgl_act)))).', '.date('d-m-Y', strtotime($tgl_act)).'</b>';
            }
            elseif($stat == 'RJC')
            {
                
                return '<p class="lead text-danger text-bold">REJECTED</p>'
                . 'By<br>'
                . '<b>'.$rjc_by.'</b><br>'
                . 'at<br>'
                . '<b>'.ucfirst(HgetStringHari(date('D', strtotime($tgl_act)))).', '.date('d-m-Y', strtotime($tgl_act)).'</b>';
                
            }
        }
        
        
       
    }

    ?>