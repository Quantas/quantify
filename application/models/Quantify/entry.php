<?php

namespace models\Quantify;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="entry",indexes={@index(name="fk_entry_category",columns={"entry_category_id"}),@index(name="fk_entry_user",columns={"entry_user_id"})})
 */
class Entry
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $entry_id;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="entries")
     * @JoinColumn(name="entry_user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Category", inversedBy="entries")
     * @JoinColumn(name="entry_category_id", referencedColumnName="category_id")
     */
    private $category;

    /** 
     * 
     * @Column(type="string",length=45)
     */
    private $entry_title;

    /** 
     * 
     * @Column(type="datetime")
     */
    private $entry_timestamp;

    /** 
     * 
     * @Column(type="text")
     */
    private $entry_content;


    public function __construct()
    {

    }


    //no relation
    public function setEntryId($entry_id)
    {
        $this->entry_id = $entry_id;
        return $this; // fluent interface
    }

    //no relation
    public function getEntryId()
    {
        return $this->entry_id;
    }

    //many to one relation
    public function setUser(User $user)
    {
        $user->addEntry($this);
        $this->user = $user;
        return $this; // fluent interface
    }

    //many to one or one to one relation
    public function getUser()
    {
        return $this->user;
    }

    //many to one relation
    public function setCategory(Category $category)
    {
        $category->addEntry($this);
        $this->category = $category;
        return $this; // fluent interface
    }

    //many to one or one to one relation
    public function getCategory()
    {
        return $this->category;
    }

    //no relation
    public function setEntryTitle($entry_title)
    {
        $this->entry_title = $entry_title;
        return $this; // fluent interface
    }

    //no relation
    public function getEntryTitle()
    {
        return $this->entry_title;
    }

    //no relation
    public function setEntryTimestamp($entry_timestamp)
    {
        $this->entry_timestamp = $entry_timestamp;
        return $this; // fluent interface
    }

    //no relation
    public function getEntryTimestamp()
    {
        return $this->entry_timestamp;
    }

    //no relation
    public function setEntryContent($entry_content)
    {
        $this->entry_content = $entry_content;
        return $this; // fluent interface
    }

    //no relation
    public function getEntryContent()
    {
        return $this->entry_content;
    }


}
