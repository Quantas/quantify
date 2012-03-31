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
use DoctrineExtensions\Paginate\Paginate;

/**
 * This is the story controller
 *
 * @author Quantas
 */
class Story extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display the entries
     * 
     * Pagination is fun
     */
    function entries($offset = 0)
    {
        $limitPerPage = 4;
        
        $em = $this->doctrine->em;
        $query = $em->createQuery("SELECT e.entry_id, e.entry_title, e.entry_timestamp, e.entry_content content, c.category_name, u.user_display_name FROM models\Quantify\Entry e JOIN e.category c JOIN e.user u ORDER BY e.entry_timestamp DESC");

        $count = Paginate::getTotalQueryResults($query);
        $paginateQuery = Paginate::getPaginateQuery($query, $offset, $limitPerPage);
        $entries = $paginateQuery->getResult();

        if ($count > $limitPerPage) 
        {
            // PAGINATION
            $this->load->library('pagination');
            $config['base_url'] = base_url() . "story/entries";
            $config['total_rows'] = $count;
            $config['per_page'] = $limitPerPage;
            $config['uri_segment'] = 3;
            //Pagination Style
            $config['prev_link'] = 'Newer';
            $config['next_link'] = 'Older';
            $config['anchor_class'] = 'class="paginate-page"';
            //init pagination
            $this->pagination->initialize($config);
            $vars['pagination'] = $this->pagination->create_links();
        }
        
        $vars['entries'] = $entries;
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'entries';
        $vars['title'] = 'Home';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    function view($entry)
    {
        $em = $this->doctrine->em;
        $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $entry));
        
        $vars['entry'] = $entry;
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'entry';
        $vars['title'] = anchor('/', 'Home') . ' > ' . $entry->getEntryTitle();
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
}