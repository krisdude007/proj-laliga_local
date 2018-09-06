<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery.gritter.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/chosen.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery.tagsinput.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/bootstrap-toggle-buttons.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/DT_bootstrap.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/ui.daterangepicker.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminReport/index.css');

// page specific js
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.blockui.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/chosen.jquery.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.modal.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.rating.pack.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.rating.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.tagsinput.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.toggle.buttons.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/daterangepicker.jQuery.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminReport/index.js', CClientScript::POS_END);
?>

<?php $this->renderPartial('/admin/_csrfToken', array()); ?>
<!-- BEGIN PAGE -->
<div class="fab-page-content">

    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top">
        <h2 class="fab-title floatLeft"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/reports-image.png">Reports
        </h2>
        <div class="floatLeft" style='margin-left:200px;'><h2>
        <?php if(in_array('HAS_QUESTION_REPORT', Yii::app()->params['features']) && (Yii::app()->user->isSuperAdmin() || Yii::app()->user->isSiteAdmin() || Yii::app()->user->hasPermission('adminreport'))): ?>
            <a href='/adminReport/videoQuestionReport'>Video Question Report</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href='/adminReport/tickerQuestionReport'>Ticker Question Report</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href='/adminReport/TvReport'>TV Report</a>&nbsp;&nbsp;/&nbsp;&nbsp;
        <?php endif; ?>
         <a href='/adminReport/RegisteredUserReport'>Registered User Report</a>
        </h2></div>

    </div>
    <?php $this->renderPartial('/admin/_flashMessages', array()); ?>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid" style="width: 2178px;">
        <div class="fab-row-fluid">
            <?php $this->renderPartial('_dateFilterLinks', array('startDate' => $startDate, 'endDate' => $endDate)); ?>
            <div style="clear:both;height:10px;"></div>
            <div class="fab-reports-container">
                <?php
                if (!empty($settings['report_show_users'])): ?>
                <div class="fab-row-fluid fab-third">
                    <div class="fab-portlet fab-box fab-grey">
                        <div class="fab-portlet-title">
                            <h4>Users</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
                            $rows = Array(
                                'Total' => number_format($usersTotal),
                                'Web' => number_format($usersWeb),
                                'Facebook' => number_format($usersFacebook),
                                'Mobile' => number_format($usersMobile),
                                'Twitter' => number_format($usersTwitter),
                            );
                            $links = Array(
                                'total_user',
                                'web_user',
                                'facebook_user',
                                'mobile_user',
                                'twitter_user',
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif;
                if(in_array('HAS_TICKER', Yii::app()->params['features']) && (isset($settings['report_show_tickers']) && $settings['report_show_tickers'] )): ?>
                <div class="fab-row-fluid fab-third">
                    <div class="fab-portlet fab-box fab-yellow">
                        <div class="fab-portlet-title">
                            <h4>Tickers</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
                            $rows = Array(
                                'Total Received' => number_format($tickerTotalCount),
                                'From Web' => number_format($tickerWebCount),
                                'From Facebook' => number_format($tickerFacebookCount),
                                'From Twitter' => number_format($tickerTwitterCount),
                                'From Mobile' => number_format($tickerMobileCount),
                            );
                            $links = Array(
                                'total_ticker',
                                'web_ticker',
                                'facebook_ticker',
                                'twitter_ticker',
                                'mobile_ticker',
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (isset($settings['report_show_social']) && $settings['report_show_social']): ?>
                <div class="fab-row-fluid fab-third">
<!--                    <div id="socialSearchBlocker">
                        Pending<br /><br />discovery<br /><br />discussion
                    </div>-->
                    <div class="fab-portlet fab-box fab-green">
                        <div class="fab-portlet-title">
                            <h4>Social Searches</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
//                            $rows = Array(
//                                'Total Received' => number_format($socialReceivedTotalCount),
//                                'From Facebook' => number_format($socialFacebookCount),
//                                'From Twitter' => number_format($socialTwitterCount),
//                            );
//                            $links = Array(
//                                'total_socialReceived',
//                                'facebook_socialRecevied',
//                                'twitter_socialRecevied',
//                            );
//                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
//                            $rows = Array(
//                                'Total Published' => number_format($socialPublishedTotalCount),
//                                'To Web' => number_format($socialToWebCount),
//                                'To Facebook' => number_format($socialToFacebookCount),
//                                'To TV' => number_format($socialToTvCount),
//                            );
//                            $links = Array(
//                                'total_socialPublished',
//                                'toweb_socialPublished',
//                                'tofacebook_socialPublished',
//                                'totv_socialPublished',
//                            );
//                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));

                            $rows = Array(
                                'Returned Tweets' => number_format($socialReturnedTwitterCount),
                                'Total Reach Tweets' => number_format($socialReturnedTwitterFollowing),
                                'Assigned Tweets' => number_format($socialAssignedTwitterCount),
                                'Accepted Tweets' => number_format($socialAcceptedTwitterCount),
                            );
                            $links = Array(
                                '#',
                                '#',
                                '#',
                                '#',
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));

                            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($settings['report_show_analytics']) && $settings['report_show_analytics']): ?>
                <div class="fab-row-fluid fab-third" style="border:1px solid #ff9900">
                    <?php  if(!Yii::app()->params['analytics']['projectId']) : ?>
                     <div id="analyticBlocker">
                        Tracking<br /><br />code<br /><br />pending
                    </div>
                    <?php endif;?>

                    <div class="fab-portlet fab-box" style="background-color:#ff9900;">
                        <div class="fab-portlet-title">
                            <h4>Analytics</h4>
                        </div>
                        <div style="background-color:white; padding-top:4px;">
                            <div id="startDateHidden" style="display:none;"></div>
                            <div id="endDateHidden" style="display:none;"></div>
                            <table>
                                <tbody>
                                    <tr class="columnHeaderBg">
                                        <td align="center" width="50%" id="startDateShown">
                                        <?php if(isset($analyticsData->startDate)): ?>
                                            From: <?php echo date("M d Y", strtotime($analyticsData->startDate)); ?>
                                        </td>
                                        <?php endif;?>
                                        <td align="center" width="50%" id="endDateShown">
                                        <?php if(isset($analyticsData->endDate)): ?>
                                            To: <?php echo date("M d Y", strtotime($analyticsData->endDate)); ?>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button id="GAdateRange">Choose a Date</button>
                                            <button id="gaButton" style="display:none; float:right;">Get Analytics</button>
                                            <div id="gaLoader"></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="gaResults" class="fab-portlet-body">
                            <?php
                            $rows = Array(
                                'Total Visits' => isset($analyticsData->visits) ? number_format($analyticsData->visits) : 0,
                                'Unique Visitors' => isset($analyticsData->uniqueVisitors) ?number_format($analyticsData->uniqueVisitors): 0,
                                'Pageviews' => isset($analyticsData->pageviews) ?number_format($analyticsData->pageviews) : 0,
                                'Pages Per Visit' => isset($analyticsData->pagesPerVisit) ?$analyticsData->pagesPerVisit : 0,
                                'Avg. Visit Duration' =>isset($analyticsData->avgTimeOnSite) ? $analyticsData->avgTimeOnSite : 0,
                                'Bounce Rate' => isset($analyticsData->bounceRate) ?$analyticsData->bounceRate."%" : 0,
                                '% New Visits' => isset($analyticsData->percentNew) ?$analyticsData->percentNew."%" : 0,
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows));
                            unset($rows);
                            $rows['By Browser'] = '';
                            if(isset($analyticsData->browsers)) {
	                            foreach($analyticsData->browsers as $browser => $visits){
	                                  $rows[$browser] = $visits.'&nbsp;-&nbsp;'.round(($visits / $analyticsData->browsersTotal) * 100, 2).'%';
	                            }
	                            $this->renderPartial('_reportTableToggle', array('id' => 'gaBrowserData', 'rows' => $rows));
                            }
                            unset($rows);
                            $rows['By OS'] = '';
                            if(isset($analyticsData->os)) {
	                            foreach($analyticsData->os as $os => $visits){
	                                  $rows[$os] = $visits.'&nbsp;-&nbsp;'.round(($visits / $analyticsData->osTotal) * 100, 2).'%';
	                            }
	                            $this->renderPartial('_reportTableToggle', array('id' => 'gaOsData', 'rows' => $rows));
                            }
                            unset($rows);
                            $rows['Last 7 Days Popular Hours'] = '';
                            if(isset($analyticsData->popularHour)) {
	                            foreach($analyticsData->popularHour as $timestamp => $visits){
	                                  $rows[date('M jS, Y gA', $timestamp)] = $visits;
	                            }
	                            $this->renderPartial('_reportTableToggle', array('id' => 'gaPopularHours', 'rows' => $rows));
                            }
	                        ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix" style="margin-bottom:20px;"></div>
                <?php endif; ?>
                <?php if (isset($settings['report_show_videos']) && $settings['report_show_videos']): ?>
                <div class="fab-row-fluid fab-third">
                    <div class="fab-portlet fab-box fab-red">
                        <div class="fab-portlet-title">
                            <h4>Videos</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
                            $rows = array('Total Recorded'=>0);
                            $links= array('total_video');
                            if($videoCounts) {
                                foreach($videoCounts as $source=>$count) {
                                    $links[] = $source.'_video';
                                    $rows[ucfirst($source)] = number_format($count);
                                    $rows['Total Recorded'] += $count;
                                }
                                $rows['Total Recorded'] = number_format($rows['Total Recorded']);


                                $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
                                $rows = Array(
                                    'By Filter' => "",
                                    'Accepted' => number_format($videoAcceptedCount),
                                    'Not Accepted' => number_format($videoNewCount),
                                    'Deleted' => number_format($videoDeniedCount),
                                );
                                $links = Array(
                                    '',
                                    'total_videoAccepted',
                                    'total_videoNew',
                                    'total_videoDenied',
                                );
                                $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
                                echo'
                                <table cellspacing="0" cellpadding="0" class="fab-a-blue ">
                                <tbody>
                                    <tr class="subtitle2">
                                        <td style="width:80%">Total Views</td>
                                        <td style="width:20%; text-align:right;">'.$videoViewCount.'</td>
                                    </tr>
                                </tbody>
                                </table>';
                            }
                            ?>
