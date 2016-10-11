<? $this->title = 'Генерация короткого URL'; ?>
<h1 style="padding-top: 50px" class="ui center aligned header"><?=$this->title?></h1>
<div class="ui container">
    <div class="ui fluid massive action input">
        <input name="Links[full_address]" class="url-place" type="text" placeholder="URL для генерации">
        <div class="ui button button-generate" data-href="<?=Yii::$app->urlManager->createUrl('short/index')?>">Генерировать</div>
        <div class="ui active loader button-generate-loader" style="display: none;"></div>
    </div>
    <!--template messages-->
    <div class="ui warning message message-error hidden"></div>
    <div class="ui message fluid message-success message-success-template hidden"></div>

    <div class="error-content"></div>
    <div class="success-content"></div>

</div>

