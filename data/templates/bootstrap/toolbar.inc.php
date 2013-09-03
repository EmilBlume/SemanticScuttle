<?php
if ($userservice->isLoggedOn() && is_object($currentUser)) {
    $cUserId = $userservice->getCurrentUserId();
    $cUsername = $currentUser->getUsername();
?>
  

<div class="navbar">
		<div class="navbar-inner">
       
    <!-- Be sure to leave the brand out there if you want it shown -->
    <a class="brand" href="<?php echo ROOT ?>"><?php echo $GLOBALS['sitename']; ?></a>

		<ul class="nav">
    		<li><a href="<?php echo createURL('bookmarks', $cUsername); ?>"><?php echo T_('Bookmarks'); ?></a></li>
				<li><a href="<?php echo createURL('alltags', $cUsername); ?>"><?php echo T_('Tags'); ?></a></li>
				<li><a href="<?php echo createURL('watchlist', $cUsername); ?>"><?php echo T_('Watchlist'); ?></a></li>
				<li><a href="<?php echo $userservice->getProfileUrl($cUserId, $cUsername); ?>"><?php echo T_('Profile'); ?></a></li>
		</ul>

		<form class="navbar-search pull-right">
    <input type="text" class="search-query" placeholder="Search">
    </form>
  </div>
</div>




<?php
}
?>
