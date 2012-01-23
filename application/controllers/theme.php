<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Quantify\Config;

/**
 * Description of theme
 *
 * @author Quantas
 */
class Theme extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
    }
    
    public function view()
    {
        $vars['dbconfigs'] = getConfigArray();
        $style = $vars['dbconfigs']['Style'];
        
        $file = 'assets/styles/' . $style . '.css';

        $content = htmlspecialchars(read_file($file), ENT_QUOTES);
        
        $vars['content'] = $content;
        $vars['sidebar_view'] = 'admin';
        $vars['content_view'] = 'edit_style';
        $vars['title'] = 'Edit Style';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    public function edit()
    {
        $newstyle = stripslashes($this->input->post('newtheme'));
        $vars['dbconfigs'] = getConfigArray();
        $style = $vars['dbconfigs']['Style'];
        $file = 'assets/styles/' . $style . '.css';
        
        if ( ! write_file($file, $newstyle))
        {
             echo 'Unable to write the file';
        }
        else
        {
             echo 'File written!';
        }
        
        redirect('admin/config');
        
    }
}