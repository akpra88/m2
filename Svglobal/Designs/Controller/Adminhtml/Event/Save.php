<?php

namespace Svglobal\Designs\Controller\Adminhtml\Event;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action {

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Magento\Customer\Api\GroupRepositoryInterface
     */
    protected $_groupRepository;

    /**
     * @var \Svglobal\Designs\Model\Event
     */
    private $evntModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Svglobal\Designs\Model\Event
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context, \Svglobal\Designs\Model\Event $evntModel, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magento\Customer\Api\GroupRepositoryInterface $groupRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->evntModel = $evntModel;
        $this->_groupRepository = $groupRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('event_id');

            $model = $this->evntModel->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Event no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $data = $this->_filterEventData($data);

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the event.'));
                $this->dataPersistor->clear('svglobal_designs_event');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['event_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager
                        ->addExceptionMessage($e, __('Something went wrong while saving the event.'));
            }

            $this->dataPersistor->set('svglobal_designs_event', $data);
            return $resultRedirect->setPath('*/*/edit', [
                        'event_id' => $this->getRequest()->getParam('event_id')
                            ]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * check uploaded docs
     *
     * @return data or null
     */
    public function _filterEventData(array $rawData) {
        $data = $rawData;
        if (isset($data['image'][0]['name'])) {
            $data['image'] = $data['image'][0]['name'];
        } else {
            $data['image'] = null;
        }
        return $data;
    }

    /**
     * @var customer group Id  
     *
     * @return Returns Customers Group Code
     */
    public function getEventName($groupId) {
        $group = $this->_groupRepository->getById($groupId);

        return $group->getCode();
    }

}
