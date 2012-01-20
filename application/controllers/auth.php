<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of auth
 *
 * @author Quantas
 */
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        getConfigArray();
    }
    
    public function login()
    {
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'login_form';
        $vars['title'] = 'Login';
        $this->load->view(get_dbconfig('style'),$vars);
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    
    public function submit() 
    {
        if ($this->_submit_validate() === FALSE)
        {
            $this->login();
            return;
        }
        // user has been logged in
        $this->session->set_userdata('logged_in', TRUE);
        redirect($this->session->userdata('redirect_url'));
    }

    private function _submit_validate() 
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_authenticate');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $this->form_validation->set_message('authenticate','Invalid login. Please try again.');

        return $this->form_validation->run();
    }

    public function authenticate() 
    {
        return models\Quantify\Current_User::login($this->input->post('username'), $this->input->post('password'));
    }
}