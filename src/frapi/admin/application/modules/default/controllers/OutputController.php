<?php
class OutputController extends Lupin_Controller_Base
{
    public function init()
    {
        $actions = array('index', 'sync', 'makedefault', 'disable', 'enable');
        $this->_helper->_acl->allow('admin', $actions);
        parent::init();
    }

    public function indexAction()
    {
        $model = new Default_Model_Output;
        $this->view->data = $model->getAll();
    }

    public function syncAction()
    {
        $model = new Default_Model_Output;
        $model->sync();
        $this->_redirect('/output');
    }

    public function makedefaultAction()
    {
        $model = new Default_Model_Output;
        $model->makeDefault($this->getRequest()->getParam('id'));
        apc_delete('Output.default-format');
        $this->_redirect('/output');
    }

    public function enableAction()
    {
        $model = new Default_Model_Output;
        $model->enable($this->getRequest()->getParam('id'));
        $this->_redirect('/output');
    }

    public function disableAction()
    {
        $model = new Default_Model_Output;
        $model->disable($this->getRequest()->getParam('id'));
        $this->_redirect('/output');
    }
}