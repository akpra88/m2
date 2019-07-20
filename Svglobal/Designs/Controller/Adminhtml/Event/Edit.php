<?php

namespace Svglobal\Designs\Controller\Adminhtml\Event;

class Edit extends \Svglobal\Designs\Controller\Adminhtml\Event {

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Svglobal\Designs\Model\Event
     */
    private $eventModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Svglobal\Designs\Model\Event $eventModel
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Svglobal\Designs\Model\Event $eventModel
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->eventModel = $eventModel;
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('event_id');
        $model = $this->eventModel;

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This File no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->coreRegistry->register('svglobal_designs_event', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
                $id ? __('Edit Event') : __('New Event'), $id ? __('Edit Event') : __('New Event')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Event'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Event'));
        return $resultPage;
    }

}
