<?php

namespace models\Quantify;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="user",indexes={@index(name="fk_user_permission",columns={"user_permission_id"})})
 */
class User
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $user_id;

    /**
     * @OneToMany(targetEntity="Entry", mappedBy="user")
     */
    private $entries;

    /**
     * @ManyToOne(targetEntity="Permission", inversedBy="users")
     * @JoinColumn(name="user_permission_id", referencedColumnName="permission_id")
     */
    private $permission;

    /** 
     * 
     * @Column(type="string",length=45,unique=true)
     */
    private $user_name;

    /** 
     * 
     * @Column(type="string",length=45)
     */
    private $user_password;

    /** 
     * 
     * @Column(type="string",length=45)
     */
    private $user_display_name;

    public function __construct()
    {

        $this->categories = new ArrayCollection();
    }


    //no relation
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this; // fluent interface
    }

    //no relation
    public function getUserId()
    {
        return $this->user_id;
    }

    //one to many relation
    public function addEntry(Entry $entry)
    {
        $this->entries[] = $entry;
        return $this; // fluent interface
    }

    //one to many relation
    public function getEntries()
    {
        return $this->entries;
    }

    //many to one relation
    public function setPermission(Permission $permission)
    {
        $permission->addUser($this);
        $this->permission = $permission;
        return $this; // fluent interface
    }

    //many to one or one to one relation
    public function getPermission()
    {
        return $this->permission;
    }

    //no relation
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
        return $this; // fluent interface
    }

    //no relation
    public function getUserName()
    {
        return $this->user_name;
    }

    //no relation
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
        return $this; // fluent interface
    }

    //no relation
    public function getUserPassword()
    {
        return $this->user_password;
    }

    //no relation
    public function setUserDisplayName($user_display_name)
    {
        $this->user_display_name = $user_display_name;
        return $this; // fluent interface
    }

    //no relation
    public function getUserDisplayName()
    {
        return $this->user_display_name;
    }

    public function addCategory(Category $category)
    {
        $category->addUser($this);
        $this->categories[] = $category;
        return $this;
    }

    public function getCategories()
    {
        return $this->categories;
    }
}
