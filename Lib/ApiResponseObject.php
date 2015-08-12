<?php

namespace WordGenerator;

/**
 * Description of ApiDescription
 *
 * @author hoang.nguyen
 */
class ApiResponseObject {
    
    private $field;
    private $mandatory;
    private $dataType;
    private $description;
    
    public function getField()
    {
        return $this->field;
    }
    public function setField($field)
    {
        $this->field = $field;
    }
    
    
    public function getMandatory()
    {
        return $this->mandatory;
    }
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;
    }
    
    
    public function getDataType()
    {
        return $this->dataType;
    }
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }
    
    
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
