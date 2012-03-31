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
 * Category controller
 *
 * @author Quantas
 */
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function all()
    {
        $em = $this->doctrine->em;
        
        $vars['categories'] = $em->getRepository('models\Quantify\Category')->findAll();
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'categories';
        $vars['title'] = anchor('/', 'Home') . ' > Categories';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    function view($category)
    {
        $em = $this->doctrine->em;
        
        $query = $em->createQuery("SELECT e.entry_id, e.entry_title, e.entry_timestamp, e.entry_content content, c.category_name, u.user_display_name FROM models\Quantify\Entry e JOIN e.category c JOIN e.user u where c.category_name = ?1 ORDER BY e.entry_timestamp DESC");
        $query->setParameter(1, urldecode($category));
        $entries = $query->getResult();

        $vars['entries'] = $entries;
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'category_entries';
        $vars['title'] = anchor('/', 'Home') . ' > ' . anchor('/category/all', 'Categories') . ' > ' . urldecode($category);
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
}

?>
