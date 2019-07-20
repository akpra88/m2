<?php

/**
 * Svglobal\Designs\Block\Index
 */

namespace Svglobal\Designs\Block\Index;

class Index extends \Magento\Framework\View\Element\Template {

    /**
     * @var Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory
     */
    private $eventCollectionFactory;

    /**
     * @var \Magento\Framework\View\Element\Template\Context
     */
    private $storeManager;

    /**
     * Create constructor.
     * @param Magento\Framework\View\Element\Template\Context $context
     * @param Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory $eventCollectionFactory
     */
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context, \Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory $eventCollectionFactory
    ) {
        $this->eventCollectionFactory = $eventCollectionFactory;
        $this->storeManager = $context->getStoreManager();
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context);
    }

    /**
     * @var get collection for added events
     * @var return array
     */
    public function getEventCollection() {
        $eventCollection = $this->eventCollectionFactory->create();
        $eventCollection->addFieldToFilter('status', 1);
        $eventCollection->setOrder('event_id', 'ASC');
        return $eventCollection;
    }

    /**
     * @var return current store
     */
    public function getConfig($config) {
        return $this->scopeConfig->getValue(
                        $config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @var returns current store ID
     */
    public function getCurrentStore() {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * @var returns media folder URL
     */
    public function getMediaUrl() {
        $mediaUrl = $this->storeManager
                ->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $mediaUrl = $mediaUrl . 'evnt/tmp/image/';
        return $mediaUrl;
    }

}
