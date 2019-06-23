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

use models\Quantify\User;

/**
 * Controller used to register a new account
 *
 * @author Quantas
 */
class Register extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    function signupForm()
    {
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'signup';
        $vars['title'] = 'Signup Form';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    public function addUser() 
    {
            if ($this->_submit_validate() === FALSE) 
            {
                $this->signupForm();
                return;
            }

            $em = $this->doctrine->em;

            $u = new User();
            $u->setUserName($this->input->post('username'));
            $u->setUserPassword($this->input->post('password'));
            $u->setUserEmail($this->input->post('email'));
            $u->setuserDisplayName($this->input->post('displayname'));
            $u->setPermission($em->getRepository('models\Quantify\Permission')->findOneBy(array('permission_name' => 'User')));
            $em->persist($u);
            $em->flush();

            redirect('story/entries');
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
}

?>
