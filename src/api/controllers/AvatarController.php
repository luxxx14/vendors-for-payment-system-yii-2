<?php

namespace yii2woop\profile\api\controllers;

use yii2lab\helpers\Behavior;
use  yii2woop\account\domain\forms\AvatarForm;
use yii2lab\domain\rest\Controller;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use Yii;

class AvatarController extends Controller {
	
	public $serviceName = 'profile.avatar';
	
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
	public function behaviors() {
		return [
			'authenticator' => Behavior::apiAuth(),
		];
	}
	
	public function actionView() {
		return $this->service->getSelf();
	}
	
	public function actionDelete() {
		$this->service->deleteSelf();
		Yii::$app->response->setStatusCode(204);
	}
	
	public function actionUpdate() {
		$model = new AvatarForm();
		if(!$model->validate()) {
			return $model;
		}
		try {
			$this->service->updateSelf($model->imageFile);
			Yii::$app->response->setStatusCode(201);
		} catch(UnprocessableEntityHttpException $e) {
			return $e->getErrors();
		}
	}
	
}