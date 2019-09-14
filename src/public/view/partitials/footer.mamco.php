<?php
GLOBAL $sessions;
?>		
		</div>
		

		<script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" crossorigin="anonymous"></script>

		<!--script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" crossorigin="anonymous"></script-->

		<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.23/moment-timezone-with-data-2012-2022.min.js" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.23/moment-timezone.min.js" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.23/moment-timezone-utils.min.js" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/core-js/2.6.5/core.min.js" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/core-js/2.6.5/library.min.js" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/core-js/2.6.5/shim.min.js" crossorigin="anonymous"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js" crossorigin="anonymous"></script>
		<script async defer src="//maps.googleapis.com/maps/api/js?key=<?= (CFG_GOOGLEMAPKEY ?? '');?>"></script>
		<script src="https://apis.google.com/js/platform.js" async defer></script>

			<!--
		-->
		<!-- LIBRARY JS-->
		
		<script src="<?php echo resource('client/assets/libs/detect-browser/browser.js');?>"  crossorigin="anonymous"></script>
		<script src="<?php echo resource('client/assets/libs/smooth-scroll/jquery-smoothscroll.js');?>"  crossorigin="anonymous"></script>
		<script src="<?php echo resource('js/plugins/bootstrap-notify.js');?>"  crossorigin="anonymous"></script>
		<script src="<?php echo resource('js/jquery/jquery.serialize-object.min.js');?>"  crossorigin="anonymous"></script>

		<script src="<?php echo resource('client/assets/libs/selectbox/js/jquery.selectbox-0.2.js');?>" crossorigin="anonymous"></script>
		
		<!--script src="<?php //echo resource('client/assets/libs/parallax/jquery.data-parallax.min.js');?>"></script-->
		<!--script(src="assets/libs/parallax/jquery.data-parallax.min.js")-->

		
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@8.10.4/dist/sweetalert2.all.min.js"></script>

		<script src="//cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js" crossorigin="anonymous"></script>

		

		<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.min.js" crossorigin="anonymous"></script>
		<!--script src="<?php //echo resource('js/plugins/select2/js/select2.full.js');?>"></script-->


		<script src="<?php echo resource('client/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>" crossorigin="anonymous"></script>
		<script src="<?php echo resource('client/assets/libs/parallax/TweenMax.min.js');?>" crossorigin="anonymous"></script>
		<script src="<?php echo resource('client/assets/libs/parallax/jquery-parallax.js');?>" crossorigin="anonymous"></script>
		<script src="<?php echo resource('js/easing/jquery.easing.1.3.js'); ?>" crossorigin="anonymous"></script>
		<!--script src="//cdn.jsdelivr.net/npm/eonasdan-bootstrap-datetimepicker@4.17.47/build/js/bootstrap-datetimepicker.min.js" crossorigin="anonymous"></script-->
		<!--script src="<?php //echo resource('js/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>" defer></script-->
		<script src="<?php echo resource('js/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js'); ?>" crossorigin="anonymous"></script>
		<!--script src="<?php //echo resource('js/mdb/js/mdb.min.js'); ?>" defer></script-->

		<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/js/mdb.min.js"></script>


		<!--script src="//cdn.jsdelivr.net/npm/tooltip-js@3.0.0/dist/tooltip.min.js" crossorigin="anonymous"></script-->

		<script src="//cdn.jsdelivr.net/npm/ua-parser-js@0.7.19/src/ua-parser.min.js" crossorigin="anonymous"></script>
		<!--

		<script src="<?php //echo resource('js/mdb/js/popper.min.js'); ?>" defer></script-->

		<!--script src="<?php //echo resource('js/plugins/jquery-validation/dist/jquery.validate.min.js'); ?>" crossorigin="anonymous"></script-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" crossorigin="anonymous"></script>
		<!--script src="<?php //echo resource('client/assets/libs/wow-js/wow.min.js');?>"></script-->
		<script src="<?= js('fp2.js'); ?>" crossorigin="anonymous"></script>
		<script src="<?= js('jqc2.js'); ?>" crossorigin="anonymous"></script>

 
	
        <!-- CUSTTOM JS FOR PAGE-->
        <?php if(file_exists(RESOURCES.'client/assets/libs/bootstrap-datepicker/locales/bootstrap-datepicker.'.($sessions->get('locale_iso')).'.min.js')) { ?>
        	<script src="<?= resource('client/assets/libs/bootstrap-datepicker/locales/bootstrap-datepicker.'.($sessions->get('locale_iso')).'.min.js'); ?>" crossorigin="anonymous"></script>
        <?php } ?>		
        <?php if(file_exists(RESOURCES.'locales/validator/messages_'.($sessions->get('locale_iso')).'.js')) { ?>
        	<script src="<?= resource('locales/validator/messages_'.($sessions->get('locale_iso')).'.js'); ?>" crossorigin="anonymous"></script>
        <?php } else { ?>
			<script src="<?= resource('locales/validator/messages_es.js'); ?>" crossorigin="anonymous"></script>
        <?php } ?>

        <script src="<?= resource('js/custom-client.js'); ?>" crossorigin="anonymous"></script>
        <script type="text/javascript" crossorigin="anonymous">
		    
		</script>
        <script src="<?= resource('style/client/js/main.js'); ?>" crossorigin="anonymous"></script>
        <script type="text/javascript" crossorigin="anonymous">
		    //$.loadTrans("<?php //echo $sessions->get('locale_iso'); ?>");
		    if((typeof $.__config.date) != undefined) {
		    	$.__config.date = "<?= date('Y-m-d'); ?>";
		    }
		    setTimeout(() => {
		      $.__config.date = "<?= date('Y-m-d'); ?>";
		    }, 5000);
		</script>
        <!-- CUSTTOM JS FOR PAGE FROM ADDSCRIPTS-->
        <?php 
		if(defined('CFG_ADDSCRIPTS') && !empty(CFG_ADDSCRIPTS)) { 
			echo CFG_ADDSCRIPTS;
		}
		?>
		<script type="text/javascript">
			(function(d){
			  var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
			  js = d.createElement('script'); js.id = id; js.async = true;
			  js.src = "https://connect.facebook.net/<?= ( in_array($sessions->get('locale_iso'), ['es_CO', 'es']) || substr($sessions->get('locale_iso'), 0, 2) == 'es') ? 'es_LA' : 'en_US' ;?>/all.js";
			  d.getElementsByTagName('head')[0].appendChild(js);
			}(document));
			window.fbAsyncInit = function() {
			    FB.init({
			      appId      : '2043447709097481',
			      cookie     : true,
			      xfbml      : true,
			      version    : 'v3.3',
			      autoLogAppEvents : true
			    });
			        
			    FB.getLoginStatus(function(response) {
				    console.info('statusChangeCallback', response);
				});  
		  	};
		</script>
		<!-- END: CUSTTOM JS FOR PAGE FROM ADDSCRIPTS-->

		<!-- CUSTTOM JS FOR PAGES-->
		<?= $contentScripts ?? '';  ?>
		<!-- END: CUSTTOM JS FOR PAGES-->

    </body>
    
</html>
