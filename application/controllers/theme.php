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
use models\Quantify\Current_User;

/**
 * This is the controller for editing a theme
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
        if(hasPermission(Current_User::user(), 'Administrator'))
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
        else
        {
            redirect('admin/noperms');
        }
    }
    
    public function edit()
    {
        if(hasPermission(Current_User::user(), 'Editor'))
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
        else
        {
            redirect('admin/noperms');
        }
    }
}