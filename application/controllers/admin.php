<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Quantify\Config;
use models\Quantify\Category;
use models\Quantify\User;
use models\Quantify\Permission;
use DoctrineExtensions\Paginate\Paginate;

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
        $this->load->library('form_validation');
    }
    
    function index()
    {
        $vars['dbconfigs'] = getConfigArray();
        $vars['sidebar_view'] = 'admin';
        $vars['title'] = $this->title;
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    /**
     * Display the Configs
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
        $vars['dbconfigs'] = getConfigArray();
        $vars['sidebar_view'] = 'admin';
        $vars['content_view'] = 'config';
        $vars['title'] = $this->title . ' > Config';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    /**
     * Display the Categories
     */
    function categories()
    {
        $em = $this->doctrine->em;
        
        $categories = $em->getRepository('models\Quantify\Category')->findAll();
        
        $vars['categories'] = $categories;
        $vars['dbconfigs'] = getConfigArray();
        $vars['sidebar_view'] = 'admin';
        $vars['content_view'] = 'admin_category';
        $vars['title'] = $this->title . ' > Categories';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    /**
     * Display the entries
     * 
     * Pagination is a bitch
     */
    function entries($offset = 0)
    {
        $limitPerPage = 10;
        
        $em = $this->doctrine->em;
        $query = $em->createQuery("SELECT e.entry_id, e.entry_title, e.entry_timestamp, c.category_name, u.user_display_name FROM models\Quantify\Entry e JOIN e.category c JOIN e.user u");

        $count = Paginate::getTotalQueryResults($query);
        $paginateQuery = Paginate::getPaginateQuery($query, $offset, $limitPerPage);
        $entries = $paginateQuery->getResult();

        if ($count > $limitPerPage) 
        {
            // PAGINATION
            $this->load->library('pagination');
            $config['base_url'] = base_url() . "admin/entries";
            $config['total_rows'] = $count;
            $config['per_page'] = $limitPerPage;
            $config['uri_segment'] = 3;
            //Pagination Style
            $config['prev_link'] = 'Newer';
            $config['next_link'] = 'Older';
            $config['anchor_class'] = 'class="paginate-page"';
            $this->pagination->initialize($config);
            $vars['pagination'] = $this->pagination->create_links();
        }
        
        $vars['entries'] = $entries;
        $vars['dbconfigs'] = getConfigArray();
        $vars['sidebar_view'] = 'admin';
        $vars['content_view'] = 'admin_entries';
        $vars['title'] = $this->title . ' > Entries';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
   /**
    * Display the users
    */
    function users()
    {
        $em = $this->doctrine->em;
        
        $users = $em->getRepository('models\Quantify\User')->findAll();
        
        $vars['users'] = $users;
        $vars['dbconfigs'] = getConfigArray();
        $vars['sidebar_view'] = 'admin';
        $vars['content_view'] = 'admin_users';
        $vars['title'] = $this->title . ' > Users';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
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
     * Add a new category
     */
    function addCategory()
    {
        $em = $this->doctrine->em;
        
        $category = new Category;
        $category->setCategoryName($this->input->post('name'));
        $em->persist($category);
        $em->flush();
        
        redirect('admin/categories');
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
    
    public function addUser() 
    {
        if ($this->_submit_validate() === FALSE) 
        {
            $this->users();
            return;
        }

        $em = $this->doctrine->em;
        
        $u = new User();
        $u->setUserName($this->input->post('username'));
        $u->setUserPassword($this->input->post('password'));
        $u->setUserEmail($this->input->post('email'));
        $u->setuserDisplayName($this->input->post('displayname'));
        $u->setPermission($em->getRepository('models\Quantify\Permission')->findOneBy(array('permission_name' => 'Moderator')));
        $em->persist($u);
        $em->flush();
        
        redirect('admin/users');
    }
	
    private function _submit_validate() 
    {
        // validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[6]|max_length[12]|unique[models\Quantify\User.username]');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[12]');

        $this->form_validation->set_rules('password-again', 'Confirm Password', 'required|matches[password]');

        $this->form_validation->set_rules('displayname', 'Display Name', 'required|max_length[255]');

        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|unique[models\Quantify\User.email]');

        return $this->form_validation->run();	
    }
    
    function editEntry($id = null)
    {
        
    }
    
    function deleteEntry($id = null)
    {
        
    }
}
