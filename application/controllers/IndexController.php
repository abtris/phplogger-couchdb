<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction()
    {
          $logger = new Zend_Log();
          $logger->addWriter(new App_Log_Writer_CouchDb("test-log"));
          echo "Logged action";
          $logger->log("Testovani logovani", Zend_Log::DEBUG);
    }


}

