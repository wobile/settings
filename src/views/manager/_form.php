<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="settings-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'section')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
</div>
