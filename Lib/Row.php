<?php

namespace WordGenerator;

/**
 * Description of Row
 *
 * @author hoang.nguyen
 */
class Row {
        
    private $field;
    private $mandatory;
    private $dataType;
    private $description;
    
    public function __construct() 
    {
        
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function setField($field)
    {
        $this->field = $field;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function getMandatory()
    {
        return $this->mandatory;
    }
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;
    }
    
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function getDataType()
    {
        return $this->dataType;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
