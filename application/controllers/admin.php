<?php
/*
 * Copyright 2012 Andrew Landsverk
 *
 * This file is part of Quantify.
 *
 * Quantify is free software: you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or (at your option) any later 
 * version.
 *
 * Quantify is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more 
 * details.
 *
 * You should have received a copy of the GNU General Public License along with 
 * Quantify. If not, see http://www.gnu.org/licenses/.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use models\Quantify\Config;
use models\Quantify\Category;
use models\Quantify\Current_User;
use models\Quantify\User;
use models\Quantify\Permission;
use DoctrineExtensions\Paginate\Paginate;

/**
 * Admin controller used to modify the site config and content
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
        if(hasPermission(Current_User::user(), 'Administrator'))
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
        else
        {
            redirect('admin/noperms');
        }
    }
    
    /**
     * Display the Categories
     */
    function categories()
    {
        if(hasPermission(Current_User::user(), 'Editor'))
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
        else
        {
            redirect('admin/noperms');
        }
    }
    
    /**
     * Display the entries
     * 
     * Pagination is fun
     */
    function entries($offset = 0)
    {
        if(hasPermission(Current_User::user(), 'Editor'))
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
        else
        {
            redirect('admin/noperms');
        }
    }
    
   /**
    * Display the users
    */
    function users()
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
        {
            $em = $this->doctrine->em;

            $users = $em->getRepository('models\Quantify\User')->findAll();

            $permissions = $em->getRepository('models\Quantify\Permission')->findAll();

            $vars['permissions'] = $permissions;
            $vars['users'] = $users;
            $vars['dbconfigs'] = getConfigArray();
            $vars['sidebar_view'] = 'admin';
            $vars['content_view'] = 'admin_users';
            $vars['title'] = $this->title . ' > Users';
            $this->load->view($vars['dbconfigs']['Style'],$vars);
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    /**
     * Add a new config to the DB
     */
    function addConfig()
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
        {
            $em = $this->doctrine->em;

            $config = new Config;
            $config->setConfigKey($this->input->post('key'));
            $config->setConfigValue($this->input->post('value'));
            $em->persist($config);
            $em->flush();

            redirect('admin/config');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    /**
     * Add a new category
     */
    function addCategory()
    {
        if(hasPermission(Current_User::user(), 'Editor'))
        {
            $em = $this->doctrine->em;

            $category = new Category;
            $category->setCategoryName($this->input->post('name'));
            $em->persist($category);
            $em->flush();

            redirect('admin/categories');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    /**
     * Update the configs in the DB
     */
    function editConfigs()
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
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
        else
        {
            redirect('admin/noperms');
        }
    }
    
    public function addUser() 
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
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
            $u->setPermission($em->getRepository('models\Quantify\Permission')->findOneBy(array('permission_id' => $this->input->post('permission'))));
            $em->persist($u);
            $em->flush();

            redirect('admin/users');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    public function editUser($id = 0)
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
        {
            if($id > 0)
            {            
                $em = $this->doctrine->em;
                $user = $em->getRepository('models\Quantify\User')->findOneBy(array('user_id' => $id));
                $permissions = $em->getRepository('models\Quantify\Permission')->findAll();

                $vars['permissions'] = $permissions;
                $vars['user'] = $user;
                $vars['dbconfigs'] = getConfigArray();
                $vars['sidebar_view'] = 'admin';
                $vars['content_view'] = 'admin_user_edit';
                $vars['title'] = $this->title . ' > Edit User';
                $this->load->view($vars['dbconfigs']['Style'],$vars);
            }
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    public function editUserSave()
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
        {
            if ($this->_edit_submit_validate() === FALSE) 
            {
                $this->editUser($this->input->post('user_id'));
                return;
            }
            
            $em = $this->doctrine->em;

            $u = $em->getRepository('models\Quantify\User')->findOneBy(array('user_id' => $this->input->post('user_id')));
            if($this->input->post('password') != '')
            {
                $u->setUserPassword($this->input->post('password'));
            }
            $u->setUserEmail($this->input->post('email'));
            $u->setuserDisplayName($this->input->post('displayname'));
            $u->setPermission($em->getRepository('models\Quantify\Permission')->findOneBy(array('permission_id' => $this->input->post('permission'))));
            $em->persist($u);
            $em->flush();

            redirect('admin/users');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    public function deleteUser($id = 0)
    {
        if(hasPermission(Current_User::user(), 'Administrator'))
        {
            if($id > 0)
            {
                try
                {
                    $em = $this->doctrine->em;
                    $user = $em->getRepository('models\Quantify\User')->findOneBy(array('user_id' => $id));
                    $em->remove($user);
                    $em->flush();
                    
                    redirect('admin/users');
                }
                catch(Exception $e)
                {
                    error_occured('There was an error deleting the user, do they have entries?<br />' . $e->getMessage());
                }
            }
        }
        else
        {
            redirect('admin/noperms');
        }
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
    
    private function _edit_submit_validate() 
    {
        // validation rules
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]|max_length[12]');

        $this->form_validation->set_rules('password-again', 'Confirm Password', 'matches[password]');

        $this->form_validation->set_rules('displayname', 'Display Name', 'required|max_length[255]');

        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|unique[models\Quantify\User.email]');

        return $this->form_validation->run();	
    }
    
    function noperms()
    {
        $vars['dbconfigs'] = getConfigArray();
        $vars['sidebar_view'] = 'admin';
        $vars['content_view'] = 'admin_noperms';
        $vars['title'] = $this->title . ' > Not Authorized';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
}
