<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8"/>
	<title><?php echo filter($GLOBALS['sitename'] .(isset($pagetitle) ? ' » ' . $pagetitle : '')); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
  <link rel="stylesheet" media="screen" href="<?php echo $theme->resource('bootstrap.css');?>" />
  <link rel="stylesheet" media="screen" href="<?php echo $theme->resource('show-grid.css');?>" />
  <link rel="stylesheet" media="screen" href="<?php echo $theme->resource('bootstrap-responsive.css');?>" />

  <link rel="search" type="application/opensearchdescription+xml" href="<?php echo ROOT ?>api/opensearch.php" title="<?php echo htmlspecialchars($GLOBALS['sitename']) ?>"/>
<?php
if (isset($rsschannels)) {
	$size = count($rsschannels);
	for ($i = 0; $i < $size; $i++) {
		echo '  <link rel="alternate" type="application/rss+xml" title="'
            . htmlspecialchars($rsschannels[$i][0]) . '"'
            . ' href="'. htmlspecialchars($rsschannels[$i][1]) .'" />' . "\n";
	}
}
?>

<?php if (isset($loadjs)) :?>
<?php if (DEBUG_MODE) : ?>
  <script type="text/javascript" src="<?php echo ROOT_JS ?>jquery-1.4.2.js"></script>
  <script type="text/javascript" src="<?php echo ROOT_JS ?>jquery.jstree.js"></script>
<?php else: ?>
  <script type="text/javascript" src="<?php echo ROOT_JS ?>jquery-1.4.2.min.js"></script>
  <script type="text/javascript" src="<?php echo ROOT_JS ?>jquery.jstree.min.js"></script>
<?php endif ?>
  <script type="text/javascript" src="<?php echo ROOT ?>jsScuttle.php"></script>
<?php endif ?>

 </head>
 <body>

<?php
$headerstyle = '';
if(isset($_GET['popup'])) {
	$headerstyle = ' class="popup"';
	echo '<div id="header"' . $headerstyle . '>&nbsp;</div>' ;
}
?>
<?php
if(!isset($_GET['popup'])) {
	$this->includeTemplate('toolbar.inc');
}
?>

<?php
if (isset($subtitlehtml)) {
	echo '<h2>' . $subtitlehtml . "</h2>\n";
} else if (isset($subtitle)) {
      echo '<h2>' . htmlspecialchars($subtitle) . "</h2>\n";
}
if(DEBUG_MODE) {
	echo '<p class="error">'. T_('Admins, your installation is in "Debug Mode" ($debugMode = true). To go in "Normal Mode" and hide debugging messages, change $debugMode to false into config.php.') ."</p>\n";
}
if (isset($error) && $error!='') {
	echo '<p class="error">'. $error ."</p>\n";
}
if (isset($msg) && $msg!='') {
	echo '<p class="success">'. $msg ."</p>\n";
}
if (isset($tipMsg) && $tipMsg!='') {
	echo '<p class="tipMsg">'. $tipMsg ."</p>\n";
}
?>
