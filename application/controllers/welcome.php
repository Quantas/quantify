<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{

    public function index()
    {
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'home';
        $vars['title'] = 'Home';
        $this->load->view(get_dbconfig('style'),$vars);
    }
}
