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
        // action body
        $db = new Phly_Couch();
        //Zend_Debug::dump($db->allDbs());
        $db->setDb('test-log');
        $doc = new Phly_Couch_Document(array("key"=>"value"));
        $result = $db->docSave($doc);
        Zend_Debug::dump($result);
    }


}

