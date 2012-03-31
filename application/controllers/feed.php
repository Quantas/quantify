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
 * This controller creats an rss feed
 * 
 *@author Quantas 
 */
class Feed extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('xml');  
        $this->load->helper('text');
    }
    
    public function index()
    {
        $dbconfigs = getConfigArray();
        
        $data['feed_name'] = $dbconfigs['SiteName'];  
        $data['encoding'] = 'utf-8';  
        $data['feed_url'] = base_url() . 'Feed';  
        $data['page_description'] = $dbconfigs['SiteDesc'];  
        $data['page_language'] = 'en-en';  
        $data['creator_email'] = 'mail@me.com';  
        $data['entries'] = $this->getEntries();  
        header("Content-Type: application/rss+xml");  
  
        $this->load->view('rss', $data);
    }
    
    private function getEntries()
    {
        $em = $this->doctrine->em;
        $query = $em->createQuery("SELECT e.entry_id, e.entry_title, e.entry_timestamp, e.entry_content content, c.category_name, u.user_display_name FROM models\Quantify\Entry e JOIN e.category c JOIN e.user u ORDER BY e.entry_timestamp DESC");
        return $query->getResult();
    }
    
}