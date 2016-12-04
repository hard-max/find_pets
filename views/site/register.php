<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t('app', 'Registration');
?>
<div class="register col-md-6">

    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>

    <div class="user-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'email')->textInput() ?>

	    <?= $form->field($model, 'name')->textInput() ?>

	    <?= $form->field($model, 'password')->passwordInput() ?>

	    <?= $form->field($model, 'password_repeat')->passwordInput() ?>

	    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
          'mask' => '+380 (99) 999-99-99',
          'options' => [
              'class' => 'form-control'
            ],
          'clientOptions'=>[
              'clearIncomplete'=>true
            ]
          ]) 
        ?>

	    <?= $form->field($model, 'additional_contact')->textarea(['rows' => 4]) ?>

	    <div class="form-group">
	        <?= Html::submitButton(Yii::t('app', 'Register'), ['class' => 'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>
