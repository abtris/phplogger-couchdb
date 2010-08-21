<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        
    }

    public function logAction()
    {
          $logger = new Zend_Log();
          $logger->addWriter(new App_Log_Writer_CouchDb("test-log"));
          echo "Logged action";
          $logger->log("Testovani chyba", Zend_Log::ERR);
    }


}

