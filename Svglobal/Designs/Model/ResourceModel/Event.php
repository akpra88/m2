<?php

namespace Svglobal\Designs\Model\ResourceModel;

class Event extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct() {
        $this->_init('svglobal_events', 'event_id');
    }

}
