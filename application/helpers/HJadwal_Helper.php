<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('HJadwal_Helper')) 
    {
        function HGetRedirectJadwal($modul,$param)
        {
            if ($modul == 'SAVEJADWAL')
            {
                redirect('admin/manage-jadwal/'.$param, 'refresh');
            }
            elseif ($modul == 'SAVEJADWALGANTI')
            {
                redirect('dosen/jadwal-ubah', 'refresh');
            }
            elseif ($modul == 'APPROVALSAVE')
            {
                redirect('admin/approval', 'refresh');
            }
            elseif($modul == 'SAVEEDITJADWAL')
            {
                redirect('admin/manage/jadwal/edit', 'refresh');
            }
            elseif($modul == 'READNOTIF')
            {
                redirect('admin/manage/jadwal/edit', 'refresh');
            }
            
                
        }

        function HJadwalHarianDosen($hari,$dosen,$jam)
        {
         $CI = get_instance();

    // You may need to load the model if it hasn't been pre-loaded
        $CI->load->model('jadwal_mdl');

        $harian = $this->jadwal_mdl->getJadwalHarianDosen($hari,$dosen,$jam);

        print($harian);
        exit;
        return $harian;
        }
    }
