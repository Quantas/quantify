<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use models\Quantify\Current_User;

/**
 * Description of entry
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
        $em = $this->doctrine->em;
        
        $categories = $em->getRepository('models\Quantify\Category')->findAll();
        
        $vars['categories'] = $categories;
        $vars['dbconfigs'] = getConfigArray();
        $vars['content_view'] = 'entry_editor';
        $vars['title'] = anchor('/', 'Home') . ' > Add Entry';
        $this->load->view($vars['dbconfigs']['Style'],$vars);
    }
    
    function edit($id=0)
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
    
    function deleteEntry($id = 0)
    {
        if($id > 0)
        {
            $em = $this->doctrine->em;
            $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $id));
            $em->remove($entry);
            $em->flush();
            
            redirect('admin/entries');
        }
    }
    
    function editEntry()
    {
        $em = $this->doctrine->em;
        
        $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $this->input->post('entry_id')));
        $entry->setEntryTitle($this->input->post('entryTitle'));
        $entry->setEntryContent($this->input->post('wysiwyg'));
        $entry->setCategory($em->getRepository('models\Quantify\Category')->findOneBy(array('category_name' => $this->input->post('category'))));
        $em->persist($entry);
        
        $em->flush();
        
        redirect('admin/entries');
    }
    
    function submit()
    {        
        $em = $this->doctrine->em;
        
        $dbconfigs = getConfigArray();
        
        $entry = new models\Quantify\Entry;
        $entry->setEntryTitle($this->input->post('entryTitle'));
        $entry->setEntryContent($this->input->post('wysiwyg'));
        $entry->setEntryTimestamp(new DateTime('now', new DateTimeZone($dbconfigs['Timezone'])));
        $entry->setUser(Current_User::user());
        $entry->setCategory($em->getRepository('models\Quantify\Category')->findOneBy(array('category_name' => $this->input->post('category'))));
        $em->persist($entry);
        
        $em->flush();
        
        redirect('admin/entries');
    }
}
