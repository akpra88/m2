<?php

namespace Svglobal\Designs\Controller\Adminhtml\Event;

class MassDelete extends \Magento\Backend\App\Action {

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    private $filter;

    /**
     * @var \Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
    \Magento\Ui\Component\MassAction\Filter $filter, \Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory $collectionFactory, \Magento\Backend\App\Action\Context $context
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @var mass delete action 
     */
    public function execute() {
        try {
            $logCollection = $this->filter->getCollection($this->collectionFactory->create());
            $itemsDeleted = 0;
            foreach ($logCollection as $item) {
                $item->delete();
                $itemsDeleted++;
            }
            $this->messageManager->addSuccess(__('A total of %1 event(s) were deleted.', $itemsDeleted));
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('designs/event');
    }

}
