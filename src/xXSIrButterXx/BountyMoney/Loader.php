<?php

namespace xXSIrButterXx\BountyMoney;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Config;
use pocketmine\Player;

class Loader extends PluginBase{

	public function onEnable(){
		$this->getLogger()->info("Hello World!");
		$this->getServer()->getPluginManager()->registerEvents(new BountyListener($this), $this);
	}


	public function onDisable(){
		$this->getLogger()->info("Bye");
	}

    public function createBounty($player, int $money){
        $contents =
            [	
			"KillMoney" => $money,
			"Message_to_player" => "You have recieved cash for killing a bountied player"
			];
			
			$c = new Config($this->getDataFolder().$layer->getName().".yml", Config::YAML, $contents);
	}
	
    public function bountyExists($player){
        return file_exists($this->getDataFolder().$player.".yml");
    }	
	
	public function getKillMoney($player){
		if(bountyExists($player) === true){
			$this->bountymoney = $this->getDataFolder().$player.".yml";
			$bountymoney = $this-bountymoney;
			$money = $bountymoney->get("KillMoney");
			return $money;
			
		}else{
			return null;
		}
	}
	
    public function deleteBounty($player){
        unlink($this->getDataFolder().$player->getName().".yml");
    }

	
}