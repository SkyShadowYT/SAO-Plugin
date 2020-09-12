<?php

namespace sao;

use pocketmine\plugin\PluginBase;
use sao\data\Data;
use sao\tasks\boss\BossEffectsTask;

class SAO extends PluginBase {

    /** @var SAO $instance */
    private $instance;

    /** @var Data $data */
    private $data;

    /**
     * Load plugin data.
     */
    public function onLoad(): void {
        $this->instance = $this;
        $this->data = new Data($this);
        $this->getData()->loadAll();
        $this->getLogger()->notice("Loading data...!");
    }

    /**
     * Activate plugin Events, Tasks ect.
     */
    public function onEnable(): void {
        $this->getScheduler()->scheduleRepeatingTask(new BossEffectsTask($this), 20);
        $this->getLogger()->info("Successfully enabled!");
    }

    /**
     * Save plugin data.
     */
    public function onDisable(): void {
        $this->getLogger()->notice("Saving data...!");
        $this->getLogger()->info("Successfully disabled!");
    }

    /**
     * @return SAO
     */
    public function getInstance(): SAO {
        return $this->instance;
    }

    /**
     * @return Data
     */
    public function getData(): Data {
        return $this->data;
    }
}