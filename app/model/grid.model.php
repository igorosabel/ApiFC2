<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class Grid extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */
	function __construct() {
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id unico para cada seccion'
			],
			'map' => [
				'type'     => OModel::TEXT,
				'size'     => 1,
				'comment'  => 'Mapa norte (n) o mapa sur (s)',
				'nullable' => false
			],
			'grid_col' => [
				'type'     => OModel::NUM,
				'comment'  => 'Numero de columna de la seccion en el mapa completo',
				'nullable' => false
			],
      'grid_row' => [
				'type'     => OModel::NUM,
				'comment'  => 'Numero de linea de la seccion en el mapa completo',
				'nullable' => false
			],
      'num' => [
				'type'     => OModel::NUM,
				'comment'  => 'Numero de diamantes en la seccion',
				'nullable' => false
			],
      'picked' => [
				'type'     => OModel::NUM,
				'comment'  => 'Numero de diamantes recogidos',
				'nullable' => false
			],
      'completed' => [
				'type'     => OModel::BOOL,
				'comment'  => 'Indica si una seccion esta completada 1 o no 0',
				'nullable' => false,
        'default'  => false
			],
			'created_at' => [
				'type'    => OModel::CREATED,
				'comment' => 'Fecha de creación del registro'
			],
			'updated_at' => [
				'type'    => OModel::UPDATED,
				'comment' => 'Fecha de última modificación del registro'
			]
		];

		parent::load($model);
	}

  private ?array $diamonds = null;

	/**
	 * Devuelve la lista de diamantes de una sección
	 *
	 * @return array Lista de diamantes
	 */
	public function getDiamonds(): array {
		if (is_null($this->diamonds)){
			$this->loadDiamonds();
		}
		return $this->diamonds;
	}

	/**
	 * Guarda la lista de diamantes de una sección
	 *
	 * @param array $diamonds Lista de diamantes
	 *
	 * @return void
	 */
	public function setDiamonds(array $diamonds): void {
		$this->diamonds = $diamonds;
	}

	/**
	 * Carga la lista de diamantes de una sección
	 *
	 * @return void
	 */
	public function loadDiamonds(): void {
		$sql = "SELECT * FROM `diamond` WHERE `id_grid` = ?";
		$this->db->query($sql, [$this->get('id')]);
		$list = [];

		while ($res=$this->db->next()) {
			$diamond = new Diamond();
			$diamond->update($res);

			array_push($list, $diamond);
		}

		$this->setDiamonds($list);
	}
}
