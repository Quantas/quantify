<?php
/*
 * Copyright 2012 Andrew Landsverk
 *
 * This file is part of Quantify.
 *
 * Quantify is free software: you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or (at your option) any later 
 * version.
 *
 * Quantify is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more 
 * details.
 *
 * You should have received a copy of the GNU General Public License along with 
 * Quantify. If not, see http://www.gnu.org/licenses/.
 */

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
