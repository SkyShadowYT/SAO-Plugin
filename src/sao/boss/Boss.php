<?php

namespace sao\boss;

use pocketmine\entity\Human;

class Boss extends Human {

    /** @var int $floor */
    private $floor;

    /**
     * @return int
     */
    public function getFloor(): int {
        return $this->floor;
    }

    /**
     * @param int $floor
     */
    public function setFloor(int $floor): void {
        $this->floor = $floor;
    }
}