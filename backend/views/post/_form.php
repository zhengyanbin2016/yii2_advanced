<?php

use common\models\Adminuser;
use common\models\Poststatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
    //first method
   /* $psObjs = Poststatus::find()->all();
    $allStatus = ArrayHelper::map($psObjs,'id','name');*/
    //second method
    /*$sql = 'select id,name from poststatus';
    $psArray = \Yii::$app->db->createCommand($sql)->queryAll();
    $allStatus = ArrayHelper::map($psArray,'id','name');*/
    //third method
//    $allStatus = (new \yii\db\Query())
//    ->select(['id','name'])
//    ->select('name,id')
//    ->from('poststatus')
//        ->indexBy('id')
//    ->column();

    //fourth method
    $allStatus = Poststatus::find()
    ->select(['name','id'])
    ->orderBy('position')
    ->indexBy('id')
    ->column();
//    echo '<hr/><pre>';
//    print_r($allStatus);
//    echo '</pre>';
//    exit(0);
    ?>
    <?= $form->field($model, 'status')->dropDownList($allStatus,['prompt' => '请选择状态']) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>
<?php
$allAuthors = Adminuser::find()
->select(['nickname','id'])
->indexBy('id')
->column();
//    echo '<hr/><pre>';
//    print_r($allAuthors);
//    echo '</pre>';
//    exit(0);
?>
    <?= $form->field($model, 'author_id')->dropDownList($allAuthors,['prompt' => '请选择作者']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
