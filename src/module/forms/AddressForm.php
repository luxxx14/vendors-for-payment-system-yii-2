<?php
/**
 * Created by PhpStorm.
 * User: asundetov
 * Date: 17.08.2017
 * Time: 11:52
 */

namespace yii2woop\profile\module\forms;


use Yii;
use yii2lab\domain\base\Model;



class AddressForm extends Model {
	
	
	public $region_id;
	public $city_id;
	public $district;
	public $street;
	public $home;
	public $apartment;
	public $post_code;
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'region_id' => Yii::t('profile/address', 'region_id'),
			'city_id' => Yii::t('profile/address', 'city_id'),
			'district' => Yii::t('profile/address', 'district'),
			'street'=> Yii::t('profile/address', 'street'),
			'home'=> Yii::t('profile/address', 'home'),
			'apartment'=> Yii::t('profile/address', 'apartment'),
			'post_code'=> Yii::t('profile/address', 'post_code'),
		];
	}
}