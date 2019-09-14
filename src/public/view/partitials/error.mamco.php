<?php
# use Controllers\Auth\Auth as User;
# use Controllers\Modules\FrontEnd\FrontEnd as Obj;
# GLOBAL $database;

?>
<script>
</script>
<div class="container">
  <br>
  <br>
  <br>
  <br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="panel panel-danger">
        <div class="panel-heading">
          <h2 class="text-center">
            <span class="fa-stack fa-lg">
              <i class="fa fa-square-o fa-stack-2x" aria-hidden="true"></i>
              <i class="fa fa-info fa-stack-1x" aria-hidden="true"></i>
            </span>
          <small><?= $errtype ?? __('error');?> - <b><?= $errCode;?></b></small>
          </h2>
        </div>
        <div class="panel-body">
          <p><?= __('error.404.msg.try');?>:</p>

            <ul class="list-group">
              <li class="list-group-item"><?= __('error.trymsg1');?></li>
              <li class="list-group-item"><?= __('error.trymsg2');?>,
                <a href="<?= base_url().strtolower(__('contact-us'));?>"><b><?= __('contact.us');?></b></a> <?= __('error.trymsg3');?>.</li>
              <li class="list-group-item"><?= __('error.trymsg4');?> <a href="<?= base_url().strtolower(__('home'));?>"><?= __('our.a');?> <?= __('home.page.bold');?>&nbsp;&nbsp;&nbsp; <i class="fa fa-smile-o fa-2x" aria-hidden="true"></i></a></li>
              <?php if(isset($errMsg) && !empty($errMsg)) { ?>
              <li class="list-group-item"><?= $errMsg ?? '';?></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-2">
      </div>
    </div>
</div>