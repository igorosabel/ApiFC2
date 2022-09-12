<?php declare(strict_types=1);

namespace OsumiFramework\App\Model;

use OsumiFramework\OFW\DB\OModel;

class Diamond extends OModel {
	/**
	 * Configures current model object based on data-base table structure
	 */
	function __construct() {
		$model = [
			'id' => [
				'type'    => OModel::PK,
				'comment' => 'Id único para cada diamante'
			],
			'id_grid' => [
				'type'     => OModel::NUM,
				'comment'  => 'Id de la seccion a la que pertenece',
				'nullable' => false,
				'ref'      => 'grid.id'
			],
			'lat' => [
				'type'     => OModel::NUM,
				'comment'  => 'Latitud del diamante',
				'nullable' => false
			],
      'lon' => [
				'type'     => OModel::NUM,
				'comment'  => 'Longitud del diamante',
				'nullable' => false
			],
      'picked' => [
				'type'     => OModel::BOOL,
				'comment'  => 'Indica si el diamante ha sido cogido 1 o no 0',
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
}
