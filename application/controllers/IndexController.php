<?php

class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
         $db = new Phly_Couch(array("db"=>"test-log", "host"=>"localhost", "port"=>"5984"));

         $this->view->form = $form = new App_Form_Filter();
         if ($this->getRequest()->isPost()) {
             $formData = $this->getRequest()->getPost();
             if ($form->isValid($formData)) {
                 $filterValue = $form->getValue('filter');
                 if (empty($filterValue)) $filterValue = null;
                 $result = $db->view('log_by_prior','log_by_prior', $filterValue, array("db"=>"test-log"));
             } else {
             $form->populate($formData);
             }
         } else {
            $result = $db->view('log_by_prior','log_by_prior', null, array("db"=>"test-log"));         
         }         
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

