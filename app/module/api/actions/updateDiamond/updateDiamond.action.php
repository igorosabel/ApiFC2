<?php declare(strict_types=1);

namespace OsumiFramework\App\Module\Action;

use OsumiFramework\OFW\Routing\OModuleAction;
use OsumiFramework\OFW\Routing\OAction;
use OsumiFramework\OFW\Web\ORequest;

#[OModuleAction(
	url: '/update-diamond',
	services: ['web']
)]
class updateDiamondAction extends OAction {
	/**
	 * ¡La nueva acción <strong>updateDiamond</strong> funciona!
	 *
	 * @param ORequest $req Request object with method, headers, parameters and filters used
	 * @return void
	 */
	public function run(ORequest $req):void {
		$status = 'ok';
		$id     = $req->getParamInt('id');

		if (is_null($id)) {
			$status = 'error';
		}

		if ($status=='ok') {
			$status = $this->web_service->updateDiamond($id);
		}

		$this->getTemplate()->add('status', $status);
	}
}
