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

/**
 * Auth controller, used to login/logout
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
    
    public function login()
    {
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'login_form';
        $vars['title'] = 'Login';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
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
            redirect('/auth/login');
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