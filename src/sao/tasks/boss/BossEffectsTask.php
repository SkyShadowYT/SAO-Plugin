<?php

namespace sao\tasks\boss;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\scheduler\Task;
use sao\boss\Boss;
use sao\SAO;

class BossEffectsTask extends Task {

    /** @var SAO $plugin */
    private $plugin;

    /**
     * BossEffectsTask constructor.
     * @param SAO $plugin
     */
    public function __construct(SAO $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param int $tick
     */
    public function onRun($tick) {
        foreach ($this->getPlugin()->getServer()->getLevels() as $level) {
            foreach ($level->getEntities() as $entity) {
                if ($entity instanceof Boss) {
                    foreach ($entity->getAbilities() as $ability) {
                        $entity->removeAllEffects();
                        $entity->addEffect(new EffectInstance(Effect::getEffect($ability), 40));
                    }
                }
            }
        }
    }

    /**
     * @return SAO
     */
    public function getPlugin(): SAO {
        return $this->plugin;
    }
}