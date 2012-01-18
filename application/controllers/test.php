<?php
use models\Quantify\Config;
use models\Quantify\Permission;
use models\Quantify\User;
use models\Quantify\Entry;
use models\Quantify\Category;

class Test extends CI_Controller
{
    public function addEntry()
    {
        $em = $this->doctrine->em;
        
        /*$cat = new Category;
        $cat->setCategoryName('First Category');
        $em->persist($cat);
        */
        
        $entry = new Entry;
        $entry->setEntryTitle('Test Entry 2');
        $entry->setEntryContent('My Test Article');
        $entry->setEntryTimestamp(new DateTime('now', new DateTimeZone(get_dbconfig('timezone'))));
        $entry->setUser($em->getRepository('models\Quantify\User')->findOneBy(array('user_name' => 'quantas')));
        $entry->setCategory($em->getRepository('models\Quantify\Category')->findOneBy(array('category_name' => 'First Category')));
        $em->persist($entry);
        
        $em->flush();
    }
    
    public function cat()
    {
        $em = $this->doctrine->em;
        
        $cats = $em->getRepository('models\Quantify\Category')->findAll();
        
        foreach($cats as $cat)
        {
            //var_dump($cat->getEntries());
            echo $cat->getCategoryName() . ' | ' . $cat->getEntries()->count();
        }
    }
    
    public function userTest()
    {
        $em = $this->doctrine->em;
        
        try
        {
            $perm = new Permission;
            $perm->setPermissionLevel('1');
            $perm->setPermissionName('Moderator');

            $em->persist($perm);
            echo 'Saved new Permission (Moderator)<br />';
            $user = new User;
            $user->setUserName('quantas');
            $user->setUserPassword(md5('quantas'));
            $user->setUserDisplayName('Andrew Landsverk');
            $user->setPermission($perm);

            $em->persist($user);
            echo 'Saved new user (Quantas)<br />';
            
            $em->flush();
            echo 'Flushed Objects to the DB';
        }
        catch(\PDOException $e)
        {
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}
