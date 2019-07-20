<?php

namespace Svglobal\Designs\Controller\Adminhtml\Event;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Upload
 */
class Upload extends \Magento\Backend\App\Action {

    /**
     * Image uploader
     *
     * @var \Svglobal\Designs\Model\ImageUploader
     */
    public $imageUploader;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Svglobal\Designs\Model\ImageUploader $imageUploader
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \Svglobal\Designs\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * Check admin permissions for this controller
     *
     * @return boolean
     */
    public function _isAllowed() {
        return $this->_authorization->isAllowed('Svglobal_Designs::Designs');
    }

    /**
     * Upload Event controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('image');

            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }

}

