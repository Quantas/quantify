<?php

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    } 
            
}
