
<?php if (Yii::$app->session->hasFlash("error")): ?>
<?php
    $session = \Yii::$app->getSession();
    $session->setFlash("error", "Se a eliminado con Exito!"); ?>
    <?= \odaialali\yii2toastr\ToastrFlash::widget([
  "options" => [
      "closeButton"=> true,
      "debug" =>  false,
      "progressBar" => true,
      "preventDuplicates" => true,
      "positionClass" => "toast-top-right",
      "onclick" => null,
      "showDuration" => "100",
      "hideDuration" => "1000",
      "timeOut" => "2000",
      "extendedTimeOut" => "100",
      "showEasing" => "swing",
      "hideEasing" => "linear",
      "showMethod" => "fadeIn",
      "hideMethod" => "fadeOut"
      ]
  ]);?>
<?php endif; ?> <?php




use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Persona;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsultamedicoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = 'Medico - Consultas';
$this->params['breadcrumbs'][] = $this->title;
?>
</br>
<div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h3><?= Html::encode($this->title) ?></h3>
      </div>
          <div class="ibox-content">
              <table class="table table-hover">
                  <?= GridView::widget([
                      'dataProvider' => $dataProvider,
                 'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'IdPersona',
                            'value' => function ($model) {
                                return $model->persona->getFullName();
                            },
                         ],
                        [
                            'attribute' => 'IdModulo',
                            'value' => function ($model) {
                                return $model->modulo->NombreModulo;
                            },
                         ],

                              ['class' => 'yii\grid\ActionColumn',
                               'options' => ['style' => 'width:50px;'],
                               'template' => "{medical}"
                              ],
                          ],
                      ]); ?>
                                  </table>
          </div>
      </div>
    </div>
</div>
