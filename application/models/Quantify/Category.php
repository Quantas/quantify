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
 * @Table(name="category")
 */
class Category
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $category_id;

    /**
     * @OneToMany(targetEntity="Entry", mappedBy="category")
     */
    private $entries;

    /** 
     * 
     * @Column(type="string",length=45,unique=true)
     */
    private $category_name;

    //no relation
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
        return $this; // fluent interface
    }

    //no relation
    public function getCategoryId()
    {
        return $this->category_id;
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

    //no relation
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
        return $this; // fluent interface
    }

    //no relation
    public function getCategoryName()
    {
        return $this->category_name;
    }
}
