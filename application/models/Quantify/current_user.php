<?php
namespace models\Quantify;

use models\Quantify\User;

class Current_User 
{
        //Singleton class
	private static $user;

	private function __construct() 
        {
            
        }

	public static function user() 
        {
            if(!isset(self::$user)) 
            {
                $CI =& get_instance();
                $em = $CI->doctrine->em;

                if (!$user_id = $CI->session->userdata('user_id')) 
                {
                    return FALSE;
                }

                if (!$u = $em->getRepository('models\Quantify\User')->findOneBy(array('user_id' => $user_id)))
                {
                    return FALSE;
                }

                self::$user = $u;
            }
            return self::$user;
	}
        
	public static function login($username, $password) 
        {
            $CI =& get_instance();
            $em = $CI->doctrine->em;
            
            // get User object by username
            if ($u = $em->getRepository('models\Quantify\User')->findOneBy(array('user_name' => $username))) 
            {
                // this mutates (encrypts) the input password
                $u_input = new User;
                $u_input->setUserPassword($password);

                // password match (comparing encrypted passwords)
                if ($u->getUserPassword() == $u_input->getUserPassword()) 
                {
                    unset($u_input);

                    $CI =& get_instance();
                    $CI->load->library('session');
                    $CI->session->set_userdata('user_id',$u->getUserId());
                    self::$user = $u;

                    return TRUE;
                }

                unset($u_input);
            }

            // login failed
            return FALSE;
	}

	public function __clone() 
        {
            trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
}