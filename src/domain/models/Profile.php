<?php

namespace yii2woop\profile\domain\models;

use yii\db\ActiveRecord;

class Profile extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_profile}}';
	}
	
}
