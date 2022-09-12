<?php
use OsumiFramework\App\Component\Model\DiamondComponent;

foreach ($values['list'] as $i => $diamond) {
  $component = new DiamondComponent([ 'diamond' => $diamond ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
