<?php

namespace sao\boss;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\entity\Entity;
use pocketmine\entity\Skin;
use pocketmine\math\Vector3;
use sao\data\Data;
use sao\SAOPlayer;

class BossManager {

    /** @var Data $plugin */
    private $plugin;

    /**
     * BossManager constructor.
     * @param Data $plugin
     */
    public function __construct(Data $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param SAOPlayer $sender
     * @param int $floor
     * @param array $data
     */
    public function generateBOSS(SAOPlayer $sender, $floor, array $data): void {
        $nbt = Entity::createBaseNBT(new Vector3($sender->getX(), $sender->getY(), $sender->getZ()));
        $nbt->setTag($sender->namedtag->getCompoundTag('Skin'));
        $npc = new Boss($sender->getLevel(), $nbt);
        $npc->setNameTagVisible(true);
        $npc->setNameTagAlwaysVisible(true);
        $npc->yaw = $sender->getYaw();
        $npc->pitch = $sender->getPitch();
        $npc->setSkin(new Skin("boss" . $floor, $this->getPlugin()->getSkin(Data::ENTITY_BOSS, "Boss" . $floor)));
        $npc->setNameTag("§l§aBOSS " . $floor);
        $npc->setMaxHealth($data["health"]);
        $npc->spawnToAll();
    }

    /**
     * @return Data
     */
    public function getPlugin(): Data {
        return $this->plugin;
    }
}