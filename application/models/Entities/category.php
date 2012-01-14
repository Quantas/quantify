<?php

namespace com\Quantasnet\Entities;

/**
 * @Entity
 * @Table(name="category",indexes={@index(name="category_name_UNIQUE",columns={"category_name"}),@index(name="category_id_UNIQUE",columns={"category_id"})})
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
     * @Column(type="string",length=45)
     */
    private $category_name;

    public function __construct()
    {

        $this->users = new ArrayCollection();
    }


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
