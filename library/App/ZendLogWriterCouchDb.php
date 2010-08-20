<?php
/**
 * Created by PhpStorm.
 * User: prskavecl
 * Date: Aug 20, 2010
 * Time: 5:10:54 PM
 * To change this template use File | Settings | File Templates.
 */
/** Zend_Log_Writer_Abstract */
require_once 'Zend/Log/Writer/Abstract.php'; 

class App_ZendLogWriterCouchDb extends Zend_Log_Writer_Abstract
{
    private $_db;
    private $_host;
    private $_post;


    public function __construct(array $params = array())
    {

    }

    static public function factory($config)                                                                                                                 
    {
        $config = self::_parseConfig($config);
        return $config;
    }
    /**
     * @param array $event
     * @return void
     */
    protected function _write($event)
    {
        
    }

    
}