<!--                            <table class="fab-a-blue">
                                <tbody>
                                    <tr class="fab-a-last subtitle2">
                                        <td style="width:80%">By Filter</td>
                                        <td style="width:20%" align="right"></td>
                                    </tr>
                                    <tr>
                                        <td style="width:80%">Accepted</td>
                                        <td style="width:20%" align="right"><a href="/adminVideo/index"><?php echo($videoAcceptedCount); ?></a></td>
                                    </tr>
                                    <tr>
                                        <td style="width:80%">Not Accepted</td>
                                        <td style="width:20%" align="right"><a href="/adminVideo/index"><?php echo($videoNewCount); ?></a></td>
                                    </tr>
                                    <tr class="fab-a-last">
                                        <td style="width:80%">Deleted</td>
                                        <td style="width:20%" align="right"><a href="/adminVideo/index"><?php echo($videoDeniedCount); ?></a></td>
                                    </tr>
                                </tbody>
                            </table>-->
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(in_array('HAS_IMAGE', Yii::app()->params['features']) && isset($settings['report_show_images']) && $settings['report_show_images'] ): ?>
                <div class="fab-row-fluid fab-third">
                   <?php if (Yii::app()->params['reporting']['showImageStats']): ?>
                    <div id="socialSearchBlocker" style="height:270px">
                        Contact<br /><br />Youtoo<br /><br />Admin
                    </div>
                           <?php endif; ?>
                    <div class="fab-portlet fab-box fab-red">
                        <div class="fab-portlet-title">
                            <h4>Images</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
                            $rows = Array(
                                'Total Submitted' => number_format($imageTotalCount),
                                'Web' => number_format($imageWebCount),
                                'Facebook' => number_format($imageFacebookCount),
                                'Mobile' => number_format($imageMobileCount),
                            );
                            $links = Array(
                                'total_image',
                                'web_image',
                                'facebook_image',
                                'mobile_image',
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
                            $rows = Array(
                                'By Filter' => "",
                                'Accepted' => number_format($imageAcceptedCount),
                                'Not Accepted' => number_format($imageNewCount),
                                'Deleted' => number_format($imageDeniedCount),
                            );
                            $links = Array(
                                '',
                                'total_imageAccepted',
                                'total_imageNew',
                                'total_imageDenied',
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));
                            ?>
                        </div>
                    </div>
                </div>
                <?php endif;
                if(isset($settings['report_show_votes']) && in_array('HAS_VOTING', Yii::app()->params['features']) && ($settings['report_show_votes'])) : ?>
                <div class="fab-row-fluid fab-third">
                    <div class="fab-portlet fab-box fab-purple">
                        <div class="fab-portlet-title">
                            <h4>Votes</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
                            $rows = Array(
                                'Total Votes' => number_format($responseTotalCount),
                                'Web' => number_format($responseWebCount),
                                'Facebook' => number_format($responseFaceboookCount),
                                'Mobile' => number_format($responseMobileCount),
                                'Twitter' => number_format($responseTwitterCount),
                                //'Text' => number_format($responseTextCount),
                            );
                            $links = Array(
                                'total_pollResponse',
                                'web_pollResponse',
                                'facebook_pollResponse',
                                'mobile_pollResponse',
                                'twitter_pollResponse',
                                //'text_poll',
                            );
                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'links' => $links, 'startDate' => $startDate, 'endDate' => $endDate));

                            //$this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'startDate' => $startDate, 'endDate' => $endDate));
                            ?>
                            <?php if(sizeof($questions) > 0): ?>
                            <div class="fab-controls fab-purple-select">
                                <select id="votingQuestion" class="fab-chosen" tabindex="1" style="width:100%">
                                    <?php
                                        $i = 0;
                                        foreach($questions as $question){
                                            echo $i = 0 ? '<option selected="selected" value="'.$question->id.'">' : '<option value="'.$question->id.'">';
                                            echo $question->id.". ".$question->question;
                                            echo '</option>';
                                            $i++;
                                        }
                                    ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <div id="questionResultsWrap">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (isset($settings['report_show_ampliphy']) && $settings['report_show_ampliphy']): ?>
                <?php if (Yii::app()->params['reporting']['showTwitterAmplifyStats']): ?>
                <div class="fab-row-fluid fab-third">
                    <div class="fab-portlet fab-box fab-green">
                        <div class="fab-portlet-title">
                            <h4>Twitter Amplify</h4>
                        </div>
                        <div class="fab-portlet-body">
                            <?php
//                            $rows = Array(
//                                'Total Amplified Videos' => 310,
//                                'Total Retweets' => 1305,
//                                'Total Reach' => 7022,
//                            );
//                            $links = Array(
//                                '#',
//                                '#',
//                                '#',
//                            );
//                            $this->renderPartial('_reportTable', array('headerRow' => true, 'id' => '', 'rows' => $rows, 'startDate' => $startDate, 'endDate' => $endDate));



                                //todo VAPORWARE FOR DEMO
                            ?>
                            <table cellspacing="0" cellpadding="0" class="fab-a-blue ">
                                <tbody>
                                                        <tr class="subtitle2">
                                        <td style="width:80%">Total Amplified Videos</td>
                                        <td style="width:20%; text-align:right;">
                                            <a href="/admin/video">310</a></td>
                                    </tr>                    <tr>
                                        <td style="width:80%">Total Retweets</td>
                                        <td style="width:20%; text-align:right;">
                                            <a href="/admin/socialsearch">1305</a></td>
                                    </tr>                    <tr>
                                        <td style="width:80%">Total Reach</td>
                                        <td style="width:20%; text-align:right;">
                                            <a href="/admin/socialsearch">7022</a></td>
                                    </tr>                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
            </div> <!--container-->
        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->
