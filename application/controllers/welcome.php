<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller 
{

    public function index()
    {
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'home';
        $vars['title'] = 'Home';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
}
