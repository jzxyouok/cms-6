<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'group_id')->widget(
    \skeeks\widget\chosen\Chosen::className(), [
            'items' => \yii\helpers\ArrayHelper::map(
                 \skeeks\cms\models\UserGroup::find()->asArray()->all(),
                 "id",
                 "groupname"
             ),
    ]);
?>

<?= $form->field($model, 'username')->textInput(['maxlength' => 12]) ?>
<?= $form->field($model, 'name')->textInput(); ?>
<?= $form->field($model, 'city')->textInput(); ?>
<?= $form->field($model, 'address')->textInput(); ?>
<?= $form->field($model, 'info')->textarea(); ?>
<?= $form->field($model, 'status_of_life')->textarea(); ?>



<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

