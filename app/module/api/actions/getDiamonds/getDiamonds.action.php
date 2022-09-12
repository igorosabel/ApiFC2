<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;
use OsumiFramework\App\Component\Model\GridListComponent;

#[OModuleAction(
	url: '/get-diamonds',
	services: ['web']
)]
class getDiamondsAction extends OAction {
	/**
	 * Función para obtener la lista de diamantes
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$map    = $req->getParamString('map');
		$grid_list_component = new GridListComponent(['list' => []]);

		if (is_null($map)) {
			$status = 'error';
		}

		if ($status=='ok') {
			$list = $this->web_service->getGrids($map);

			$grid_list_component->setValue('list', $list);
		}

		$this->getTemplate()->add('status', $status);
		$this->getTemplate()->add('list',   $grid_list_component);
	}
}
