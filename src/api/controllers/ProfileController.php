<?php

namespace yii2woop\profile\api\controllers;

use yii2lab\domain\rest\Controller;
use yii2lab\helpers\Behavior;

class ProfileController extends Controller
{

	public $serviceName = 'profile.profile';

	public function format() {
		return [
			'sex' => 'boolean',
			'birth_date' => 'time:api',
		];
	}

	public function getSelf() {
		return $this->repository->getSelf();
	}
	
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'authenticator' => Behavior::apiAuth(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
			'view' => [
				'class' => 'yii2lab\domain\rest\IndexActionWithQuery',
				'serviceMethod' => 'getSelf',
			],
			'update' => [
				'class' => 'yii2lab\domain\rest\CreateAction',
				'serviceMethod' => 'updateSelf',
				'successStatusCode' => 204,
			],
		];
	}

}