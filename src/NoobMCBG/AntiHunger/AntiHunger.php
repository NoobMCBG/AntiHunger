<?php

declare(strict_types=1);

namespace NoobMCBG\AntiHunger;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\player\PlayerExhaustEvent;

class AntiHunger extends PluginBase implements Listener {

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->checkUpdate();
	}

	public function checkUpdate(bool $isRetry = false): void {
        $this->getServer()->getAsyncPool()->submitTask(new CheckUpdateTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));
    }

	public function onHunger(PlayerExhaustEvent $ev){
		if($this->getConfig()->get("anti-hunger") == true){
			$ev->cancel();
		}
	}
}