<?php
/***************************************************************************
Copyright (C) 2006 - 2007 Scuttle project
http://sourceforge.net/projects/scuttle/
http://scuttle.org/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
***************************************************************************/

require_once('header.inc.php');
$b2tservice       = & ServiceFactory :: getServiceInstance('Bookmark2TagService');
$templateservice  = & ServiceFactory :: getServiceInstance('TemplateService');
$userservice      = & ServiceFactory :: getServiceInstance('UserService');
$cdservice        = & ServiceFactory :: getServiceInstance('CommonDescriptionService');

list ($url, $tag) = explode('/', $_SERVER['PATH_INFO']);
$template   = 'tagcommondescriptionedit.tpl';

$logged_on_user = $userservice->getCurrentUser();

//permissions
if($logged_on_user == null) {
    $tplVars['error'] = T_('Permission denied.');
    $templateservice->loadTemplate('error.500.tpl', $tplVars);
    exit();
}

if ($_POST['confirm']) {

   if ( strlen($tag)>0 &&
	$cdservice->addTagDescription($tag, stripslashes($_POST['description']), $logged_on_user['uId'], time())
   ) {
      $tplVars['msg'] = T_('Tag common description updated');
      header('Location: '. $_POST['referrer']);
   } else {
      $tplVars['error'] = T_('Failed to update the tag common description');
      $template         = 'error.500.tpl';
   }
} elseif ($_POST['cancel']) {
    $logged_on_user = $userservice->getCurrentUser();
    header('Location: '. $_POST['referrer']);
} else {
   $tplVars['subtitle']    = T_('Edit Tag Common Description') .': '. $tag;
   $tplVars['formaction']  = $_SERVER['SCRIPT_NAME'] .'/'. $tag;
   $tplVars['referrer']    = $_SERVER['HTTP_REFERER'];
   $tplVars['tag']         = $tag;
   $tplVars['description'] = $cdservice->getLastTagDescription($tag);
}
$templateservice->loadTemplate($template, $tplVars);
?>
