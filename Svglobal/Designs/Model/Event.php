<?php

namespace Svglobal\Designs\Model;

use Svglobal\Designs\Api\Data\EventInterface;

class Event extends \Magento\Framework\Model\AbstractModel implements EventInterface {

    /**
     * @return void
     */
    public function _construct() {
        $this->_init('Svglobal\Designs\Model\ResourceModel\Event');
    }

    /**
     * Get Event Id
     * @return string
     */
    public function getEventId() {
        return $this->getData(self::EVENT_ID);
    }

    /**
     * Set Event Id
     * @param string $eventId
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setEventId($eventId) {
        return $this->setData(self::EVENT_ID, $eventId);
    }

    /**
     * Get eventname
     * @return string
     */
    public function getEventname() {
        return $this->getData(self::EVENTNAME);
    }

    /**
     * Set eventname
     * @param string $eventname
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setEventname($eventname) {
        return $this->setData(self::EVENTNAME, $eventname);
    }

    /**
     * Get groupcode
     * @return string
     */
    public function getGroupcode() {
        return $this->getData(self::GROUPCODE);
    }

    /**
     * Set groupcode
     * @param string $groupcode
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setGroupcode($groupcode) {
        return $this->setData(self::GROUPCODE, $groupcode);
    }

    /**
     * Get image
     * @return string
     */
    public function getImage() {
        return $this->getData(self::IMAGE);
    }

    /**
     * Set image
     * @param string $image
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setImage($image) {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Get width
     * @return string
     */
    public function getWidth() {
        return $this->getData(self::WIDTH);
    }

    /**
     * Set width
     * @param string $width
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setWidth($width) {
        return $this->setData(self::WIDTH, $width);
    }

    /**
     * Get evntids
     * @return string
     */
    public function getEvntids() {
        return $this->getData(self::EVNTIDS);
    }

    /**
     * Set evntids
     * @param string $evntids
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setEvntids($evntids) {
        return $this->setData(self::EVNTIDS, $evntids);
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus() {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setStatus($status) {
        return $this->setData(self::STATUS, $status);
    }

}
