<?php declare(strict_types=1);

namespace OsumiFramework\App\Module;

use OsumiFramework\OFW\Routing\OModule;

#[OModule(
	type: 'json',
	prefix: '/api',
	actions: ['getDiamonds', 'updateDiamond']
)]
class apiModule {}
