<?php


class session
{
    private $idsession, $name, $numberallowed,$event, $startdate, $endDate;

    /**
     * @return mixed
     */
    public function getIdsession() {
        return $this->idsession;
    }

    /**
     * @param mixed $idsession
     */
    public function setIdsession($idsession) {
        $this->idsession = $idsession;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getNumberallowed() {
        return $this->numberallowed;
    }

    /**
     * @param mixed $numberallowed
     */
    public function setNumberallowed($numberallowed) {
        $this->numberallowed = $numberallowed;
    }

    /**
     * @return mixed
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event) {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * @param mixed $startdate
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;
    }

    /**
     * @return mixed
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }



}

?>