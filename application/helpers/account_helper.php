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

function check_login()
{
	// Get CodeIgniter Object
	$CI =& get_instance();

	// Load Session Library
	$CI->load->library('session');

	// Load URL Helper
	$CI->load->helper('url');

	// Location of the login screen
	$login_url = '/auth/login';

	// Session variable to check if user is logged in
	$user_session_var = 'logged_in';

	if($CI->uri->uri_string() != $login_url)
	{
            if( ! $CI->session->userdata($user_session_var))
            {
                // user is not logged in
                $CI->session->set_userdata('redirect_url', $CI->uri->uri_string());
                redirect($login_url);
            }
            else
            {
                // User logged in
                $CI->session->unset_userdata('redirect_url');
            }
	}
}

function hasPermission($user, $minPermission)
{
    // Get CodeIgniter Object
    $CI =& get_instance();
    
    $em = $CI->doctrine->em;
        
    $perm = $em->getRepository('models\Quantify\Permission')->findOneBy(array('permission_name' => $minPermission));
    //Guilty until proven innocent
    $retVal = false;
    
    if($user->getPermission()->getPermissionLevel() <= $perm->getPermissionLevel())
    {
        $retVal = true;
    }
    
    return $retVal;
}

/* End of file account_helper.php */
/* Location: ./application/helpers/account_helper.php */