<?php

namespace models\Quantify;

/**
 * @Entity
 * @Table(name="permission")
 */
class Permission
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $permission_id;

    /**
     * @OneToMany(targetEntity="User", mappedBy="permission")
     */
    private $users;

    /** 
     * 
     * @Column(type="integer",unique=true)
     */
    private $permission_level;

    /** 
     * 
     * @Column(type="string",length=45)
     */
    private $permission_name;


    public function __construct()
    {

    }


    //no relation
    public function setPermissionId($permission_id)
    {
        $this->permission_id = $permission_id;
        return $this; // fluent interface
    }

    //no relation
    public function getPermissionId()
    {
        return $this->permission_id;
    }

    //one to many relation
    public function addUser(User $user)
    {
        $this->users[] = $user;
        return $this; // fluent interface
    }

    //one to many relation
    public function getUsers()
    {
        return $this->users;
    }

    //no relation
    public function setPermissionLevel($permission_level)
    {
        $this->permission_level = $permission_level;
        return $this; // fluent interface
    }

    //no relation
    public function getPermissionLevel()
    {
        return $this->permission_level;
    }

    //no relation
    public function setPermissionName($permission_name)
    {
        $this->permission_name = $permission_name;
        return $this; // fluent interface
    }

    //no relation
    public function getPermissionName()
    {
        return $this->permission_name;
    }


}
