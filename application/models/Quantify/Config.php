<?php

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
