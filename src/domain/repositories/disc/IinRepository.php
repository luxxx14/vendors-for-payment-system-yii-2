<?php

namespace yii2woop\profile\domain\repositories\disc;

use yii2woop\profile\domain\entities\ProfileEntity;
use yii2lab\domain\repositories\ActiveDiscRepository;

class IinRepository extends ActiveDiscRepository {
	
	public $table = 'iin';

	public function forgeEntity($data, $class = null) {
		return parent::forgeEntity($data, ProfileEntity::className());
	}

}