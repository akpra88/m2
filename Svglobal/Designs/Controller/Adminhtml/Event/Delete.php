<?php

namespace Svglobal\Designs\Controller\Adminhtml\Event;

class Delete extends \Svglobal\Designs\Controller\Adminhtml\Event {

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('event_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('Svglobal\Designs\Model\Event');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the event.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['event_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a event to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }

}
