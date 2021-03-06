<?php

define('PATH_USER_VIDEOS', '/uservideos');
define('PATH_USER_IMAGES', '/userimages');

define('VIDEO_IMAGE_FILE_EXT', '.png');
define('VIDEO_POST_FILE_EXT', '.mp4');

list($tld, $host, $subdomain, $developer) = array_reverse(explode(".", $_SERVER["HTTP_HOST"]));
$env = getenv('development');
if ($env == 'development') {
    ini_set('display_errors', true);
    ini_set('display_startup_errors', 1);
    error_reporting(-1);
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENABLE_ERROR_HANDLER') or define('YII_ENABLE_ERROR_HANDLER', true);
    defined('YII_ENABLE_EXCEPTION_HANDLER') or define('YII_ENABLE_EXCEPTION_HANDLER', true);
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
}

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.utilities.*',
        'core.vendor.getid3.*',
    ),
    'modules' => array(
    // uncomment the following to enable the Gii tool

//      'gii' => array(
//      'class' => 'system.gii.GiiModule',
//      'password' => 'g111tup',
//      // If removed, Gii defaults to localhost only. Edit carefully to taste.
//      'ipFilters' => array('*'),
//      'newFileMode'=>0666,
//      'newDirMode'=>0777,
//      ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            //'loginUrl' => array('admin/login'),
            'class' => 'WebUser',
            'autoUpdateFlash' => false,
        ),
