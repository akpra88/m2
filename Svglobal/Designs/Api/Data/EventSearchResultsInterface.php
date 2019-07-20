<?php

namespace Svglobal\Designs\Api\Data;

interface EventSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface {

    /**
     * Get Event list.
     * @return \Svglobal\Designs\Api\Data\EventInterface[]
     */
    public function getItems();

    /**
     * Set Items list.
     * @param \Svglobal\Designs\Api\Data\EventInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
