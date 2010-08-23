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
         $this->view->messages = $this->_helper->flashMessenger->getMessages();
    }

    public function logAction()
    {
          $logger = new Zend_Log();
          $format = '%timestamp% %priorityName% (%priority%): '.
            '[%module%] [%controller%] %message%';                                                                                                
          $formatter = new Zend_Log_Formatter_Simple($format);
          
          $writer = new App_Log_Writer_CouchDb($this->_config->couchdb->db);
          $writer->setFormatter($formatter);

          $logger->addWriter($writer);
          $logger->setEventItem('module', $this->getRequest()->getModuleName());
          $logger->setEventItem('controller', $this->getRequest()->getControllerName());                        
          $logger->log("Testovani chyba", Zend_Log::NOTICE);
          $this->_helper->flashMessenger->addMessage('Log item saved');
          $this->_helper->redirector('index');
    }


}

