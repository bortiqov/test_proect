<?php

/* @var $this yii\web\View */



use backend\assets\admin\ThetaAdminAsset;

//print_r($prices);
//die();
//$this->title = 'My Yii Application';
$this->registerCssFile('/css/bootstrap.min.css', ['depends' => ThetaAdminAsset::class]);

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">Welkome to Perevod Consult admin panel</p>
    </div>

</div>
