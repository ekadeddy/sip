<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class login_google extends CI_Controller {

  public function __construct()
{
	parent::__construct();
	require_once APPPATH.'third_party/src/Google_Client.php';
	require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
        //service calendar
        require_once APPPATH.'third_party/src/contrib/Google_CalendarService.php';
}
	
	public function index()
	{
		$this->load->view('public/login_google_view');
	}
	
	public function google_login()
	{
            //$clientId = '415092827838-9m2n6nanires512uhi6nhocmm9ghs364.apps.googleusercontent.com'; //Google client ID   
            $clientId = '941456297689-qdfat14tjpqr1be3r84ec0op01kfabif.apps.googleusercontent.com'; //Google client ID   
            
            //$clientSecret = '8Ki2R8NqKGe6qLulE1Ns3sHX'; //Google client secret
            $clientSecret = '6s2HJZsbMuZ8RyW7YCAlDqJP'; //Google client secret
            
            $redirectURL = base_url('google/home'); //redirect link

            //Call Google API
            $gClient = new Google_Client();
            $gClient->setApplicationName('Login');
            $gClient->setClientId($clientId);
            $gClient->setClientSecret($clientSecret);
            $gClient->setRedirectUri($redirectURL);
            $google_oauthV2 = new Google_Oauth2Service($gClient);
            //service calendar
//            $googleCal = new Google_CalendarService($gClient);

            if(isset($_GET['code']))
            {
                $gClient->authenticate($_GET['code']);
                $_SESSION['token'] = $gClient->getAccessToken();
                header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
            }

            if (isset($_SESSION['token'])) 
            {
                $gClient->setAccessToken($_SESSION['token']);
                $tokens = $_SESSION['token'];
            }

            if ($gClient->getAccessToken()) {
                $userProfile = $google_oauthV2->userinfo->get();    
                //service calendar
//                $optParams = array(
//                    'maxResults' => 10,
//                    'orderBy' => 'startTime',
//                    'singleEvents' => true,
//                    'timeMin' => date('c'),
//                  );
//                //service calendar
//                $kalender = $googleCal->calendarList->get('primary');
                //$insertKal = $googleCal->calendars->insert();
                
                //cek user login apakah mhs/dsn/adm
                $result = $this->login_mdl->getAkses($userProfile,$tokens);
                
                //tes insert
//                $event = new Google_Event(array(
//            'summary' => 'Google I/O 2018',
//            'location' => '800 Howard St., San Francisco, CA 94103',
//            'description' => 'A chance to hear more about Google\'s developer products.',
//            'start' => array(
//              'dateTime' => '2018-08-15T09:00:00-07:00',
//              'timeZone' => 'Asia/Jakarta',
//            ),
//            'end' => array(
//              'dateTime' => '2018-08-17T09:00:00-07:00',
//              'timeZone' => 'Asia/Jakarta',
//            ),
//            'recurrence' => array(
//              'RRULE:FREQ=DAILY;COUNT=2'
//            ),
//            'attendees' => array(
//              array('email' => 'shelinna15tk@mahasiswa.pcr.ac.id'),
//              array('email' => 'ekadeddy@alumni.pcr.ac.id'),
//            ),
//            'reminders' => array(
//              'useDefault' => FALSE,
//              'overrides' => array(
//                array('method' => 'email', 'minutes' => 24 * 60),
//                array('method' => 'popup', 'minutes' => 10),
//              ),
//            ),
//          ));
//
//        $calendarId = 'pcr.ac.id_lf7v1s4ngrsepmjd7niva64h1s@group.calendar.google.com';
        //$event = $googleCal->events->insert($calendarId, $event);
        //printf('Event created: %s\n', $event->htmlLink);

                //service calendar
                //print_r($kalender); exit;
               
                //set session dari hasil query cek user
                $this->session->set_userdata('logged_in', $result);
                
//              cek user yang login untuk redireck halam mhs/user/adm
                $getdata = $this->session->userdata('logged_in');
                
                $akses = $getdata['user_akses'];
                if($akses == 'mhs'){
                        redirect(base_url('mahasiswa/dashboard'), 'refresh');
                }elseif ($akses == 'adm'){
                        redirect(base_url('admin/dashboard'), 'refresh');
                }elseif ($akses == 'dsn'){
                        redirect(base_url('dosen/dashboard'), 'refresh');
                }
            } 
            else 
            {
                $url = $gClient->createAuthUrl();
                redirect($url, 'refresh');
		//header("Location: $url");
            exit;
            }
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('login','refresh');
	}
}

