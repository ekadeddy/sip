<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of generate_event_id
 *
 * @author eka.ds
 */
class generate_event_id {
    
    public function get_new_event_id($modul)
    {
        $CI = get_instance();
        $CI->load->model('seq_mdl'); 

        $last_seq_no = $CI->seq_mdl->getSeqNo($modul);	
        
        if($modul=='JD')
        {
            $last_event_id = 'sip'.date('Ymd').'pcrjd'.$last_seq_no;
        }
        elseif($modul =='JDG')
        {
            $last_event_id = 'sip'.date('Ymd').'pcrjdg'.$last_seq_no;
        }
        
        //udpate last seq for next seq
        $data= array('SEQ_NO' => $last_seq_no+1);
        $CI->seq_mdl->udateSeqNo($modul,$data);
        
        return $last_event_id;
    }
}
