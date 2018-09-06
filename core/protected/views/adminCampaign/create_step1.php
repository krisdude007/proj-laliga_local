<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminCampaign/index.css');
 
Yii::app()->clientScript->registerScriptFile('/webassets/js/jquery.oauthpopup.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile('/core/webassets/js/adminCampaign/index.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('twitter','!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");',CClientScript::POS_END);
Yii::app()->clientScript->registerScript('google',"(function(){var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();",CClientScript::POS_END);
Yii::app()->facebook->initJs($output); // this initializes the Facebook JS SDK on all pages
Yii::app()->facebook->renderOGMetaTags(); // this renders the OG tags

?>

<div class="fab-page-content">

    <!-- flash messages -->
    <?php $this->renderPartial('/admin/_flashMessages', array()); ?>
    <!-- flash messages -->

     
    <div class="campaign_top_bar">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/campaign/campaign_manager_icon.png" />
        <a href='<?php echo $this->createUrl('/adminCampaign'); ?>' >Campaign Manager</a>
    </div>
     
    <div class="fab-container-fluid">
    	<div class='campaign_container'>
             <div class='campain_header'>
             	Get Started
             </div>
        
            <div class='campaign_step'>
                <span class="campaign_step1_selected"></span>
                <span class="campaign_step2_unselected"></span>
                <span class="campaign_step3_unselected"></span>
            </div> 
             
             
            <div class="campaign_subtitle">Connect Accounts</div>
            <div class="campaign_divider"></div>
            
            <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'campaign-form',
                    'enableAjaxValidation' => true,
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
            ?>
            <div class=' campaign_media_row '>
                <div>
                    <span class="campaign_media_button_facebook fbreg"><span class="campaign_media_row_text">Connected</span></span>
                    <span class="fbreg_on campaign_on_selected"></span>
                    <span class="fbreg_off campaign_off_unselected"></span>
                    <span class="campaign_social_media_email"></span>
                </div>
                <div>
                <!--     Don't have an account? <a href="" >Create One</a>  -->
                </div>
            	
            </div>
            <div class='campaign_media_row'>
                <div>
                    <span class="campaign_media_button_twitter twreg"><span class="campaign_media_row_text">Connected</span></span>
                    <span class="twreg_on campaign_on_selected"></span>
                    <span class="twreg_off campaign_off_unselected"></span>
                </div>
                <div>
                <!--     Don't have an account? <a href="" >Create One</a>  -->
                </div>
            	
            </div>
            <div class='campaign_media_row'>
                <span class="campaign_media_button_youtube"></span>
            	
            </div>
            <div class='campaign_media_row'>
                <span class="campaign_media_button_tumblr"></span>
            	
            </div>
            <div class='campaign_media_row'>
                <span class="campaign_media_button_google"></span>
            	
            </div>
            <div class="campaign_continue_button">
            	<input type="hidden" name="submit_step1" value='step1' />
                <?php echo CHtml::submitButton('Continue', array('class'=>'btn btn-primary btn-large')); ?>
            </div>
        
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<div id="fb-root"></div>
 
<script>
     
    $(document).ready(function() {
        $.ajaxSetup({ cache: true });
        $.getScript('//connect.facebook.net/en_UK/all.js', function(){
          FB.init({
            appId: '<?php echo Yii::app()->facebook->appId; ?>',
          });     
           
          FB.getLoginStatus(function(res){
           if( res.status == "connected" ){
               $('.fbreg .campaign_media_row_text').html('Connected');
               $('.fbreg_on').removeClass('campaign_on_unselected').addClass('campaign_on_selected');
               $('.fbreg_off').removeClass('campaign_off_selected').addClass('campaign_off_unselected');
               $('.campaign_media_button_facebook').css('cursor','auto');
               $('.fbreg_off').css('cursor','pointer');
               FB.api('/me', {fields: 'email'}, function(response) {
                   $('.campaign_social_media_email').html(response.email);
               });

           }   
          });
        });
    });
</script>

