<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation 
{

    function unique($value, $params)
    {
            $CI =& get_instance();
            $CI->form_validation->set_message('unique', 'The %s is already being used.');
            $em = $CI->doctrine->em;
            
            list($model, $field) = explode(".", $params, 2);

            $find = "findOneBy".$field;

            if ($em->getRepository($model)->findOneBy(array('user_name' => $value))) 
            {
                return false;
            } 
            else 
            {
                return true;
            }

    }
}