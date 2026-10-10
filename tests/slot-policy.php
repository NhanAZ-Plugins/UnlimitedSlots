<?php

declare(strict_types=1);

use NhanAZ\UnlimitedSlots\Main;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\network\query\QueryInfo;
use pocketmine\player\Player;
use pocketmine\player\PlayerInfo;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

$source = $argv[1] ?? null;
if ($source === null || !is_file($source . '/vendor/autoload.php')) {
	fwrite(STDERR, "Usage: php tests/slot-policy.php /path/to/Axolotl-PM-source\n");
	exit(2);
}
require $source . '/vendor/autoload.php';
require dirname(__DIR__) . '/src/NhanAZ/UnlimitedSlots/Main.php';

final class UnlimitedSlotsTestServer extends Server {
	/** @var list<Player> */
	public array $testPlayers = [];

	/** @return Player[] */
	public function getOnlinePlayers() : array {
		return $this->testPlayers;
	}
}

final class UnlimitedSlotsTestPlayer extends Player {
	public function __destruct() {}
}

$server = (new ReflectionClass(UnlimitedSlotsTestServer::class))->newInstanceWithoutConstructor();
$plugin = (new ReflectionClass(Main::class))->newInstanceWithoutConstructor();
(new ReflectionProperty(PluginBase::class, 'server'))->setValue($plugin, $server);
$player = (new ReflectionClass(UnlimitedSlotsTestPlayer::class))->newInstanceWithoutConstructor();

foreach ([0, 1, 20] as $count) {
	$server->testPlayers = array_fill(0, $count, $player);
	$query = (new ReflectionClass(QueryInfo::class))->newInstanceWithoutConstructor();
	$query->setMaxPlayerCount(20);
	$plugin->onQueryRegenerate(new QueryRegenerateEvent($query));
	if ($query->getMaxPlayerCount() !== $count + 1) {
		throw new RuntimeException('Query did not advertise exactly one open slot');
	}
}

$info = (new ReflectionClass(PlayerInfo::class))->newInstanceWithoutConstructor();
$reasons = new PlayerPreLoginEvent($info, '127.0.0.1', 19132, true);
$reasons->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_SERVER_FULL, 'full');
$reasons->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_SERVER_WHITELISTED, 'whitelist');
$reasons->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_BANNED, 'banned');
$plugin->onPreLogin($reasons);
if ($reasons->isKickFlagSet(PlayerPreLoginEvent::KICK_FLAG_SERVER_FULL)
	|| !$reasons->isKickFlagSet(PlayerPreLoginEvent::KICK_FLAG_SERVER_WHITELISTED)
	|| !$reasons->isKickFlagSet(PlayerPreLoginEvent::KICK_FLAG_BANNED)
	|| $reasons->isAllowed()) {
	throw new RuntimeException('Prelogin must remove only the server-full kick reason');
}

$fullOnly = new PlayerPreLoginEvent($info, '127.0.0.1', 19132, true);
$fullOnly->setKickFlag(PlayerPreLoginEvent::KICK_FLAG_SERVER_FULL, 'full');
$plugin->onPreLogin($fullOnly);
if (!$fullOnly->isAllowed()) {
	throw new RuntimeException('A server-full player should be allowed to continue login');
}

echo "PASS: query slot count and prelogin kick flag policy\n";
