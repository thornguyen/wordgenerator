<?php

namespace WordGenerator;

/**
 * Description of WordHelper
 *
 * @author hoang.nguyen
 */
class Word {
    
    private $TITLE = 'API DOCUMENT';
    
    private $TOC_TITLE = 'Table of Content';
    
    private $UPDATE_CONTENT = 'Here the Table Of Content - Please right-click and choose "Update fields" to show it.';

    private $PAGE = '';


    /**
     * 
     * @param type $title: a string indicated the title of document that seen in the first page, default is API DOCUMENT
     * @param type $tocTitle: a string indicated the hint for user to generate the table of content (toc), default is Here the Table Of Content - Please right-click and choose "Update fields" to show it.
     * Hoang Nguyen
     */
    public function __construct($title=null, $tocTitle=null, $updateContent=null) {
        
        if($title)
        {
            $this->TITLE = $title;
        }
        
        if($tocTitle)
        {
            $this->TOC_TITLE = $tocTitle;
        }
        
        if($updateContent)
        {
            $this->UPDATE_CONTENT = $updateContent;
        }
    }
        
    /**
     * release memory used
     * Hoang Nguyen
     */
    function __destruct() {
        
        unset($this->PAGE);
        unset($this->TITLE);
        unset($this->TOC_TITLE);
        unset($this->UPDATE_CONTENT);
    }
    
    
    /**
     * parse description to html string
     * @param type $descriptionObj
     * @return array if error
     * Hoang Nguyen
     */
    private function pushDescription($descriptionObj)
    {
        if(is_array($descriptionObj))
        {
            $apiTitle = isset($descriptionObj[ApiDescription::API_TITLE]) ? $descriptionObj[ApiDescription::API_TITLE] : null;
            $apiAuthen = isset($descriptionObj[ApiDescription::API_AUTHEN]) ? $descriptionObj[ApiDescription::API_AUTHEN] : null;
            $apiDescription = isset($descriptionObj[ApiDescription::API_DESCRIPTION]) ? $descriptionObj[ApiDescription::API_DESCRIPTION] : null;
            $apiMethod = isset($descriptionObj[ApiDescription::API_METHOD]) ? $descriptionObj[ApiDescription::API_METHOD] : null;
            $apiName = isset($descriptionObj[ApiDescription::API_NAME]) ? $descriptionObj[ApiDescription::API_NAME] : null;
            $apiStatus = isset($descriptionObj[ApiDescription::API_STATUS]) ? $descriptionObj[ApiDescription::API_STATUS] : null;

            $linkProduction = isset($descriptionObj[ApiDescription::LINK_PRODUCTION]) ? $descriptionObj[ApiDescription::LINK_PRODUCTION] : null;
            $linkTest = isset($descriptionObj[ApiDescription::LINK_TEST]) ? $descriptionObj[ApiDescription::LINK_TEST] : null;
            $linkSandbox = isset($descriptionObj[ApiDescription::LINK_SANDBOX]) ? $descriptionObj[ApiDescription::LINK_SANDBOX] : null;

            $errorArray = array();
            $error = 'Array key is missing: {KEY}';
            if(is_null($apiTitle))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::API_TITLE));
            }
            if(is_null($apiAuthen))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::API_AUTHEN));
            }
            if(is_null($apiDescription))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::API_DESCRIPTION));
            }
            if(is_null($apiMethod))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::API_METHOD));
            }
            if(is_null($apiName))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::API_NAME));
            }
            if(is_null($apiStatus))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::API_STATUS));
            }

            if(is_null($linkProduction))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::LINK_PRODUCTION));
            }
            if(is_null($linkTest))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::LINK_TEST));
            }
            if(is_null($linkSandbox))
            {
                $errorArray[] = strtr($error, array('{KEY}' => ApiDescription::LINK_SANDBOX));
            }

            if(count($errorArray) === 0) 
            {
                $htmlAPIDescription = new ApiDescription($apiTitle, $apiName, $apiDescription, $apiMethod, $apiStatus, $apiAuthen, $linkProduction, $linkTest, $linkSandbox);

                $this->PAGE .= $htmlAPIDescription->getHtmlDescription();
                
                return true;
            }
            else
            {
                return $errorArray;
            }
        }
        else
        {
            throw new \Exception ('Description of Page Object must be an array!');
        }
    }
    
    /**
     * parse reuqest object to html string
     * @param type $requestObj
     * @return boolean
     * @throws \Exception
     * Hoang Nguyen
     */
    private function pushRequestObject($requestObj)
    {
        if(is_array($requestObj))
        {
            $htmlReuqestObj = '';
            foreach($requestObj as $value)
            {
                $htmlReuqestObj .= $value;
            }
            
            $this->PAGE .= $htmlReuqestObj;
            
            return true;
        }
        else
        {
            throw new \Exception ('Description of Page Object must be an array!');
        }
    }
    
    /**
     * Get html string from page inputted
     * @param \S3Corp\GreenMapleBundle\Utils\WordHelper\Page $page
     * @return type
     * @throws \Exception
     * Hoang Nguyen
     */
    public function pushPage(Page $page)
    {
        try 
        {  
           $descriptionObj = $page->getDescription();
           $resultDescription = $this->pushDescription($descriptionObj);
           
           $requestObj = $page->getRequestObject();
           $resultRequestObj = $this->pushRequestObject($requestObj);
           
           return $this->PAGE;
        } 
        catch (\Exception $ex) 
        {
            throw new \Exception ($ex->getMessage());
        }
    }
    
    /**
     * 
     * @param type $pageContent
     * @param type $fullFileName: filename with full path
     * If the path is not included, the file will save into web folder of project
     * Hoang Nguyen
     */
    public function savePage($pageContent, $fullFileName)
    {
        try 
        {  
            $reportContentFile = @file_get_contents(__DIR__ . '\report.html');
        
            $reportContentFile = strtr($reportContentFile, array(

                '{TITLE}' => $this->TITLE,
                '{TOC_TITLE}' => $this->TOC_TITLE,
                '{UPDATE_CONTENT}' => $this->UPDATE_CONTENT,
                '{BODY}' => $pageContent
            ));

            @file_put_contents($fullFileName, $reportContentFile);
            
            return true;
        } 
        catch (\Exception $ex) 
        {
            throw new \Exception ($ex->getMessage());
        }
    }
}
