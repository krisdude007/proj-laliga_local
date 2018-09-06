<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminCampaign/index.css');
 
Yii::app()->clientScript->registerScriptFile('/core/webassets/js/adminCampaign/index.js', CClientScript::POS_END);


?>
 

<div class="fab-page-content">

    <!-- flash messages -->
    <?php $this->renderPartial('/admin/_flashMessages', array()); ?>
    <!-- flash messages -->

     
    <div class="campaign_top_bar">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/campaign/campaign_manager_icon.png" />
        <a href='<?php echo $this->createUrl('/adminCampaign'); ?>' >Campaign Manager</a>
    </div>
     
    <?php $this->renderPartial('/adminCampaign/_campaign_menu'); ?>
     
    
    
    
    <div class='fab-container-fluid'>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
    	'id'=>'campaign-grid',
    	'dataProvider'=>$campaign->search(),
    	'filter'=>$campaign,
    	'columns'=>array(
    		 
            array(
                'class'=>'CLinkColumn',
                'labelExpression'=>'!$data->status ? "Start" : "Stop"',
                'cssClassExpression'=>'!$data->status ? "btn-success" : "btn-danger"',
                'linkHtmlOptions' => array(
                    'class'=>'switch',
                ),
                'urlExpression'=>'Yii::app()->createUrl("/adminCampaign/changeStatus", array("id"=>$data->id))', 
                'htmlOptions'=> array(
                    'class'=>'btn',
                )
            ),
            'campaign_title', 
            'show_title', 
            'occurrence', 
            'day', 
            'show_airing_time', 
            'start_date', 
            'end_date',
            'tags',
            'hashtags',
    		array(
    			'class'=>'CButtonColumn',
    		),
    		array(
                'class'=>'CLinkColumn',
                'label'=>'Report',
                'urlExpression'=>'Yii::app()->createUrl("/adminCampaign/report", array("id"=>$data->id))',
                'htmlOptions'=> array(
                    'class'=>'btn btn-primary',
                ),
                'linkHtmlOptions' => array(
                    'style'=>'color:#ffffff',
                ),
            ),
    	),
    )); 
   
    ?>
    </div>
    
    	 
    <!-- END PAGE CONTAINER-->
</div>
<script type='text/javascript'>
jQuery(document).on('click','#campaign-grid a.switch',function(e) {
	e.preventDefault();
	if(!confirm('Are you sure you want to change this?')) return false;
	 
	jQuery('#campaign-grid').yiiGridView('update', {
		type: 'POST',
		url: jQuery(this).attr('href'),
		 
		success: function(data) {
			jQuery('#campaign-grid').yiiGridView('update');
			 
		},
		 
	});
	return false;
});

</script>