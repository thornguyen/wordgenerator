<?php

namespace WordGenerator;

/**
 * Description of Page
 *
 * @author hoang.nguyen
 */
class Page {
        
    private $description;
    private $requestObject;
    private $responseObject;
    
    public function __construct() 
    {
        
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
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function getRequestObject()
    {
        return $this->requestObject;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function setRequestObject($requestObject)
    {
        $this->requestObject = $requestObject;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function getResponseObject()
    {
        return $this->responseObject;
    }
    
    /**
     * 
     * @return type
     * Hoang Nguyen
     */
    public function setResponseObject($responseObject)
    {
        $this->responseObject = $responseObject;
    }
}
