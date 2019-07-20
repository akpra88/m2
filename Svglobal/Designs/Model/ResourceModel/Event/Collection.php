<?php

namespace Svglobal\Designs\Model\ResourceModel\Event;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public $_idFieldName = 'event_id';
   
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Svglobal\Designs\Model\Event',
            'Svglobal\Designs\Model\ResourceModel\Event'
        );
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('event_id', 'eventname');
    }
}
