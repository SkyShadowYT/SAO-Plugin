<?php

namespace sao\npc;

use pocketmine\entity\Entity;
use pocketmine\entity\Skin;
use pocketmine\math\Vector3;
use sao\data\Data;
use sao\npc\types\ShopNpc;
use sao\SAOPlayer;

class NpcManager {

    /** @var Data $plugin */
    private $plugin;

    /** @var int NPC_SHOP */
    const NPC_SHOP = 0;

    /**
     * NpcManager constructor.
     * @param Data $plugin
     */
    public function __construct(Data $plugin) {
        $this->plugin = $plugin;
    }

    /**
     * @param SAOPlayer $sender
     * @param int $type
     */
    public function generateNPC(SAOPlayer $sender, $type): void {
        switch ($type) {
            case self::NPC_SHOP:
                $nbt = Entity::createBaseNBT(new Vector3($sender->getX(), $sender->getY(), $sender->getZ()));
                $nbt->setTag($sender->namedtag->getCompoundTag('Skin'));
                $npc = new ShopNpc($sender->getLevel(), $nbt);
                $npc->setNameTagVisible(true);
                $npc->setNameTagAlwaysVisible(true);
                $npc->yaw = $sender->getYaw();
                $npc->pitch = $sender->getPitch();
                $npc->setSkin(new Skin("shop", $this->getPlugin()->getSkin(Data::ENTITY_NPC, "Shop")));
                $npc->setNameTag("§l§bMERCHANT\n§r§aTAP TO BUY");
                $npc->spawnToAll();
            break;
        }
    }

    /**
     * @return Data
     */
    public function getPlugin(): Data {
        return $this->plugin;
    }
}