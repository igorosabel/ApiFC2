<?php
use OsumiFramework\App\Component\Model\GridComponent;

foreach ($values['list'] as $i => $grid) {
  $component = new GridComponent([ 'grid' => $grid ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
