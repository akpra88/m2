<?php

namespace Svglobal\Designs\Controller\Adminhtml;

abstract class Event extends \Magento\Backend\App\Action {

    const ADMIN_RESOURCE = 'Svglobal_Designs::top_level';

    private $coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     */
    public function initPage($resultPage) {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
                ->addBreadcrumb(__('Svglobal'), __('Svglobal'))
                ->addBreadcrumb(__('Event Configuration'), __('Event Configuration'));
        return $resultPage;
    }

}
