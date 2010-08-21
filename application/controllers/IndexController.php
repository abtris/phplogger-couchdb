<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
         $db = new Phly_Couch(array("db"=>"test-log", "host"=>"localhost", "port"=>"5984"));
         //$result = $db->allDbs();
         $result = $db->view('logger','all_logs', null, array("db"=>"test-log"));
         //$result = $db->view('log_by_prior','log_by_prior', "ERR", array("db"=>"test-log"));
         $this->view->docs = $result->toArray();
    }

    public function logAction()
    {
          $logger = new Zend_Log();
          $logger->addWriter(new App_Log_Writer_CouchDb("test-log"));
          echo "Logged action";
          $logger->log("Testovani chyba", Zend_Log::ERR);
    }


}

