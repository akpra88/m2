<?php

namespace Svglobal\Designs\Ui\Component\Listing\Column;

class Event implements \Magento\Framework\Option\ArrayInterface
{
    private $groupCollection;

    public function __construct(
        \Svglobal\Designs\Model\ResourceModel\Event\CollectionFactory $groupCollection
    ) {
        $this->groupCollection = $groupCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $groupArr = [];
        $groups = $this->groupCollection->create();

        foreach ($groups as $group) {
            $groupArr[] = ['value' => $group->getEventId(), 'label' => __($group->Eventname())];
        }

        return $groupArr;
    }
}
