<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
        $data['feed_name'] = get_dbconfig('SiteName');  
        $data['encoding'] = 'utf-8';  
        $data['feed_url'] = base_url() . 'Feed';  
        $data['page_description'] = get_dbconfig('SiteDesc');  
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