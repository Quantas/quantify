<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Quantify\Config;

/**
 * Description of admin
 *
 * @author Quantas
 */
class Admin extends MY_Controller 
{
    public $title;
    
    function __construct()
    {
        parent::__construct();
        $this->title = anchor('admin/', 'Administration');
    }
    
    function index()
    {
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'admin';
        $vars['title'] = $this->title;
        $this->load->view('template',$vars);
    }
    
    /**
     * Display the configs
     */
    function config()
    {
        $em = $this->doctrine->em;
        
        $configs = $em->getRepository('models\Quantify\Config')->findAll();

        $tzlist = DateTimeZone::listIdentifiers();
        
        
        $styles = array();
        $styleDir = opendir('assets/styles');
        while ($file = readdir($styleDir)) 
        {
            if (preg_match("/\.css$/i",$file))
            {
                array_push($styles, $file);
            }
        }
        
        $vars['styles'] = $styles;
        $vars['configs'] = $configs;
        $vars['tzlist'] = $tzlist;
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'config';
        $vars['title'] = $this->title . ' > Config';
        $this->load->view('template',$vars);
    }
    
    /**
     * Add a new config to the DB
     */
    function addConfig()
    {
        $em = $this->doctrine->em;
        
        $config = new Config;
        $config->setConfigKey($this->input->post('key'));
        $config->setConfigValue($this->input->post('value'));
        $em->persist($config);
        $em->flush();
        
        redirect('admin/config');
    }
    
    /**
     * Update the configs in the DB
     */
    function editConfigs()
    {
        $em = $this->doctrine->em;
        
        //Get Configs from DB
        $configs = $em->getRepository('models\Quantify\Config')->findAll();
        
        //Get POST Data
        $post = array();
        foreach ( $_POST as $key => $value )
        {
            $post[$key] = $this->input->post($key);
        }
        
        //compare post data to current config data
        //persist if changed
        foreach($configs as $config)
        {
            if(!($post[$config->getConfigKey()] == $config->getConfigValue()))
            {
                $config->setConfigValue($post[$config->getConfigKey()]);
                $em->persist($config);
                $em->flush();
            }
        }
        redirect('admin/config');
    }
}
