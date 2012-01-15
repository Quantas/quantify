<?php

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

    function view($entry)
    {
        $em = $this->doctrine->em;
        $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $entry));
        
        $vars['entry'] = $entry;
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'entry';
        $vars['title'] = $entry->getEntryTitle();
        $this->load->view('template',$vars);
    }
}
