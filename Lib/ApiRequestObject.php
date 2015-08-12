<?php

namespace WordGenerator;

/**
 * Description of ApiDescription
 *
 * @author hoang.nguyen
 */
class ApiRequestObject {
    
    private $TITLE_LEVEL = array(
        '<h1>{TITLE}</h1>',
        '<h2>{TITLE}</h2>',
        '<h3>{TITLE}</h3>',
    );
    
    const  TR = '
    <tr>
        <td>{FIELD}</td>
        <td class="center">{MANDATORY}</td>
        <td>{DATATYPE}</td>
        <td>{DESCRIPTION}</td>
    </tr>';

    const  PAGE_BREAK = '<br clear=all style="mso-special-character:line-break;page-break-before:always">';

    const TEMPLATE = '
    {TITLE}
    {NOTE_METHOD}
    <table width="100%">
       <thead>
          <td width="170">{COLUMN_NAME}</td>
          <td width="60">Mandatory</td>
          <td width="110">Data Type</td>
          <td>Description</td>
       </thead>
       {TR}
    </table>
    {PAGE_BREAK}';
        
    private $title;
    private $method;
    
    private $arrayOfRows;
    
    private $columnName;
    private $isPageBreak;
    
    /*
    public function __construct(array $arrayOfRows, $title = '', $titleLevel=3, $method = '', Column $columnName = Column::COLUMN_JSON_PARAM, $isPageBreak = false) 
    {
        $arrayOfTitle = self::TITLE_LEVEL;
        
        if(isset($arrayOfTitle[strval($titleLevel)]))
        {
            $this->title = strtr($arrayOfTitle[strval($titleLevel)], array(
                '{TITLE}' => $title
            ));
        }
        
        $this->arrayOfRows = $arrayOfRows;
        
        if($method !== '')
        {
            $method = 'Note that this request only accepts HTTP ' . $method;
        }
        
        $this->method = $method;
        
        $this->columnName = $columnName;
                
        $this->isPageBreak = $isPageBreak;
    }
    */
    
    /*
     * release the memory used
     * Hoang Nguyen
     */
    function __destruct() 
    {
        unset($this->title);
        unset($this->arrayOfRows);
        unset($this->method);
        unset($this->columnName);
        unset($this->isPageBreak);
        unset($this->TITLE_LEVEL);
    }
    
    /*
     * set some common params
     * Hoang Nguyen
     */
    private function setParams($titleLevel, $title, $method, $arrayOfRows)
    {
        if($title)
        {
            if(!$titleLevel)
            {
                $titleLevel = 0;
            }
            else
            {
                $titleLevel--;
            }
            
            $title = strip_tags($title);
        
            $this->title = strtr($this->TITLE_LEVEL[$titleLevel], array(
                    '{TITLE}' => $title
                ));
        }
        else
        {
            $this->title = '<br />';
        }
        
        if($method)
        {
            $method = 'Note that this request only accepts HTTP ' . $method;
        }
        
        $this->method = $method;
        
        $this->arrayOfRows = $arrayOfRows;
    }
    
    /**
     * get html markup for API Request Object
     * @return type string
     * Hoang Nguyen
     */
    private function getHtml()
    {
        $html = '';
        
        /* Start - generate TR */
        $tr = '';
        foreach($this->arrayOfRows as $key => $value)
        {
            if($value instanceof Row)
            {
                $tr .= strtr(self::TR, array(
                    '{FIELD}' => $value->getField(),
                    '{MANDATORY}' => $value->getMandatory(),
                    '{DATATYPE}' => $value->getDataType(),
                    '{DESCRIPTION}' => $value->getDescription()
                ));
            }
        }
        /* End - generate TR */
        
        if($tr !== '')
        {
            $pageBreak = '';            
            if($this->isPageBreak)
            {
                $pageBreak = self::PAGE_BREAK;
            }
            
            $html = self::TEMPLATE;
        
            $html = strtr($html, array(

                '{TITLE}' => $this->title,
                '{NOTE_METHOD}' => $this->method,
                '{COLUMN_NAME}' => $this->columnName,

                '{TR}' => $tr,
                '{PAGE_BREAK}' => $pageBreak
            ));
        }
        
        $this->title='';
        $this->method='';
        $this->TITLE_LEVEL='1';
        
        return $html;
    }
    
