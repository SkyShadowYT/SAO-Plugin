<?php

namespace sao\data;

use pocketmine\utils\Config;
use sao\boss\BossManager;
use sao\npc\NpcManager;
use sao\SAO;
use sao\SAOPlayer;

class Data {

    /** @var SAO $plugin */
    private $plugin;

    /** @var NpcManager $npcManager */
    private $npcManager;

    /** @var BossManager $bossManager */
    private $bossManager;

    /** @var RoleManager $roleManager */
    private $roleManager;

    /** @var GuildManager $guildManager */
    private $guildManager;

    /** @var int ENTITY_NPC */
    const ENTITY_NPC = 0;

    /** @var int ENTITY_MOB */
    const ENTITY_MOB = 1;

    /** @var int ENTITY_BOSS */
    const ENTITY_BOSS = 2;

    /**
     * Data constructor.
     * @param SAO $plugin
     */
    public function __construct(SAO $plugin) {
        $this->plugin = $plugin;
        foreach (scandir($this->getPlugin()->getDataFolder()) as $files){
            $this->getPlugin()->saveResource($files);
        }
        $this->npcManager = new NpcManager($this);
        $this->bossManager = new BossManager($this);
        $this->roleManager = new RoleManager($this);
        $this->guildManager = new GuildManager($this);

        $this->loadAll();
    }

    /**
     * Load all the data.
     */
    public function loadAll(): void {
        $this->getRoleManager()->loadRoles();
        $this->getGuildManager()->loadGuilds();
    }

    /**
     * @param SAOPlayer $sender
     */
    public function createNewPlayer(SAOPlayer $sender): void {
        $profile = new Config($this->getPlugin()->getDataFolder() . "system/game/players/" . $sender->getName() . ",yml", Config::YAML);
        $data = [
            "Role" => "Player",
            "XP" => 0,
            "Level" => 0,
            "Money" => 0,
            "Guild" => "NONE",
            "Friends" => [],
        ];
        $profile->setAll($data);
        $profile->save();
    }

    /**
     * @param SAOPlayer $sender
     */
    public function loadPlayerData(SAOPlayer $sender): void {
        $profile = new Config($this->getPlugin()->getDataFolder() . "system/game/players/" . $sender->getName() . ",yml", Config::YAML);
        $role = $this->getRoleManager()->getRole($profile->get("Role"));
        $guild = $this->getGuildManager()->getGuild($profile->get("Guild"));

        $sender->setRole($role);
        $sender->setXp($profile->get("XP"));
        $sender->setLevelXP($profile->get("Level"));
        $sender->addMoney($profile->get("Money"));
        if ($guild != null) {
            $sender->setGuild($guild);
        }
        $sender->addFriend($profile->get("Friends"));
    }

    /**
     * @param string $type
     * @param string $name
     * @return string
     */
    public function getSkin($type, $name): string {
        $skin = null;
        switch ($type) {
            case self::ENTITY_NPC:
                $dir = $this->getPlugin()->getDataFolder() . "system/game/skins/npc/" . $name . ".png";
                $img = @imagecreatefrompng($dir);
                $bytes = '';
                $l = (int)@getimagesize($dir)[1];
                for ($y = 0; $y < $l; $y++) {
                    for ($x = 0; $x < 64; $x++) {
                        $rgba = @imagecolorat($img, $x, $y);
                        $a = ((~((int)($rgba >> 24))) << 1) & 0xff;
                        $r = ($rgba >> 16) & 0xff;
                        $g = ($rgba >> 8) & 0xff;
                        $b = $rgba & 0xff;
                        $bytes .= chr($r) . chr($g) . chr($b) . chr($a);
                    }
                }
                @imagedestroy($img);

                $skin = $bytes;
            break;

            case self::ENTITY_MOB:
                $dir = $this->getPlugin()->getDataFolder() . "system/game/skins/mob/" . $name . ".png";
                $img = @imagecreatefrompng($dir);
                $bytes = '';
                $l = (int)@getimagesize($dir)[1];
                for ($y = 0; $y < $l; $y++) {
                    for ($x = 0; $x < 64; $x++) {
                        $rgba = @imagecolorat($img, $x, $y);
                        $a = ((~((int)($rgba >> 24))) << 1) & 0xff;
                        $r = ($rgba >> 16) & 0xff;
                        $g = ($rgba >> 8) & 0xff;
                        $b = $rgba & 0xff;
                        $bytes .= chr($r) . chr($g) . chr($b) . chr($a);
                    }
                }
                @imagedestroy($img);

                $skin = $bytes;
            break;

            case self::ENTITY_BOSS:
                $dir = $this->getPlugin()->getDataFolder() . "system/game/skins/boss/" . $name . ".png";
                $img = @imagecreatefrompng($dir);
                $bytes = '';
                $l = (int)@getimagesize($dir)[1];
                for ($y = 0; $y < $l; $y++) {
                    for ($x = 0; $x < 64; $x++) {
                        $rgba = @imagecolorat($img, $x, $y);
                        $a = ((~((int)($rgba >> 24))) << 1) & 0xff;
                        $r = ($rgba >> 16) & 0xff;
                        $g = ($rgba >> 8) & 0xff;
                        $b = $rgba & 0xff;
                        $bytes .= chr($r) . chr($g) . chr($b) . chr($a);
                    }
                }
                @imagedestroy($img);

                $skin = $bytes;
            break;
        }

        return $skin;
    }

    /**
     * @return NpcManager
     */
    public function getNpcManager(): NpcManager {
        return $this->npcManager;
    }

    /**
     * @return BossManager
     */
    public function getBossManager(): BossManager {
        return $this->bossManager;
    }

    /**
     * @return SAO
     */
    public function getPlugin(): SAO {
        return $this->plugin;
    }
}