//         'geocoder' => array(
//            'class' => 'ext.EGeocoder.EGeocoder',
//             'providers' => array(
//                //new \Geocoder\Provider\FreeGeoIpProvider(new \Geocoder\HttpAdapter\CurlHttpAdapter()),
//                 'GeoPlugin',
//                array(
//                    'name' => 'Initechgames',
//                    'apiKey' => 'AIzaSyBqBZAwrI-zhDidCVDtriw1BHrQC9cuTZ4',
//                    ),
//                 ),
//             ),
        'request' => array(
            'csrfTokenName' => 'CSRF_TOKEN',
            'enableCsrfValidation' => false,
            'enableCookieValidation' => true,
            'class' => 'HttpRequest',
        //'class' => 'application.components.GHttpRequest',
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'showScriptName' => false,
            'urlFormat' => 'path',
            'rules' => array(
                'admin/' => 'admin/login',
                'admin/dashboard' => 'adminDashboard/index',
                'admin/banner' => 'adminBanner/index',
                'admin/video' => 'adminVideo/index',
                'adminEmail' => 'adminEmail/index',
                'adminEmail/template/<name:[a-zA-Z_ ]+>' => 'adminEmail/template',
                'admin/image' => 'adminImage/index',
                'admin/ticker' => 'adminTicker/index',
                'adminTicker/tickerModalHistory' => 'adminTicker/tickerModalHistory',
                'admin/voting' => 'adminVoting/index',
                'admin/question' => 'adminQuestion/index',
                'admin/socialsearch' => 'adminSocialSearch/index',
                'admin/socialstream' => 'adminSocialStream/index',
                'admin/game' => 'adminGame/index',
                'admin/affidavit' => 'adminAffidavit/index',
                'admin/affidavit/<id:\d+>' => 'adminAffidavit/index',
                'admin/affidavitreport' => 'adminAffidavitReport/index',
                'admin/affidavitreport/<id:\d+>' => 'adminAffidavitReport/index',
                'admin/gameprocesstwittervotes' => 'adminGame/processtwittervotes',
                'admin/gamereport/<game_id:\d+>' => 'adminGame/gamereport',
                'admin/gamechoice/<type:\w+>/<anum:\d+>/<id:\d+>' => 'adminGame/gamechoice',
                'admin/gamechoice/<type:\w+>/<anum:\d+>' => 'adminGame/gamechoice',
                'admin/gamechoice/<type:\w+>' => 'adminGame/gamechoice',
                'admin/gamereveal/<id:\d+>' => 'adminGame/gamereveal',
                'admin/gamereveal' => 'adminGame/gamereveal',
                'admin/gamewordscramble/<id:\d+>' => 'adminGame/gamewordscramble',
                'admin/gamewordscramble' => 'adminGame/gamewordscramble',
                'admin/setperiodwinner/<type:\w+>/<day:\d+>/<week:\d+>/<month:\d+>/<year:\d+>' => 'adminGame/setperiodwinner',
                'admin/periodwinner' => 'adminGame/periodwinner',
                'admin/prize' => 'adminPrize/index',
                'admin/prize/update/<id:\d+>' => 'adminPrize/update',
                'admin/prize/enable/<id:\d+>' => 'adminPrize/enable',
                'admin/prize/disable/<id:\d+>' => 'adminPrize/disable',
                'admin/prize/export/' => 'adminPrize/export',
                'XML/gamechoice/<id:\d+>' => 'XML/gamechoice',
                'admin/language' => 'adminLanguage/index',
                'admin/report' => 'adminReport/index',
                'admin/audit' => 'adminAudit/audit',
                'admin/user/<id:\d+>' => 'adminUser/index',
                'admin/user' => 'adminUser/index',
                'admin/loginreport' => 'adminUser/userLoginReport',
                'admin/entity/<id:\d+>' => 'adminEntity/index',
                'admin/entity' => 'adminEntity/index',
                'admin/entity/<action:\w+>' => 'adminEntity/<action>',
                'admin/entity/<action:\w+>/<id:\d+>' => 'adminEntity/<action>',
                'admin/tvscreensetting/' => 'adminTvScreenAppearSetting/index',
                'XML/voting/<id:\d+>' => 'XML/voting',
                'twittercard/<key:\w+>' => 'video/twittercard',
                // mobile api
                'mobile/users' => 'mobile/users',
                'mobile/users/login' => 'mobile/login',
                'mobile/users/logout' => 'mobile/logout',
                'mobile/users/recover' => 'mobile/recover',
                'mobile/users/<user_id:\d+>' => 'mobile/users',
                'mobile/users/<user_id:\d+>/videos' => 'mobile/videos',
                'mobile/users/<user_id:\d+>/videos/limit/<limit:\d+>' => 'mobile/videos',
                'mobile/users/<user_id:\d+>/videos/limit/<limit:\d+>/offset/<offset:\d+>' => 'mobile/videos',
                'mobile/users/<user_id:\d+>/images' => 'mobile/images',
                'mobile/users/<user_id:\d+>/images/limit/<limit:\d+>' => 'mobile/images',
                'mobile/users/<user_id:\d+>/images/limit/<limit:\d+>/offset/<offset:\d+>' => 'mobile/images',
                'mobile/videos' => 'mobile/videos',
                'mobile/videos/<id:\d+>' => 'mobile/videos',
                'mobile/videos/limit/<limit:\d+>' => 'mobile/videos',
                'mobile/videos/limit/<limit:\d+>/offset/<offset:\d+>' => 'mobile/videos',
                'mobile/images' => 'mobile/images',
                'mobile/images/<id:\d+>' => 'mobile/images',
                'mobile/images/limit/<limit:\d+>' => 'mobile/images',
                'mobile/images/limit/<limit:\d+>/offset/<offset:\d+>' => 'mobile/images',
                'mobile/images/avatar' => 'mobile/avatar',
                'mobile/topics' => 'mobile/topics',
                'mobile/topics/type/<type:\w+>' => 'mobile/topics',
                'mobile/topics/type/<type:\w+>/limit/<limit:\d+>' => 'mobile/topics',
                'mobile/topics/type/<type:\w+>/limit/<limit:\d+>/offset/<offset:\d+>' => 'mobile/topics',
                'mobile/topics/<topic_id:\d+>' => 'mobile/topics',
                'mobile/topics/<topic_id:\d+>/limit/<limit:\d+>' => 'mobile/topics',
                'mobile/topics/<topic_id:\d+>/limit/<limit:\d+>/offset/<offset:\d+>' => 'mobile/topics',
                'mobile/polls' => 'mobile/polls',
                'mobile/staticcontent/<type:\w+>' => 'mobile/staticcontent',
                'import/vci' => 'vci/importvci',
                'import/sims' => 'vci/importsims'
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=ytt',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'schemaCachingDuration' => 3600,
        //'enableProfiling'=>true,
        //'enableParamLogging'=>true,
        ),
        /*
          'cache' => array (
          'class' => 'system.caching.CMemCache',
          'servers'=>array(
          array(
          'host'=>SHARED_MEMCACHE_SERVER_IP,
          'port'=>SHARED_MEMCACHE_SERVER_PORT,
          ),
          ),
          ),
         *
         */
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'admin/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                //'class'=>'CProfileLogRoute',
                //'levels'=>'profile',
                //'categories'=>'system.db.*, application',
                //'enabled'=>true,
                ),
            // uncomment the following to show log messages on web pages
            //
            //  array(
            //  'class'=>'CWebLogRoute',
            //  ),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'enableContestants' => false,
        'enableUserFunctionality' => false,
        'enableUserPermissions' => true,
        'session' => array('durationOffset' => 60 * 5),
        'paths' => array(
            'video' => $_SERVER['DOCUMENT_ROOT'] . '/uservideos',
            'avatar' => $_SERVER['DOCUMENT_ROOT'] . '/userimages',
            'image' => $_SERVER['DOCUMENT_ROOT'] . '/userimages',
            'vci' => $_SERVER['DOCUMENT_ROOT'] . '/vciuploads',
            'ffmpeg' => '/usr/local/bin/ffmpeg',
            'ffprobe' => '/usr/local/bin/ffprobe',
        ),
        'affidavit' => array(
            'adminAllowCopyMonth' => true,
            'clientAllowCopyMonth' => true,
            'reportDownload' => true,
            'showAffidavitData' => true,
        ),
        'reporting' => array(
            'getMobileRegisteredUsers' => false,
            'enableWeeklyReportOnDashBoard' => true,
        ),
        'training' => array(
            'showManual' => false,
            'showSchedule' => false,
            ),
        'actel' => array(
          'username' => 'yout00',
          'password' => 'tech!!',
          'id_application' => 3734,
          'contentSubType' => 'smsreply',
            ),
        'pagination' => array(
        'listPerPage' => 15,
        'enablePagination' => false,
        ),
        'enableVideoDownload'=>true,
        'xml' => array(
            'encoding' => 'utf-16',
        ),
        'wowza' => array(
            'ip' => 'jehmu4chtmbbfx.rtmphost.com',
            'clientip' => 'jehmu4chtmbbfx.rtmphost.com',
            'user' => 'jehmu4chtmbbfx',
            'password' => 'winner',
            'path' => '/jehmu4chtmbbfx_wowza/content',
        ),
        'vine' => array(
            'username' => 'greg.stringer@gmail.com',
            'password' => 'i!ur@ss4o',
            'url' => 'https://api.vineapp.com',
            'ext' => '.mp4',
        ),
        'keek' => array(
            'username' => 'greg.stringer@gmail.com',
            'password' => 'g33m4n',
            'url' => 'https://www.keek.com',
            'url2' => 'https://keek-a.akamaihd.net/keek/video/{VIDEO_ID}/flv',
            'ext' => '.flv',
        ),
        'analytics' => array(
            'username' => 'mbahmj@gmail.com',
            'keyfile' => $_SERVER['DOCUMENT_ROOT'].'/client_secrets.p12',
        ),
        'flipFactory' => array(
            'host' => '97.77.59.182',
            'username' => 'iphoneupload',
            'password' => 'Dallas11',
        ),
        'dots' => array(
            'url' => 'http://ws.serviceobjects.com/gce/GeoCensus.asmx?WSDL',
            'key' => 'WS22-FSV1-OUI2',
        ),
        'ticker' => array(
            'icon' => 'images/icons/shareImage.png',
            'defaultQuestion' => 0,
        ),
        'DashboardCounts' => array(
            'video' => true,
            'image' => true,
            'poll' => true,
            'ticker' => true,
                ),
        'cloudGraphicAppearanceSetting' => array(
                        'enableTickerCloudGraphicSetting' => true,
                        'enablePollCloudGraphicSetting' => true,
                        'tvScreenImageAllowedType'=> 'jpg,jpeg,png,gif',
                        'tvScreenImageAllowedDimension'=> '1920x1080',
                        'tvScreenScrollImageAllowedDimension'=> '1920x70',
                        'tvScreenImageLimit'=> '10',
                        'fileSize'=> 105*1024*1024,
                        ),
        'gameReveal' => array(
                        'imageAllowedType'=> 'jpg, jpeg, png, gif',
                        'imageNote'=> 'all images will be scaled to 800x600px size',
                        'fileSize'=> 105*1024*1024,
                        ),
        'custom_params' => array(
            'rss_divide_title_desc' => true,
            'rss_powered_by_youtootech' => true,
            'banner_prefix' => 'home',
            'banner_extension' => 'png',
            'instagram_client_id' => 'bba059eb293c48aabdcd5f9d3558acd7',
            'error_invalid_type' => 'Invalid file type',
            'image_upload_filetype' => 'jpg, jpeg, png, gif',
            'default_video_type' => 'mp4',
            'twitter_share_text' => 'Video uploaded via admin',
            'invalid_file_type' => 'Invalid file type. Only .mov files can be uploaded',
            'invalid_file_size' => 'The file is too large to be uploaded. Maximum is 100 Mb',
            'terms_of_service' => 'You must accept the conditions for using our service',
            'video_encode_error' => 'Unable to upload video',
            'video_insertrecord_error' => 'Unable to insert record',
            'image_insertrecord_error' => 'Unable to insert image record',
            'validation_error' => 'error in validation',
            'checkout_newimage' => 'Check out my new image! ',
            //'default_id' => 9999999999,
            'client_support_email' => 'youtootechsupport@youtootech.com',

        ),
    ),
);
