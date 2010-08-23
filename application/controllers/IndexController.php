<?php

class IndexController extends Zend_Controller_Action
{
    protected $_config;

    public function preDispatch()  
    {
            $this->_config = new Zend_Config_Ini('../application/configs/'.
                    'application.ini', APPLICATION_ENV);
    }

    public function indexAction()
    {
         $db = new Phly_Couch($this->_config->couchdb);

         $this->view->form = $form = new App_Form_Filter();
         if ($this->getRequest()->isPost()) {
             $formData = $this->getRequest()->getPost();
             if ($form->isValid($formData)) {
                 $filterValue = $form->getValue('filter');
                 if (empty($filterValue)) $filterValue = null;
                 $result = $db->view('log_by_prior','log_by_prior', $filterValue, array("db"=>$this->_config->couchdb->db));
             } else {
             $form->populate($formData);
             }
         } else {
            $result = $db->view('log_by_prior','log_by_prior', null, array("db"=>$this->_config->couchdb->db));         
         }         
         $this->view->docs = $result->toArray();

    }

    public function logAction()
    {
          $logger = new Zend_Log();
          $logger->addWriter(new App_Log_Writer_CouchDb($this->_config->couchdb->db));
          echo "Logged action";
          $logger->log("Testovani chyba", Zend_Log::ERR);
    }


}

