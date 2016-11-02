<?php 
/*
* Controller class for Login
* Author : ManikandaRaja.S
* Date created : 20 August 2016
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Login Page for this controller.
 *
 * Maps to the following URL
 * 		http://example.com/index.php/welcome
 *	- or -
 * 		http://example.com/index.php/welcome/index
 *	- or -
 * Since this controller is set as the default controller in
 * config/routes.php, it's displayed at http://example.com/
 *
 * So any other public methods not prefixed with an underscore will
 * map to /index.php/welcome/<method_name>
 * @see https://codeigniter.com/user_guide/general/urls.html
 */
class Login extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
//     	$this->load->model('Login_Model', 'login');
// 		$this->load->model('acl_model', 'acl');
    }
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/login
	 *	- or -  
	 * 		http://example.com/index.php/login/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
	public function index()
	{

		$this->load->helper(array('form'));
		$this->load->view('login_view');
			
		/*
		if(isset($this->session->userdata('tenantDetails')->tenant_id)) {
             $data['page_title'] = 'Admin Home Page';
             // Get the side menu role rights once logged in 
            $tenant_id = $this->session->userdata('tenantDetails')->tenant_id;
            $user_id   = $this->session->userdata('tenantDetails')->user_id;
            $role_id   = $this->session->userdata('role_id');
            $sideMenu = null;
            if ($role_id != 'ADMN')
            {
             $sideMenu = $this->acl->getAccessRights($tenant_id, $user_id, $role_id); 
            }

            $data['sideMenuData'] = $sideMenu;
            $this->session->set_userdata('sideMenu', $sideMenu);
            
            $data['main_content'] = 'dashboard/AdminHomePage';
            
            $this->load->view('layout', $data);
        } else {
            $data['page_title'] = 'Login page';
            $this->load->view('layout_1', $data);
        }*/
		
 }
	/**
     * Author : Siddhappa
     * This function check weather login account is active along with proper credentials
     */
    public function validate_user() {
        $year = time() + 31536000;
        setcookie('remember_me', $_POST['username'], $year);
        
       $resp = $this->login->check_user_valid();
        if ($resp == 0) {
            $this->session->set_flashdata('invalid', 'Invalid credentials/ User account inactive. Please try again or get in touch with your Administrator.');
            redirect('login/');
        } else {
	    $this->session->set_userdata('tenantDetails', $resp);
            $tenant_id = $this->session->userdata('tenantDetails')->tenant_id;
            $user_id   = $this->session->userdata('tenantDetails')->user_id;
            
            $role_id_val = $this->login->getRoleId($tenant_id ,$user_id);
            //echo "VAL".$role_id_val;
            //exit;
            
            if($role_id_val === 0){
                $this->session->userdata('tenantDetails')->tenant_id = NULL;
                $this->session->set_flashdata('warning', 'You are not authorized to access this Interface. Kindly get in touch with your Administrator.');
                redirect('login/');
            }else{
                $this->session->set_userdata('role_id', $role_id_val);
                redirect('/');
            }
        }
    }

    /**
     * Author : Mani
     * This function does the forgot username / password.
     * Checks to see whether username & password requested by the user.
     */
    public function forgot_settings() {
        extract($_POST);
        $this->load->helper('common');
        
        $forgot_setting = mysql_real_escape_string($forgot_settings);
        $email = mysql_real_escape_string($email);
        $dob = mysql_real_escape_string($dob);
        
        $dob = explode("-", $dob);
        $temp = $dob[0];
        $dob[0] = $dob[2];
        $dob[2] = $temp;
        $dob = implode("-", $dob);

        $resp = $this->login->check_user_credentials($forgot_setting, $email, $dob);        

        if ($resp == 0) {
            $this->session->set_flashdata('invalid', 'Invalid credentials/ User account inactive. Please try again or get in touch with your Administrator.');
            redirect('login/');
        } else {
            $user_name = $resp->user_name;
                        
            if($forgot_setting === 'user_name'){
                $email_content = "Hi $user_name,  <BR> Your UserName is: $user_name";
                $this->generateEmail($email, $email, "Forgetten Username", $email_content, 'Forgotten User Name');
            } else {
                // Get the new random password
                $new_password = generateRandomPassword();
                
                try{
                    // Set the new password with md5 format to the DB 
                    $resp = $this->login->setNewPassword(md5($new_password), $user_name, $dob);
                    $email_content = "Hi $user_name,  <BR> Your New password is: $new_password";
                    
                    if($resp == 1)
                        $this->generateEmail($email, $email, "Password Reset", $email_content, 'Forgotten Password');
                    
                } catch(Exception $e){
                    error_log("Module: Forgot Username and Password. Error: While resetting the new password");
                }
            }
        }
    }
    
    /*
     * Function used to send the email
     * @input: $to, $cc, $subject, $body, $header( Subject Heading)
     * @output: use template the to display the mail confirmaion msg
     * Note: Pls make sure that you are passing respective paramateres.
     */
    private function generateEmail($to='xxxx@xxx.com', $cc='xxxx@xxx.com', $subject='Subject', $body='Body', $header) {
        $data['email'] = array($to, $cc, $subject, $body, $header);
                
        try{
            $this->load->library('email');
            $this->email->initialize();
            
            // From Email Address and Name
            $this->email->from('xxxx@xxx.com', 'Your Name');
            $this->email->to($to); 
            $this->email->cc($cc); 

            $this->email->subject($subject);
            $this->email->message($body);	

            $this->email->send();

            //echo $this->email->print_debugger();
        }
        catch(Exception $e){
            echo('on emailing issue');
            die();
        }
        $this->load->view('common/email_template', $data);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login/');
    }    
}