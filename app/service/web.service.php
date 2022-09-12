<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\App\Model\Grid;
use OsumiFramework\App\Model\Diamond;

class webService extends OService {
	function __construct() {
		$this->loadService();
	}

	/**
	 * Obtiene la lista de secciones de un mapa
	 *
	 * @param string $map Mapa del que cargar las secciones, norte (n) o sur (s)
	 *
	 * @return array Lista de secciones
	 */
	public function getGrids(string $map): array {
		$db = new ODB();
		$sql = "SELECT * FROM `grid` WHERE `map` = ? ORDER BY `grid_row`, `grid_col`";
		$db->query($sql, [$map]);
		$ret = [];

		while ($res = $db->next()) {
			$grid = new Grid();
			$grid->update($res);
			$grid->loadDiamonds();

			array_push($ret, $grid);
		}

		return $ret;
	}

	/**
	 * Función para marcar un diamante como obtenido / no obtenido
	 * @param int $id Id del diamante a actualizar
	 *
	 * @return string Indica si la operación se ha realizado correctamente "ok" o no "error"
	 */
	public function updateDiamond(int $id): string {
		$diamond = new Diamond();
		$status = 'error';

		if ($diamond->find(['id' => $id])) {
			$diamond->set('picked', !$diamond->get('picked'));
			$diamond->save();

			$grid = new Grid();
			$grid->find(['id' => $diamond->get('id_grid')]);

			$db = new ODB();
			$sql = "SELECT COUNT(*) AS `NUM` FROM `diamond` WHERE `id_grid` = ? AND `picked` = 1";
			$db->query($sql, [$grid->get('id')]);
			$res = $db->next();

			$grid->set('picked', $res['NUM']);
			$completed = false;
			if ($grid->get('num') == $res['NUM']) {
				$completed = true;
			}
			$grid->set('completed', $completed);
			$grid->save();

			$status = 'ok';
		}

		return $status;
	}
}
