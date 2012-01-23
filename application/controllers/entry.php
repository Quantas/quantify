<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use DoctrineExtensions\Paginate\Paginate;
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
    
    /**
     * Display the entries
     * 
     * Pagination is a bitch
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
            $config['base_url'] = base_url() . "entry/entries";
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