    /**
     * get html table for column named 'JSON Param', always seen with API CREATE. 
     * If $method is set, the string 'Note that this request only accepts HTTP...'
     * will be included.
     * @param array $arrayOfRows: array of Row object
     * @param type $title: string, no html tags
     * @param type $method: string
     * @return type string with html tag
     * Hoang Nguyen
     */
    public function getHtmlJSONParam(array $arrayOfRows, $title='', $method='')
    {
        $this->setParams(2, $title, $method, $arrayOfRows);
        
        $this->columnName = Column::COLUMN_JSON_PARAM;
        
        $this->isPageBreak = false;
        
        return $this->getHtml();
    }
    
    /**
     * get html table for column named 'URL Param', always seen with API GET. 
     * If $method is set, the string 'Note that this request only accepts HTTP...'
     * will be included.
     * @param array $arrayOfRows: array of Row object
     * @param type $title: string, no html tags
     * @param type $method: string
     * @return type string with html tag
     * Hoang Nguyen
     */
    public function getHtmlURLParam(array $arrayOfRows, $title='', $method='')
    {
        $this->setParams(2, $title, $method, $arrayOfRows);
        
        $this->columnName = Column::COLUMN_URL_PARAM;
        
        $this->isPageBreak = false;
        
        return $this->getHtml();
    }
    
    /**
     * get html table for column named 'URL Param', always seen with API GET, CREATE 
     * when getting the session token. 
     * If $method is set, the string 'Note that this request only accepts HTTP...'
     * will be included.
     * @param array $arrayOfRows: array of Row object
     * @param type $title: string
     * @param type $method: string
     * @return type string with html tag
     * Hoang Nguyen
     */
    public function getHtmlQueryParam(array $arrayOfRows, $title='', $method='')
    {
        $this->setParams(2, $title, $method, $arrayOfRows);
        
        $this->columnName = Column::COLUMN_QUERY_PARAM;
        
        $this->isPageBreak = false;
        
        return $this->getHtml();
    }
    
    /**
     * get html table for column named 'Field Param', to describe the object in Query Param
     * If $method is set, the string 'Note that this request only accepts HTTP...'
     * will be included.
     * @param array $arrayOfRows: array of Row object
     * @param type $title: string, no html tags
     * @param type $method: string
     * @param type $isPageBreak: boolean. If true, it is the same as Control Enter in Word.
     * @return type string with html tag
     * Hoang Nguyen
     */
    public function getHtmlFieldParam(array $arrayOfRows, $title='', $method='', $isPageBreak = false)
    {
        $this->setParams(3, $title, $method, $arrayOfRows);
        
        $this->columnName = Column::COLUMN_FIELD;
        
        $this->isPageBreak = $isPageBreak;
        
        return $this->getHtml();
    }
    
    /**
     * get a custom html content, default is get a page-break in word
     * @param type $titleLevel: only 1, 2 or 3
     * @param type $title: title of content without html tag
     * @param type $htmlContent: a content with html tag
     * @param type $isPageBreak: boolean. If true, it is the same as Control Enter in Word.
     * @return type string with html tag
     */
    public function getHtmlCustomContent($htmlContent=null, $isPageBreak = true, $title=null, $titleLevel=null)
    {
        $html = '';
        
        if($title) 
        {
            if(!$titleLevel)
            {
                $titleLevel = 1;
            }
            
            $title = strip_tags($title);
            
            $title = strtr($this->TITLE_LEVEL[strval($titleLevel)], array(
                    '{TITLE}' => $title
                ));
            
            $html .= $title;
        }
        
        $html .= $htmlContent;
        
        if($isPageBreak)
        {
            $html .= self::PAGE_BREAK;
        }
        
        return $html;
    }
}
