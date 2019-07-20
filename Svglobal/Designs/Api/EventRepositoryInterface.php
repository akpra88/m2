<?php

namespace Svglobal\Designs\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface EventRepositoryInterface {

    /**
     * Save Event
     * @param \Svglobal\Designs\Api\Data\EventInterface $event
     * @return \Svglobal\Designs\Api\Data\EventInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
    \Svglobal\Designs\Api\Data\EventInterface $event
    );

    /**
     * Retrieve Event
     * @param string $eventId
     * @return \Svglobal\Designs\Api\Data\EventInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($eventId);

    /**
     * Retrieve Event matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Svglobal\Designs\Api\Data\EventSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
    \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Event
     * @param \Svglobal\Designs\Api\Data\EventInterface $event
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
    \Svglobal\Designs\Api\Data\EventInterface $event
    );

    /**
     * Delete Event by ID
     * @param string $eventId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($eventId);
}
