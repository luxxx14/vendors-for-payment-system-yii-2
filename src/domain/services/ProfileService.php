<?php

namespace yii2woop\profile\domain\services;

use yii2lab\domain\helpers\ErrorCollection;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\validator\helpers\IinParser;
use Yii;

use yii2lab\domain\services\ActiveBaseService;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class ProfileService extends ActiveBaseService {
	
	public function getSelf() {
		$login = Yii::$app->user->identity->login;
		try {
			$profile = $this->oneById($login);
		} catch(NotFoundHttpException $e) {
			$this->create(['login' => $login]);
			$profile = $this->oneById($login);
		}
		return $profile;
	}
	
	public function updateSelf($body) {
		$profile = $this->getSelf();
		$body = ArrayHelper::toArray($body);
		unset($body['avatar']);
		if(!empty($body['iin'])) {
			$profile->iin = $body['iin'];
			$profile->validate();
			/*$profileWithIin = $this->domain->repositories->iin->oneById($body['iin']);
			if($profileWithIin) {
				$body['first_name'] = $profileWithIin->first_name;
				$body['last_name'] = $profileWithIin->last_name;
			}*/
			$this->validateIin($body);
		}
		$this->updateById($profile->login, $body);
	}
	
	private function validateIin($body) {
		try {
			$profileEntityWithIin = $this->domain->repositories->iin->oneById($body['iin']);
		} catch(NotFoundHttpException $e) {
			$error = new ErrorCollection();
			$error->add('iin','profile/profile','iin_not_found');
			Throw new UnprocessableEntityHttpException($error);
		}
		$isValidFirstName = mb_strtoupper($body['first_name']) == mb_strtoupper($profileEntityWithIin->first_name);
		$isValidLastName = mb_strtoupper($body['last_name']) == mb_strtoupper($profileEntityWithIin->last_name);
		$error = new ErrorCollection;
		if(!$isValidFirstName) {
			$error->add('first_name', 'profile/profile', 'fake_first_name');
		}
		if(!$isValidLastName) {
			$error->add('last_name', 'profile/profile', 'fake_last_name');
		}
		$iin = IinParser::parse($body['iin']);
		if(!$body['sex'] == ($iin['sex'] == 'female')) {
			$error->add('sex', 'profile/profile', 'fake_sex');
		}
		$date = $iin['date']['year'] . '-' . $iin['date']['month'] . '-' . $iin['date']['day'];
		if($date != $body['birth_date']) {
			$error->add('birth_date', 'profile/profile', 'fake_birth_date');
		}
		if($error->count()) {
			throw new UnprocessableEntityHttpException($error);
		}
	}
	
}
