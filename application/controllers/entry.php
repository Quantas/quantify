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
use models\Quantify\Current_User;

/**
 * Entry controller
 *
 * @author Quantas
 */
class Entry extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    function add()
    {
        if(hasPermission(Current_User::user(), 'Editor'))
        {
            $em = $this->doctrine->em;

            $categories = $em->getRepository('models\Quantify\Category')->findAll();

            $vars['categories'] = $categories;
            $vars['dbconfigs'] = getConfigArray();
            $vars['content_view'] = 'entry_editor';
            $vars['title'] = anchor('/', 'Home') . ' > Add Entry';
            $this->load->view($vars['dbconfigs']['Style'],$vars);
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    function edit($id=0)
    {
        if(hasPermission(Current_User::user(), 'Editor'))
        {
            if($id > 0)
            {
                $em = $this->doctrine->em;
                $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $id));
                $categories = $em->getRepository('models\Quantify\Category')->findAll();

                $vars['categories'] = $categories;
                $vars['entry'] = $entry;
                $vars['dbconfigs'] = getConfigArray();
                $vars['content_view'] = 'entry_editor';
                $vars['title'] = anchor('/admin', 'Administration') . ' > ' . anchor('/admin/entries', 'Entries') . ' > Edit Entry';
                $this->load->view($vars['dbconfigs']['Style'],$vars);
            }
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    function deleteEntry($id = 0)
    {
        if(hasPermission(Current_User::user(), 'Editor'))
        {
            if($id > 0)
            {
                $em = $this->doctrine->em;
                $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $id));
                $em->remove($entry);
                $em->flush();
            }
            redirect('admin/entries');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    function editEntry()
    {
        if(hasPermission(Current_User::user(), 'Editor'))
        {
            $commenting = 0;

            if($this->input->post('commenting') != '')
            {
                $commenting = 1;
            }
            
            $em = $this->doctrine->em;

            $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $this->input->post('entry_id')));
            $entry->setEntryTitle($this->input->post('entryTitle'));
            $entry->setEntryContent($this->input->post('wysiwyg'));
            $entry->setEntryCommentsEnabled($commenting);
            $entry->setCategory($em->getRepository('models\Quantify\Category')->findOneBy(array('category_name' => $this->input->post('category'))));
            $em->persist($entry);

            $em->flush();

            redirect('admin/entries');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
    
    function submit()
    {       
        if(hasPermission(Current_User::user(), 'Editor'))
        {
            $em = $this->doctrine->em;

            $dbconfigs = getConfigArray();
            
            $commenting = 0;

            if($this->input->post('commenting') != '')
            {
                $commenting = 1;
            }
            

            $entry = new models\Quantify\Entry;
            $entry->setEntryTitle($this->input->post('entryTitle'));
            $entry->setEntryContent($this->input->post('wysiwyg'));
            $entry->setEntryTimestamp(new DateTime('now', new DateTimeZone($dbconfigs['Timezone'])));
            $entry->setUser(Current_User::user());
            $entry->setEntryCommentsEnabled($commenting);
            $entry->setCategory($em->getRepository('models\Quantify\Category')->findOneBy(array('category_name' => $this->input->post('category'))));
            $em->persist($entry);

            $em->flush();
            
            redirect('admin/entries');
        }
        else
        {
            redirect('admin/noperms');
        }
    }
}
