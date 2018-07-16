<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('HHari_Helper')) 
    {
        function HgetHari()
        {
            $hari = array(
                '0','senin','selasa','rabu','kamis','jumat'
            );
            return $hari;
        }
        function HgetHariKuliah()
        {
            $hari = array('0' => '-- Pilih Jam --',
                'senin' => 'SENIN',
                'selasa' => 'SELASA',
                'rabu' => 'RABU',
                'kamis' => 'KAMIS',
                'jumat' => 'JUMAT'
            );
            return $hari;
        }
         function HgetKet($jam)
        {
             
        $ci =& get_instance();
        $query = $ci->db->select('KET')
                ->where('JAM_KULIAH_ID',$jam)
                ->get('tb_jam_kuliah');
        
        foreach ($query->result() as $a)
            {
                return $a->KET;        
            }
        
        
        }
        function HgetStringHari($date)
        {
            
            $day = date('D', strtotime($date));
            if($day == 'Mon')
            {
                return 'senin';
            }
            elseif($day == 'Tue')
            {
                return 'selasa';
            }
            elseif($day == 'Wed')
            {
                return 'rabu';
            }
            elseif($day == 'Thu')
            {
                return 'kamis';
            }
            elseif($day == 'Fri')
            {
                return 'jumat';
            }
            elseif($day == 'Sat')
            {
                return 'sabtu';
            }
            elseif($day == 'Sun')
            {
                return 'minggu';
            }
        }
        function HgetStatusTanggal($date)
        {
            //$dt = date("Y-m-d");
            //echo date( "Y-m-d", strtotime( "$dt +1 day" ) );
            $dateNows = date('Y-m-d');
            $dateNow = date("Y-m-d", strtotime( "$dateNows +3 day" ) );
            $dateChange =  nice_date($date, 'Y-m-d');
            
            if($dateChange <= $dateNow)
            {
                return false;
            }
            else
            {
                return true;  
            }
            
        }
        function HgetHariIni()
        {
             $day = date('D');
            if($day == 'Mon')
            {
                return 'senin';
            }
            elseif($day == 'Tue')
            {
                return 'selasa';
            }
            elseif($day == 'Wed')
            {
                return 'rabu';
            }
            elseif($day == 'Thu')
            {
                return 'kamis';
            }
            elseif($day == 'Fri')
            {
                return 'jumat';
            }
            elseif($day == 'Sat')
            {
                return 'sabtu';
            }
            elseif($day == 'Sun')
            {
                return 'minggu';
            }
        }
        
       
    }
