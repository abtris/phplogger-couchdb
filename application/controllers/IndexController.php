<?php

require_once "Phly/Couch.php";
require_once "Phly/Couch/DocumentSet.php";
require_once "Phly/Couch/Result.php";
require_once "Phly/Couch/Exception.php";
require_once "Phly/Couch/Document.php";

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
//        // action body
//        $db = new Phly_Couch(array("host"=>"localhost", "port"=>"5984", "db"=>"test-log"));
//        $doc = new Phly_Couch_Document(array("key"=>"value"));
//        $result = $db->docSave($doc);
//        // return array ok, id, rev
//        Zend_Debug::dump($result->getInfo());
          $logger = new Zend_Log();
          $logger->addWriter(new App_ZendLogWriterCouchDb());
          $logger->log("Testovani logovani", Zend_Log::DEBUG);
    }


}

