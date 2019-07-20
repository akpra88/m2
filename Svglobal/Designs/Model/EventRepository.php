<?php

namespace Svglobal\Designs\Model;

use Svglobal\Designs\Model\ResourceModel\Event as ResourceEvent;
use Magento\Framework\Exception\CouldNotSaveException;
use Svglobal\Designs\Api\Data\EventSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Svglobal\Designs\Api\Data\EventInterfaceFactory;
use Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory as EventCollectionFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\SortOrder;
use Svglobal\Designs\Api\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Svglobal\Designs\Model\ResourceModel\Event
     */
    private $resource;

    /**
     * @var \Svglobal\Designs\Api\Data\EventFactory
     */
    private $eventFactory;

    /**
     * @var \Svglobal\Designs\Api\Data\EventInterfaceFactory
     */
    private $dataEventFactory;

    /**
     * @var \Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory
     */
    private $eventCollectionFactory;

    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var \Svglobal\Designs\Api\Data\EventSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @param ResourceEvent $resource
     * @param EventFactory $eventFactory
     * @param EventInterfaceFactory $dataEventFactory
     * @param EventCollectionFactory $eventCollectionFactory
     * @param EventSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceEvent $resource,
        EventFactory $eventFactory,
        EventInterfaceFactory $dataEventFactory,
        EventCollectionFactory $eventCollectionFactory,
        EventSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->eventFactory = $eventFactory;
        $this->eventCollectionFactory = $eventCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataEventFactory = $dataEventFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Svglobal\Designs\Api\Data\EventInterface $event
    ) {
        try {
            $event->getResource()->save($event);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Event: %1',
                $exception->getMessage()
            ));
        }
        return $event;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($eventId)
    {
        $event = $this->eventFactory->create();
        $event->getResource()->load($event, $eventId);
        if (!$event->getId()) {
            throw new NoSuchEntityException(__('Event with id "%1" does not exist.', $eventId));
        }
        return $event;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->eventCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Svglobal\Designs\Api\Data\EventInterface $event
    ) {
        try {
            $event->getResource()->delete($event);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Event: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($eventId)
    {
        return $this->delete($this->getById($eventId));
    }
}
