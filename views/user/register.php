<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Регистрация');
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'additional_contact')->textarea(['rows' => 6]) ?>

	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>
