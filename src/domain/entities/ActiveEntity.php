<?php

namespace yii2woop\profile\domain\entities;

use domain\v4\active\entities\ProviderEntity;
use domain\v4\active\entities\TypeEntity;
use yii2lab\domain\BaseEntity;
use paulzi\jsonBehavior\JsonValidator;

class ActiveEntity extends BaseEntity {
	
	protected $id;
	protected $user_id;
	protected $active_id;
	protected $provider_id;
	protected $currency_code;
	protected $amount = 0;
	public $data;
	protected $provider;
	protected $type;
	
	public function fieldType() {
		return [
			'provider' => [
				'type' => ProviderEntity::className(),
			],
			'type' => [
				'type' => TypeEntity::className(),
			],
		];
	}
	
	public function rules() {
		return [
			[['active_id', 'data', 'provider_id', 'currency_code'], 'required'],
			[['active_id', 'provider_id', 'currency_code'], 'integer'],
			[['data'], JsonValidator::className()],
		];
	}
	
}
