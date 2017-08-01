<?php

namespace xXSIrButterXx\BountyMoney;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\TextFormat as C;
use onebone\economyapi\EconomyAPI;


class BountyListener implements Listener{
	
	/** @var Loader */
	private $plugin;
	
	
	public function __construct(Loader $owner){
		$this->plugin = $owner;
	}
	public function onDeath(PlayerDeathEvent $event) {
		$cause = $event->getEntity()->getLastDamageCause();
		if($cause instanceof EntityDamageByEntityEvent) {
			$player = $event->getEntity();
			$killed = $player->getName();
			$lowname = strtolower($killed);
			$killer1 = $event->getEntity()->getLastDamageCause()->getDamager();
			$killer2 = $killer1->getName();
			if($player instanceof Player){
				if($this->bountyExists($lowname)){
					$moneyy = $this->plugin->getKillMoney($lowname);
					$killer1->sendMessage("Bounty-> By killing $killed you have  earned $moneyy");
					EconomyAPI::getInstance()->addMoney($killer1->getName(), $moneyy);
					$this->plugin->deleteBounty($lowname);
				}
			}
		}
	}
}