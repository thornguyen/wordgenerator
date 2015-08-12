<?php

namespace WordGenerator;

/**
 * Description of ApiDescription
 *
 * @author hoang.nguyen
 */
class ApiDescription {
    
    /* Start - Keys for creating an array */
    const API_TITLE = 'API_TITLE';
    const API_NAME = 'API_NAME';
    const API_DESCRIPTION = 'API_DESCRIPTION';
    const API_METHOD = 'API_METHOD';
    const API_STATUS = 'API_STATUS';
    const API_AUTHEN = 'API_AUTHEN';
    const LINK_PRODUCTION = 'LINK_PRODUCTION';
    const LINK_TEST = 'LINK_TEST';
    const LINK_SANDBOX = 'LINK_SANDBOX';
    /* End - Keys for creating an array */
    
    
    const TEMPLATE = '
    <h1>{API_TITLE}</h1>
    {API_DESCRIPTION}. Clients must use a valid session token obtained with a previous 
    call to the {API_AUTHEN}.<br/>
    The URL for accessing the {API_NAME} is:
    <ul class="url_access">
    <li><span>Production – </span><a href="{linkProduction}">{linkProduction}</a></li>
    <li><span>Test – </span><a href="{linkTest}">{linkTest}</a></li>
    <li><span>Sandbox – </span><a href="{linkSandbox}">{linkSandbox}</a></li>
    </ul>
    HTTP method supported is: <strong>{API_METHOD}<strong>.<br/>
    Status: <strong>{API_STATUS}<strong>.';

    
    private $apiTitle;
    private $apiName;
    private $apiDescription;
    private $apiMethod;
    private $apiStatus;
    private $apiAuthen;
    private $linkProduction;
    private $linkTest;
    private $linkSandbox;
    
    /**
     * initializate params
     * @param type $apiName
     * @param type $apiDescription
     * @param type $apiMethod
     * @param type $apiStatus
     * @param type $apiAuthen
     * @param type $linkProduction
     * @param type $linkTest
     * @param type $linkSandbox
     * Hoang Nguyen
     */
    public function __construct($apiTitle, $apiName, $apiDescription, $apiMethod, $apiStatus, $apiAuthen, $linkProduction, $linkTest, $linkSandbox) 
    {                
        $this->apiTitle = $apiTitle;
        $this->apiDescription = $apiDescription;
        $this->apiMethod = $apiMethod;
        $this->apiStatus = $apiStatus;
        $this->apiAuthen = $apiAuthen;
        $this->linkProduction = $linkProduction;
        $this->linkSandbox = $linkSandbox;
        $this->linkTest = $linkTest;
    }

    /**
     * release memory used
     * Hoang Nguyen
     */
    function __destruct()
    {
        unset($this->apiTitle);
        unset($this->apiName);
        unset($this->apiDescription);
        unset($this->apiMethod);
        unset($this->apiStatus);
        unset($this->apiAuthen);
        unset($this->linkProduction);
        unset($this->linkSandbox);
        unset($this->linkTest);
    }
    
    /**
     * get html markup for API description
     * @return type string
     * Hoang Nguyen
     */
    public function getHtmlDescription()
    {
        $description = self::TEMPLATE;

        $description = strtr($description, array(

            '{API_TITLE}' => $this->apiTitle,
            '{API_NAME}' => $this->apiName,
            '{API_DESCRIPTION}' => $this->apiDescription,
            '{API_AUTHEN}' => $this->apiAuthen,
            '{API_METHOD}' => $this->apiMethod,
            '{API_STATUS}' => $this->apiStatus,

            '{linkProduction}' => $this->linkProduction,
            '{linkTest}' => $this->linkTest,
            '{linkSandbox}' => $this->linkSandbox
        ));

        return $description;          
    }
}
