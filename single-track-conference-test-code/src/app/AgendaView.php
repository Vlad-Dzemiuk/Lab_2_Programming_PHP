<?php

declare(strict_types=1);

namespace ConferenceApp;

class AgendaView
{
    /**
     * @var Agenda
     */
    private $agenda;

    /**
     * @param Agenda $agenda
     */
    public function __construct(Agenda $agenda)
    {
        $this->agenda = $agenda;
    }

    /**
     * @return int
     */
    public function getNumberOfSlots(): int
    {
        /**
         * @todo: Implement it
         */
        return $this->agenda->count();
    }

    /**
     * return int
     */
    public function getDurationInMinutes(): int
    {
        $result = 0;
        $slots = $this->agenda;
        $previousEndTime = null;
        foreach ($slots as $slot) {
            $result += $slot->getTimestamp() / 60;
            $currentEndTime = $slot->getStartAt()->getTimestamp() + $slot->getTimestamp();
            if ($previousEndTime !== null) {
                $gap = $slot->getStartAt()->getTimestamp() - $previousEndTime;
                if ($gap > 0) {
                    $result += $gap / 60;
                }
            }
            $previousEndTime = $currentEndTime;
        }
        return $result;
    }
}
