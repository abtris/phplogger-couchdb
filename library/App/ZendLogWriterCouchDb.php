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
/**
 * ZendLogWriterCouchDb
 * @throws Zend_Log_Exception
 */
class App_ZendLogWriterCouchDb extends Zend_Log_Writer_Abstract
{
    /**
     * Db
     * @var Phly_Couch
     */
    private $_db;
    /**
     * CouchDb host localhost default
     * @var string
     */
    private $_host;
    /**
     * Couchdb port 3184 default
     * @var int
     */
    private $_port;
    /**
     *
     * @param array $params
     * @return void
     */
    public function __construct(array $params = array())
    {
        $this->_db = new Phly_Couch(array("host"=>"localhost", "port"=>"5984", "db"=>"test-log"));
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
        // action body
        $doc = new Phly_Couch_Document($event);
        $result = $this->_db->docSave($doc);
        // return array ok, id, rev
        $info = $result->getInfo();
        if (!$info['ok']) {
            throw new Zend_Log_Exception("Error in save to CouchDb");
        }        
    }

    
}