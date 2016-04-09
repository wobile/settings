<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel wo\settings\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="settings-index">
    <?php print_r($dataProvider); ?>
    <?php print_r($searchModel); ?>
</div>