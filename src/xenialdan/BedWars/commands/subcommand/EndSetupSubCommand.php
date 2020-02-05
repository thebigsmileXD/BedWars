<?php

namespace xenialdan\BedWars\commands\subcommand;

use CortexPE\Commando\BaseSubCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use xenialdan\BedWars\Loader;
use xenialdan\gameapi\API;
use xenialdan\gameapi\Game;

class EndSetupSubCommand extends BaseSubCommand
{

    /**
     * This is where all the arguments, permissions, sub-commands, etc would be registered
     */
    protected function prepare(): void
    {
        $this->setPermission("bedwars.command.setup");
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "This command can only be used as a player");
            return;
        }
        /** @var Game $p */
        $p = Loader::getInstance();
        /** @var Player $sender */
        $arena = API::getArenaByLevel($p, $sender->getLevel());
        if (is_null($arena) || !API::isArenaOf($p, $arena->getLevel())) {
            $sender->sendMessage(TextFormat::RED . "It appears that you are not in an arena of " . $p->getPrefix());
            return;
        }
        $p->endSetupArena($sender);
    }
}
