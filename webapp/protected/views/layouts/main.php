<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <script language="javascript">
    window.addEventListener("load",function() {
    // Set a timeout...
      setTimeout(function(){
        // Hide the address bar!
        window.scrollTo(0, 1);
      }, 0);
    });
  </script>
  
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php $this->widget('ext.bootstrap.widgets.BootNavbar', array(
    'fixed'=>false,
    'brand'=>Yii::app()->name,
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'ext.bootstrap.widgets.BootMenu',
            'items'=>array(
                array('label'=>'Quiz', 'url'=>array('/site/index')),
                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                //array('label'=>'Contact', 'url'=>array('/site/contact')),
                /* array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest), */
                /* array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest), */
                //array('label'=>'Rights', 'url'=>array('/rights'), 'visible'=>!Yii::app()->user->isGuest),
                //array('url'=>Yii::app()->getModule('user')->loginUrl, 'label'=>Yii::app()->getModule('user')->t("Login"), 'visible'=>Yii::app()->user->isGuest),
                //array('url'=>Yii::app()->getModule('user')->registrationUrl, 'label'=>Yii::app()->getModule('user')->t("Register"), 'visible'=>Yii::app()->user->isGuest),
                //array('url'=>Yii::app()->getModule('user')->profileUrl, 'label'=>Yii::app()->getModule('user')->t("Profile"), 'visible'=>!Yii::app()->user->isGuest),
                //array('url'=>Yii::app()->getModule('user')->logoutUrl, 'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')', 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
        
    ),
  
  )); ?>
<div class="container" id="page">
  

	<?php echo $content; ?>

	<div id="footer">
		<!--Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>-->
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
