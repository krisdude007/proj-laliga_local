<?php
// page specific css
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery-ui-1.10.0.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/jquery.rating.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/tag-it/jquery.tagit.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/tag-it/tagit.ui-zendesk.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminVideo/index.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminVideo/videoModal.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/core/webassets/css/adminVideo/videoImportModal.css');

// page specific js

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/adminVideo/index.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/tag-it/tag-it.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseurl . '/core/webassets/js/jquery.dataTables.min.js', CClientScript::POS_END);
?>

<!-- BEGIN PAGE -->
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'video-filter-form',
    'enableAjaxValidation' => true,
    'method' => 'get',
    'action' => Yii::app()->createUrl('/adminVideo/index'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'validateOnType' => false,
    )
        ));
?>

<?php $this->renderPartial('/admin/_csrfToken', array()); ?>
<div class="fab-page-content">

    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <div id="fab-top" style="background:#E02222;margin-bottom:0px;">
        <h2 class="fab-title" style="color:white"><img class="floatLeft marginRight10" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/video-admin-image.jpg"/>Video Admin - <?php echo $statuses[$filterVideoModel->status]; ?></h2>
    </div>

    <!-- flash messages -->
    <?php $this->renderPartial('/admin/_flashMessages', array()); ?>
    <!-- flash messages -->
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="fab-container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE HEADER-->
        <div class="fab-row-fluid">
            <div class="fab-tab-content">
                <div class="fab-main-videos">
                    <div class="fab-form-horizontal">
                        <div class="fab-control-group">
                            <div id="fab-video-filter-form">
                                <div class="fab-form-left">
                                    <div class="fab-clear" style="height:6px;"></div>
                                    <div class="fab-box fab-left" style="margin-left:0px">
                                        <label class="fab-left">Question:</label>
                                        <?php echo $form->dropDownList($filterVideoModel, 'question', $questions, array('class' => 'fab-select-question')); ?>
                                        <br/>
                                        <?php if (Yii::app()->params['enableContestants'] === true): ?>
                                        <label class="fab-left" style="padding-right: 21px;">Hero:</label>
                                        <?php echo $form->dropDownList($filterVideoModel, 'hero', $heros, array('class' => 'fab-select-accept')); ?>
                                        <br/>
                                        <?php endif; ?>
                                        <label class="fab-left">Source:</label>
                                        <?php echo $form->dropDownList($filterVideoModel, 'source', $sources, array('class' => 'fab-select-accept', 'id' => 'fab-select-accept-src')); ?>
                                    
                                    </div>
                                    
                                    
                                    <div class="fab-box fab-left" style="margin-left:10px;">
                                        <label class="fab-left">Status:</label>
                                        <?php echo $form->dropDownList($filterVideoModel, 'status', $statuses, array('class' => 'fab-select-accept', 'id' => 'fab-select-accept')); ?>
                                    </div>
                                    
                                    <?php if ($filterVideoModel->status == "accepted"): ?>
                                        <div class="fab-clear"></div>
                                        <div class="fab-box fab-left" style="margin-left:0px">
                                            <label class="fab-left">Views From: </label>
                                            <?php echo $form->textField($filterVideoModel, 'viewsDateStart', array('id' => 'datepickerVideoViewsFilterStart', 'style' => 'width: 70px;', 'class' => 'fab-small-input fab-left datepicker')); ?>

                                            <label class="fab-left">Views To: </label>
                                            <?php echo $form->textField($filterVideoModel, 'viewsDateStop', array('id' => 'datepickerVideoViewsFilterStop', 'style' => 'width: 70px;', 'class' => 'fab-small-input fab-left datepicker')); ?>
                                        
                                            <label class="fab-left">Min Views: </label>
                                            <?php echo $form->textField($filterVideoModel, 'minViews', array('class' => 'fab-user-input fab-left', 'style' => 'width: 50px;')); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="fab-clear"></div>
                                    <?php if (Yii::app()->params['enableYtFunctionality'] === true ): ?>
                                    <div class="fab-box fab-left" style="margin-left:12px;">
                                        <label class="fab-left" style="padding-right: 10px;">Type: </label>
                                        <?php echo $form->dropDownList($filterVideoModel, 'type', $types, array('class' => 'fab-select-accept')); ?>
                                        <!--If any value are add please also add in index.js [$("#fab-select-accept").change]-->
                                    </div>
                                    <div class="fab-clear"></div>
                                    <?php endif; ?>
                                    <div id="fab-advanced-filtering" class="fab-left fab-hide">

                                        <div class="fab-box fab-left" style="margin-left:0px">
                                            <label class="fab-left">From: </label>
                                            <?php echo $form->textField($filterVideoModel, 'dateStart', array('id' => 'datepickerVideoFilterStart', 'style' => 'width: 70px;', 'class' => 'fab-small-input fab-left datepicker')); ?>

                                            <label class="fab-left">To: </label>
                                            <?php echo $form->textField($filterVideoModel, 'dateStop', array('id' => 'datepickerVideoFilterStop', 'style' => 'width: 70px;', 'class' => 'fab-small-input fab-left datepicker')); ?>

                                            <label class="fab-left">User: </label>
                                            <input id="userAutoCompleter" type="text" name="userPlaceholder" class="fab-user-input fab-left" style="width: 130px;" />
                                            <?php echo $form->hiddenField($filterVideoModel, 'user_id', array('id' => 'userIdAutoComplete')); ?>

                                            <label class="fab-left">Tags: </label>
                                            <?php echo $form->textField($filterVideoModel, 'tags', array('class' => 'fab-user-input fab-left', 'style' => 'width: 150px;')); ?>
                                        </div>

                                        <div class="fab-clear"></div>
                                    </div>

                                </div>
                                <div class="fab-form-right">
                                    <div class="fab-b-left">
                                        <input type="submit" class="fab-right-filter" style="margin-top: 0px;" value="Submit">
                                        <div class="fab-clear"></div>
                                        <button class="fab-right-filter" id="fab-advanced-button" style="margin-top:8px;padding-top:0"><i>Advanced Filtering</i></button>
                                        <?php if (Yii::app()->params['video']['allow3rdPartyImport']): ?>
                                            <div class="fab-clear"></div>
                                            <button type="button" class="fab-right-filter" id="fab-import-button" style="margin-top:8px;padding-top:0"><i>Import Videos</i></button>
                                        <?php endif; ?>
                                        <?php if (Yii::app()->params['video']['adminAllowUpload']): ?>
                                            <div class="fab-clear"></div>
                                            <button type="button" id="fab-upload-video-button" class="fab-right-filter" style="margin-top:8px;padding-top:0"><i>Upload Video</i></button>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div style="clear: both"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="fab-row-fluid">
            <div class="fab-main-videos">

                <?php
                $showAcceptAll = false;
                $showDenyAll = false;
                switch ($filterVideoModel->status) {
                    case "new":
                    case "newtv":
                    case "newsup1":
                    case "newsup2":
                        $showAcceptAll = true;
                        $showDenyAll = true;
                        $tempStatus = 'new';
                        break;
                    case "accepted":
                    case "acceptedtv":
                        $showDenyAll = true;
                        $tempStatus = 'accepted';
                        break;
                    case "denied":
                    case "deniedtv":
                        $showAcceptAll = true;
                        $tempStatus = 'denied';
                        break;
                    case "all":
                    case "statustv":
                        $tempStatus = 'all';
                    default:
                        break;
                }
                ?>

                <?php if ($showAcceptAll || $showDenyAll): ?>
                    <div class="fab-left" style="margin-top:3px;">
                        <label class="floatLeft marginRight" style="padding-top:0px;">Select All</label>
                        <div class="fab-left" style="margin-top:2px">
                            <input id="fab-check_box" class="fab-chk" type="checkbox"  name="select-check" value="a"><label for="fab-check_box"></label>
                        </div>

                        <div class="fab-left" style="margin-left:7px;margin-top:-3px;">
                            <?php if ($showAcceptAll): ?>
                                <button id="videoAcceptAll" class="fab-accept-button" onclick="updateAllVideoStatuses('accepted', $('#fab-select-accept').val())">Accept</button>
                            <?php endif; ?>
                            <?php if ($showDenyAll): ?>
                                <button id="videoDenyAll" class="fab-deny-button" onclick="updateAllVideoStatuses('denied', $('#fab-select-accept').val())">Deny</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="fab-left" style="margin-left: 26px;margin-top:2px">
                    <label class="fab-left">Items per page</label>
                    <?php echo $form->dropDownList($filterVideoModel, 'perPage', $perPageOptions, array('id' => 'perPage', 'class' => 'fab-left', 'style' => 'font-size: 12px;height: 23px;margin-left: 3px;width:50px')); ?>
                </div>
                <div class="fab-left" style="margin-left: 26px;margin-top:3px">
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminVideo/videoSchedulerModal" rel="#videoOverlay"><img class="floatLeft" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/video-show.png"/></a>
                    <label class="fab-left">Showing <?php echo count($videos); ?> of <?php echo $videosTotal; ?> videos</label>
                </div>
                <div class="fab-right" style="margin-top:-3px; margin-left:26px;">
                    <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '', 'prevPageLabel' => 'Prev', 'nextPageLabel' => 'Next')); ?>
                </div>

            </div>
        </div>
        <div class="fab-row-fluid" style="margin-top:10px">
            <div class="fab-main-videos">
                <div class="fab-tiles">

                    <?php if (!is_null($videos)): ?>
                        <?php $i = 1; ?>
                        <?php foreach ($videos as $video): ?>
                            <div id="video<?php echo $video->id; ?>" class="fab-tile">
                                <div class="fab-tile-body">
                                    <div class="fab-video-movie">
                                        <div class="fab-left" style="width: 150px;">
                                            <h3 style="width: 150px; overflow: hidden; white-space: nowrap; height: 18px;line-height: 18px;margin-bottom: 1px;"><?php $videotitle = !empty($video->title) ? CHtml::encode($video->title) : Yii::app()->name . ' Video Title';
                    echo $videotitle; ?></h3>
                                            <div style="width: 180px; overflow: hidden; white-space: nowrap;padding: 0px;"><a style="cursor:pointer;" title="<?php echo CHtml::encode($video->filename); ?><?php echo VideoUtility::getVideoFileExtention($video->processed); ?>"><?php echo $video->filename; ?><?php echo VideoUtility::getVideoFileExtention($video->processed); ?></a></div>
                                        </div>
        <?php if ($showAcceptAll || $showDenyAll): ?>
                                            <div class="fab-right"><input type="checkbox" value="<?php echo $video->id; ?>" name="select-check" class="fab-chk" id="fab-check_box<?php echo $video->id; ?>">
                                                <label for="fab-check_box<?php echo $video->id; ?>" ></label>
                                            </div>
        <?php endif; ?>
                                        <div style="clear:right"></div>
                                        <div class="fab-clear"></div>
                                        <!-- currentStatus val is tacked on via jquery -->
                                        <a rel="#videoOverlay" href="<?php echo Yii::app()->request->baseUrl; ?>/adminVideo/videoModal/id/<?php echo $video->id; ?>/currentStatus/" class="videoModalTrigger">
                                            <div class="videoThumb" align="center" style="margin-bottom:2px;">
                                                <?php
                                                $styleClass = '';
                                                if ($video->source == 'instagram')
                                                    $styleClass = 'videoThumbInstagram';
                                                ?>
                                                <img class="videoThumbnail videoThumb <?php echo $styleClass ?>" alt="video-image" src="<?php echo Yii::app()->request->baseUrl; ?>/<?php echo basename(Yii::app()->params['paths']['video']); ?>/<?php echo $video->thumbnail; ?><?php echo Yii::app()->params['video']['imageExt']; ?>" style="float: none; height: 105px;">
                                                <span class="video-duration" title="Duration"><?php
                                                    $duration = DateTimeUtility::secsToTimecode($video->duration) . ":00";

                                                    echo $duration
                                                    ?> &nbsp;</span>
                                            </div>
                                        </a>

                                        <div class="fab-clear"></div>

                                        <div class="fab-left">
                                            <div class="fab-<?php echo VideoUtility::getIndicatorColor($video->duration); ?>-button"></div>
                                        </div>

                                        <div class="fab-accepted-video">
                                            <div class="fab-right">
                                                <button id="fab-accept-button<?php echo $video->id; ?>" value="<?php echo $tempStatus; ?>" class="fab-accept-button" onclick="updateVideoStatus('accepted', $('#fab-select-accept').val(), <?php echo $video->id; ?>);">Accept</button>
                                                <button id="fab-deny-button<?php echo $video->id; ?>" value="<?php echo $tempStatus; ?>" class="fab-deny-button" onclick="updateVideoStatus('denied', $('#fab-select-accept').val(), <?php echo $video->id; ?>);">Deny</button>
                                            </div>
                                        </div>

                                        <?php
                                        $style = '';
                                        if ($filterVideoModel->status == 'accepted' || $filterVideoModel->status == 'acceptedtv') {
                                            $style = 'display:block';
                                        } else {
                                            $style = 'display:none';
                                        }
                                        ?>
                                        <div id="videoIcons<?php echo $video->id; ?>" style="<?php echo $style; ?>" class="fab-not-accepted-video">
                                            <div class="fab-right">

                                                <?php if (Yii::app()->params['enableYtFunctionality'] === true): ?>
                                                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/adminVideo/videoSchedulerModal/video_id/<?php echo $video->id; ?>" rel="#videoOverlay">
                                                        <img alt="<?php echo $video->id; ?>" class="videoIcon" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/video-show-white.png" />
                                                    </a>
                                                <?php else: ?>
                                                    <?php
                                                    //quick fix will make it better, need a function here
                                                    $extendedLabels = Yii::app()->params['video']['extendedFilterLabels'];

                                                    switch (sizeof($extendedLabels)) {
                                                        case "1":
                                                            $tempStatusEx = 'accepted';
                                                            break;
                                                        case "2":
                                                        case "3":
                                                        case "4":
                                                            $tempStatusEx = 'acceptedtv';
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                    ?>
                                                    <?php if (Yii::app()->params['video']['useExtendedFilters'] && $filterVideoModel->status == $tempStatusEx || !Yii::app()->params['video']['useExtendedFilters'] && $filterVideoModel->status == 'accepted'): ?>
                                                        <img alt="<?php echo $video->id; ?>" class="videoIcon videoIconFTP" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/video-show-white.png" />
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <a rev="<?php echo $video->id; ?>" href="#" id="clientShareFacebookTrigger"><img alt="<?php echo $video->id; ?>" class="videoIcon videoIconFacebook" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/facebook-transparent.png" /></a>
                                                <a rev="<?php echo $video->id; ?>" href="#" id="clientShareTwitterTrigger"><img alt="<?php echo $video->id; ?>" class="videoIcon videoIconTwitter" src="<?php echo Yii::app()->request->baseUrl; ?>/core/webassets/images/twitter-transparent.png" /></a>
                                            </div>
                                        </div>
                                        <div style="clear: right"></div>
                                        <div style="height: 12px"></div>

                                        <?php
                                        if ($filterVideoModel->status == 'statustv') {
                                            //will need to make a utility function for this for this
                                            $extendedLabels = Yii::app()->params['video']['extendedFilterLabels'];

                                            echo '<div style="font-size: 10px;">';

                                            unset($extendedLabels[0]);
                                            unset($extendedLabels[1]);

                                            $i = 1;
                                            foreach ($extendedLabels as &$value) {
                                                if ($video->extendedStatus['accepted_sup' . $i]) {
                                                    echo '<span title="approved" style="color: green">' . $value[key($value)] . '</span> - ';
                                                } else {
                                                    echo '<span title="no action taken" style="color: orange">' . $value[key($value)] . '</span> - ';
                                                }
                                                $i++;
                                            }

                                            if ($video->extendedStatus['denied_tv']) {
                                                echo '<span title="denied" style="color: red">DenyTV</span> - ';
                                            } else {
                                                echo '<span title="no action taken" style="color: orange">DenyTV</span> - ';
                                            }

                                            if ($video->extendedStatus['denied']) {
                                                echo '<span title="denied" style="color: red">DenyWeb</span>';
                                            } else {
                                                echo '<span title="no action taken" style="color: orange">DenyWeb</span>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                        <h3><?php
                                        $firstName = (isset($video->user->first_name)) ? $video->user->first_name : $video->first_name;
                                        $lastName = (isset($video->user->last_name)) ? $video->user->last_name : $video->last_name;
                                        if ($video->user->first_name) {
                                            $byName = $firstName . ' ' . $lastName;
                                        } else {
                                            $byName = $video->user->username;
                                        }
                                        $partName = explode('@', $byName);
                                        $username = $partName[0];
                                        
                                        // see if video is vine, keek, or instagram
                                        // if so, use that username instead
                                        // if not, use standard username
                                        $username = eVideo::getExternalSourceUsername($video, $username);
                                        
                                        echo $username;
                                        ?></h3>
                                        <div><?php echo DateTimeUtility::convertTimestampToDate($video->created_on); ?> @ <?php echo DateTimeUtility::convertTimestampToTime($video->created_on); ?> <?php echo date("T"); ?></div>
                                        <div style="float: left; width: 120px; font-size: 10px;">
                                            <img src="/core/webassets/images/recorded.png" width="18" height="18" title="Recorded" tip="Recorded" style="margin: 0px 3px 0px 0px;"/>
                                            via <?php echo CHtml::encode(ucfirst($video->source)); ?>
                                        </div>
                                        <div style="float: left; width: 59px; font-size: 10px;">
                                        <img src="/core/webassets/images/views.png" width="15" height="7" title="Views" tip="Views" style="margin: 5px 5px 0px 0px;"/> <?php echo number_format($video->views); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                            <?php ++$i; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                    <div class="fab-clear"></div>

                    <div class="fab-right" style="margin-top:-3px; margin-left:26px;">
<?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '', 'prevPageLabel' => 'Prev', 'nextPageLabel' => 'Next')); ?>
                    </div>
                    <!--end tiles-->
                </div>
            </div>

        </div>
    </div>
    <!-- END PAGE CONTAINER-->
</div>
                        <?php $this->endWidget(); ?>
<!-- END PAGE -->

<!-- VIDEO MODAL -->
<div class="videoModal" id="videoOverlay">
    <div class="videoModalContent"></div>
</div>
<!-- VIDEO MODAL -->

<div id="fb-root">
</div>

<?php if (Yii::app()->params['video']['allow3rdPartyImport']): ?>
    <!-- VIDEO IMPORT OVERLAY -->
    <div style="display: none;" id="videoImportOverlay">
        <div id="videoImportOverlayContent">
            <h2 style="font-size: 18px;">Select a source:</h2>
            <hr/>
    <?php if (Yii::app()->params['video']['allowImportKeek']): ?><button type="button" class="fab-right-filter fab-import-source-button" style="margin-top:8px;padding-top:0">Keek</button><?php endif; ?>
    <?php if (Yii::app()->params['video']['allowImportVine']): ?><button type="button" class="fab-right-filter fab-import-source-button" style="margin-top:8px;padding-top:0">Vine</button><?php endif; ?>
    <?php if (Yii::app()->params['video']['allowImportInstagram']): ?><button type="button" class="fab-right-filter fab-import-source-button" style="margin-top:8px;padding-top:0">Instagram</button><?php endif; ?>
        </div>
    </div>
    <!-- VIDEO IMPORT OVERLAY -->
<?php endif; ?>

<?php if (Yii::app()->params['video']['adminAllowUpload']): ?>
    <!-- VIDEO UPLOAD OVERLAY -->
            <?php
            $this->renderPartial('/adminVideo/_overlayUpload', array(
                'formVideoUploadModel' => $formVideoUploadModel,
                'questionsUpload' => $questionsUpload,
                    )
            );
            ?>
    <!-- VIDEO UPLOAD OVERLAY -->
<?php endif; ?>