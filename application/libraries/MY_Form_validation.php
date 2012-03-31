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
 * Custom form validation
 * @author Quantas 
 */
class MY_Form_validation extends CI_Form_validation 
{
    /**
     * Check for uniqueness
     * @param type $value
     * @param type $params
     * @return boolean 
     */
    function unique($value, $params)
    {
            $CI =& get_instance();
            $CI->form_validation->set_message('unique', 'The %s is already being used.');
            $em = $CI->doctrine->em;
            
            list($model, $field) = explode(".", $params, 2);

            $find = "findOneBy".$field;

            if ($em->getRepository($model)->findOneBy(array('user_name' => $value))) 
            {
                return false;
            } 
            else 
            {
                return true;
            }

    }
}