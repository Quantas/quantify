<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Error extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function not_found_404()
    {
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'not_found';
        $vars['title'] = '404 Not Found';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
}