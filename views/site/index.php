<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="mainpage-centralform">
        <img src="../img/so-big.png" class="so-logo">
        <h2>Search questions and answers</h2>
        <div class="row">
            <form action="<?=Url::toRoute('/site/questions');?>">
                <div class="col-lg-12">
                    <div class="input-group col-md-12">
                        <input name="query" type="text" class="search-query form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <span class=" glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /.col-lg-6 -->
            </form>
        </div>
    </div>
</div>
