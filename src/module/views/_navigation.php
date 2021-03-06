<?php

use yii\bootstrap\Nav;
use yii2lab\helpers\MenuHelper;

echo Nav::widget([
	'options' => [
		'id' => 'profile_navigation',
		'class' => 'nav nav-tabs',
	],
	'items' => MenuHelper::gen('yii2woop\profile\module\helpers\Menu'),
]);

?>

<style>
	#profile_navigation {
		margin-bottom: 15px;
	}
</style>
