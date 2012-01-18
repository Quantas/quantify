<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use DoctrineExtensions\Paginate\Paginate;

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
            $this->pagination->initialize($config);
            $vars['pagination'] = $this->pagination->create_links();
        }
        
        $vars['entries'] = $entries;
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'entries';
        $vars['title'] = 'Home';
        $this->load->view(get_dbconfig('style'),$vars);
    }
    
    function view($entry)
    {
        $em = $this->doctrine->em;
        $entry = $em->getRepository('models\Quantify\Entry')->findOneBy(array('entry_id' => $entry));
        
        $vars['entry'] = $entry;
        $vars['css'] = get_dbconfig('style');
        $vars['content_view'] = 'entry';
        $vars['title'] = anchor('/', 'Home') . ' > ' . $entry->getEntryTitle();
        $this->load->view(get_dbconfig('style'),$vars);
    }
}
