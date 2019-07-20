<?php

namespace Svglobal\Designs\Api\Data;

interface EventInterface {

    const EVENTNAME = 'eventname';
    const EVNTIDS = 'evntids';
    const EVENT_ID = 'event_id';
    const IMAGE = 'image';
    const STATUS = 'status';
    const GROUPCODE = 'groupcode';
    const WIDTH = 'width';

    /**
     * Get Event Id
     * @return string|null
     */
    public function getEventId();

    /**
     * Set Event Id
     * @param string $event_id
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setEventId($eventId);

    /**
     * Get eventname
     * @return string|null
     */
    public function getEventname();

    /**
     * Set eventname
     * @param string $eventname
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setEventname($eventname);

    /**
     * Get groupcode
     * @return string|null
     */
    public function getGroupcode();

    /**
     * Set groupcode
     * @param string $groupcode
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setGroupcode($groupcode);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setImage($image);

    /**
     * Get width
     * @return string|null
     */
    public function getWidth();

    /**
     * Set width
     * @param string $width
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setWidth($width);

    /**
     * Get evntids
     * @return string|null
     */
    public function getEvntids();

    /**
     * Set evntids
     * @param string $evntids
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setEvntids($evntids);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Svglobal\Designs\Api\Data\EventInterface
     */
    public function setStatus($status);
}
