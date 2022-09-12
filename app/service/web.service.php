<?php declare(strict_types=1);

namespace OsumiFramework\App\Service;

use OsumiFramework\OFW\Core\OService;
use OsumiFramework\OFW\DB\ODB;
use OsumiFramework\App\Model\Grid;

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
}
