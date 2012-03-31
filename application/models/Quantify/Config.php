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

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="config")
 */
class Config
{
    /** 
     * @Id 
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    private $config_id;

    /** 
     * 
     * @Column(type="string",length=45,unique=true)
     */
    private $config_key;

    /** 
     * 
     * @Column(type="string",length=45,nullable=true)
     */
    private $config_value;


    public function __construct()
    {

    }


    //no relation
    public function setConfigId($config_id)
    {
        $this->config_id = $config_id;
        return $this; // fluent interface
    }

    //no relation
    public function getConfigId()
    {
        return $this->config_id;
    }

    //no relation
    public function setConfigKey($config_key)
    {
        $this->config_key = $config_key;
        return $this; // fluent interface
    }

    //no relation
    public function getConfigKey()
    {
        return $this->config_key;
    }

    //no relation
    public function setConfigValue($config_value)
    {
        $this->config_value = $config_value;
        return $this; // fluent interface
    }

    //no relation
    public function getConfigValue()
    {
        return $this->config_value;
    }


}
