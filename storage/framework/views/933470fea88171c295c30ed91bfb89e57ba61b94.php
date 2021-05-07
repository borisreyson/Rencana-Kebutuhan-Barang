
<?php $__env->startSection('title'); ?>
ABP-system | Inbox
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!-- bootstrap-wysiwyg -->
 <?php echo $__env->make('layout.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <link href="<?php echo e(asset('/vendors/google-code-prettify/bin/prettify.min.css')); ?>" rel="stylesheet">
<style>
.ui-autocomplete { position: absolute; cursor: default;z-index:9999 !important;height: 100px;

            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            }  

.ck-editor__editable {
    min-height: 90px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<body class="nav-md">
<div class="container body">
<div class="main_container">
<?php echo $__env->make('layout.nav',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layout.top',["getUser"=>$getUser], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<!-- page content -->

<div class="right_col" role="main">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Inbox</h2>                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
<button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>
                  <ul class="list-unstyled msg_list row">

<?php $__currentLoopData = $inbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($v->flag_message ==0): ?>
                    <li style="border: 1px solid rgba(0,0,0,0.1);">
                      <a href="<?php echo e(url('/kabag/inbox/'.bin2hex($v->id_pesan))); ?>.message" class="row">
                        <label class="col-xs-12">
                         <?php echo e($v->nama_lengkap); ?>

                         <span class="pull-right text-right"><?php echo e(date("h.i A",strtotime($v->timelog))); ?>

                          <br><?php echo e(date("d F Y",strtotime($v->timelog))); ?></span>
                        </label>
                        <div class="message col-xs-12" style="float: left;text-align: left;">
                            <?php if(strlen($v->pesan_teks)>100){ ?>
                              <?php echo strip_tags(substr($v->pesan_teks,0,100), '<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo strip_tags($v->pesan_teks,"<br>");?>
                            <?php } ?>
                        </div>
                      </a>
                    </li>
<?php else: ?>
                    <li style="background-color: #fff;border: 1px solid  rgba(0,0,0,0.1)">
                      <a href="<?php echo e(url('/kabag/inbox/'.bin2hex($v->id_pesan))); ?>.message" class="row">
                        <label class="col-xs-12">
                         <?php echo e($v->nama_lengkap); ?>

                         <span class="pull-right text-right"><?php echo e(date("h.i A",strtotime($v->timelog))); ?>

                          <br><?php echo e(date("d F Y",strtotime($v->timelog))); ?></span>
                        </label>
                        <div class="message col-xs-12" style="float: left;text-align: left;">
                            <?php if(strlen($v->pesan_teks)>100){ ?>
                              <?php echo strip_tags(substr($v->pesan_teks,0,100), '<br>');?> ...
                            <?php }else{ ?> 
                              <?php echo strip_tags($v->pesan_teks,"<br>");?>
                            <?php } ?>
                        </div>
                      </a>
                    </li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                  <div class="col-xs-12 text-center">
                    <?php echo e($inbox->links()); ?>

                  </div>
                </div>
              </div>
            </div>

<!---//--->
<?php if(isset($pesan)): ?>
            <div class="col-md-9">
              <div class="x_panel">
                <div class="x_title">
                  <h2>
                  <div class="sender-info">
                    <div class="row">
                      <div class="col-md-12">
                        <small>
                        <strong><?php echo e(isset($pesan->nama_lengkap) ? $pesan->nama_lengkap : ""); ?>


                        </strong>
                        To
                        <strong><?php if($pesan->user_to==$_SESSION['username']): ?> me <?php endif; ?></strong>
                        </small>
                      </div>
                    </div>
                  </div></h2>
                  
                      <div class="pull-right">                        
                              <div class="btn-group">
                                <button class="btn btn-sm btn-primary" type="button" id="reply"><i class="fa fa-reply"></i> Reply</button>
                                <!---<button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>--->
                              </div>
                      </div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-12"> 
                              <label class="control-label"><?php echo e(date("H:i A , d F Y",strtotime($pesan->timelog))); ?></label>
                              <h4><?php echo e(isset($pesan->no_rkb) ? $pesan->no_rkb : ""); ?></h4>
                              <h5><?php echo e(isset($pesan->part_name) ? $pesan->part_name : ""); ?></h5>
                             <div class="col-md-12"><?php echo $pesan->pesan_teks;?></div>

<input type="hidden" name="user_reply" id="user_reply" value="<?php echo e($pesan->nama_lengkap); ?>">
<input type="hidden" name="username_reply" id="username_reply" value="<?php echo e($pesan->user_from); ?>">
<input type="hidden" name="norkb_reply" id="norkb_reply" value="<?php echo e($pesan->no_rkb); ?>">
<input type="hidden" name="partname_reply" id="partname_reply" value="<?php echo e($pesan->part_name); ?>">
<input type="hidden" name="sub_reply" id="sub_reply" value="<?php echo e($pesan->subjek); ?>">
<input type="hidden" name="message_reply" id="message_reply" value="<?php echo e($pesan->pesan_teks); ?>">
<input type="hidden" name="timelog_reply" id="timelog_reply" value="<?php echo e(date('D , M d, Y ',strtotime($pesan->timelog)).' at '.date('h:i A ',strtotime($pesan->timelog))); ?>">
                  </div>
                  </div>
                </div>
              </div>
<?php endif; ?>
<!---//-->
</div>

<?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <!-- compose -->
    <div class="compose col-md-6 col-xs-12">
      <div class="compose-header">
        New Message
        <button type="button" class="close compose-close">
          <span>×</span>
        </button>
      </div>
      <div class="compose-body">
<form class="form-horizontal" action="" method="post">
<div id="alerts"></div><br>
<div class="form-group">
  <label class="col-md-2 col-xs-12"  for="user_to">
    <div class="form-control-static " >To</div>
  </label>
  <div class="col-md-10  col-xs-12">
  <input type="text" name="user_to" id="user_to" class="form-control" placeholder="To"  required>
  <input type="hidden" name="username_to" id="username_to" class="form-control" required>
  </div>
</div>
<div class="form-group">
  <label class="col-md-2  col-xs-12"  for="user_to">
    <div class="form-control-static " >No RKB</div>
  </label>
  <div class="col-md-10 col-xs-12">
  <input type="text" name="no_rkb" id="no_rkb" class="form-control" placeholder="Nomor RKB">
  </div>
</div>
<div class="form-group">
  <label class="col-md-2  col-xs-12"  for="user_to">
    <div class="form-control-static " >Part Name</div>
  </label>
  <div class="col-md-10 col-xs-12">
  <input type="text" name="part_name" id="part_name" class="form-control" placeholder="Part Name">
  </div>
</div>
<div class="form-group">
  <label class="col-md-2 col-xs-12 "  for="user_to">
    <div class="form-control-static " >Subjek</div>
  </label>
  <div class="col-md-10 col-xs-12">
  <input type="text" name="subjek" id="subjek" class="form-control" placeholder="Subkjek">
  </div>
</div>
<div class="form-group">
  <div class="col-md-12 col-xs-12">
  <textarea type="text" name="message" id="message" rows="3" class="form-control" placeholder="Pesan"></textarea>
  </div>
</div>
<?php echo e(csrf_field()); ?>

<input type="hidden" name="tree" id="tree">
<div class="compose-footer" style="">
  <button id="send" class="btn btn-sm btn-success" type="submit">Send</button>
  <button id="reset" class="btn btn-sm btn-default" type="reset">Reset</button>
  <button type="button" class="compose-close btn btn-sm btn-danger">
          <span>Close</span>
        </button>
</div>
</form>
    </div>
</div>
    <!-- /compose -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Datatables -->
    <!-- FastClick -->


<?php echo $__env->make('layout.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="<?php echo e(asset('/vendors/fastclick/lib/fastclick.js')); ?>"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="<?php echo e(asset('/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/jquery.hotkeys/jquery.hotkeys.js')); ?>"></script>
    <script src="<?php echo e(asset('/vendors/google-code-prettify/src/prettify.js')); ?>"></script>
    <script src="<?php echo e(asset('/ckeditor/ckeditor.js')); ?>"></script>

    <!-- jQuery autocomplete -->
    <script src="<?php echo e(asset('/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')); ?>"></script>

    <script>
      var editor1 = new CKEDITOR.replace( 'message' );
      $("#pictureBtn").click(function(){
        $("#img_file").click();
      });
      $("#compose").click(function() {
        $("#tree").val("parent");
        
      });
      $("#reply").click(function() {
        reply_to = $("#user_reply").val();
        reply_user = $("#username_reply").val();
        norkb_reply = $("#norkb_reply").val();
        partname_reply = $("#partname_reply").val();
        sub_reply = $("#sub_reply").val();
        message_reply = $("#message_reply").val();
        timelog_reply = $("#timelog_reply").val();

        $("#user_to").val(reply_to);
        $("#username_to").val(reply_user);    
        $("#no_rkb").val(norkb_reply);    
        $("#part_name").val(partname_reply);    
        $("#subjek").val(sub_reply);    
        var html_reply = "On "+timelog_reply+" PM "+reply_to+" wrote:";
        CKEDITOR.instances.message.setData("<p>--</p>"+html_reply+"<br>"+message_reply);
      });
      $(".close").click(function() {
        $("#reset").click();
      });
      $(".compose-close").click(function() {
        $("#reset").click();
      });

    function init_reply() {
    
      if( typeof ($.fn.slideToggle) === 'undefined'){ return; }
      console.log('init_compose');
      $('#reply').click(function(){
        $('.compose').slideToggle();
      });
      
    
    };
init_reply();


    function init_autocomplete() {      
      if( typeof ($.fn.autocomplete) === 'undefined'){ return; }
      // initialize autocomplete with custom appendTo
$('#user_to').autocomplete({ 
        serviceUrl: "<?php echo e(url('/get/username')); ?>",
          onSelect: function (suggestion) {
             $("#username_to").val(suggestion.data);
          }
      });

 $('#no_rkb').autocomplete({ 
        serviceUrl: "<?php echo e(url('/get/nomor/rkb')); ?>",
          onSelect: function (suggestion) {
          }
      });
      $('#part_name').mouseenter(function(){
          var _norkb = $('input[id=no_rkb]').val();
      $('#part_name').autocomplete({ 
        serviceUrl: "<?php echo e(url('/get/part/name')); ?>?no_rkb="+_norkb
      });
      });

      };
      init_autocomplete();
      
    </script>
<?php if(session('success')): ?>
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Success',
          text: "<?php echo e(session('success')); ?>",
          type: 'success',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<?php if(session('failed')): ?>
  <script>
    setTimeout(function(){
new PNotify({
          title: 'Failed',
          text: "<?php echo e(session('failed')); ?>",
          type: 'error',
          hide: true,
          styling: 'bootstrap3'
      });
    },500);
  </script>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>