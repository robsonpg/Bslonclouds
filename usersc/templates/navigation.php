<!-- Grab the initial menu work that UserSpice does for you -->
<?php
require_once ($abs_us_root . $us_url_root . 'users/includes/template/database_navigation_prep.php');
 ?>

<!-- This file is a way of allowing the end user to customize stuff -->
<!-- without getting in the middle of the whole template itself -->

  <?php
$settingsQ = $db->query("SELECT * FROM settings");
$settings = $settingsQ->first();

// Set up notifications button/modal

if ($user->isLoggedIn())
 {
 if ($dayLimitQ = $db->query('SELECT notif_daylimit FROM settings', array())) $dayLimit = $dayLimitQ->results() [0]->notif_daylimit;
   else $dayLimit = 7;

 // 2nd parameter- true/false for all notifications or only current

 $notifications = new Notification($user->data()->id, false, $dayLimit);
 }

/*
Load main navigation menus
*/
$main_nav_all = $db->query("SELECT * FROM menus WHERE menu_title='main' ORDER BY display_order");
/*
Set "results" to true to return associative array instead of object...part of db class
*/
$main_nav = $main_nav_all->results(true);
/*
Make menu tree
*/
$prep = prepareMenuTree($main_nav);

?>

<div class="navbar navbar-fixed-top navbar-default" role="navigation">
<div class="container-fluid">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header ">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_test" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<?php

if ($user->isLoggedIn())
 { //anyone is logged in
  ?>
<a class="navbar-brand" <a href="#"><i class="fa fa-fw fa-envelope-open"></i> UserSpice - <?php
 echo ($user->data()->email); ?></a>
<?php
 }
  else
 { // no one is logged in so display default items
  ?>
<a class="navbar-brand" <a href="#"><i class="fa fa-fw fa-envelope"></i> UserSpice</a>
<?php
 } //end of conditional for menu display
 ?>
</div>
<div id="navbar_test" class="navbar-collapse collapse">
<ul class="nav navbar-nav navbar-right">
<?php

foreach($prep as $key => $value)
 {
 $authorizedGroups = array();
 foreach(fetchGroupsByMenu($value['id']) as $g)
  {
  $authorizedGroups[] = $g->group_id;
  }

 /*
 Check if there are children of the current nav item...if no children, display single menu item, if children display dropdown menu
 */
 if (sizeof($value['children']) == 0)
  {
  if ($user->isLoggedIn())
   {
   if ((hasPerm($authorizedGroups, $user->data()->id) || in_array(0, $authorizedGroups)) && $value['logged_in'] == 1)
    {

    // if (checkMenu($value['id'],$user->data()->id) && $value['logged_in']==1) {

    if ($value['label'] == '{{notifications}}')
     {
     $itemString = '';
     if ($settings->notifications == 1)
      {
      $itemString = '<li><a href="#" onclick="displayNotifications(';
      $itemString.= "'new')";
      $itemString.= '"';
      $itemString.= 'id="notificationsTrigger" data-toggle="modal" data-target="#notificationsModal"  ><i class="glyphicon glyphicon-bell"></i> <span id="notifCount" class="badge" style="margin-top: -5px">';
      $itemString.= (($notifications->getUnreadCount() > 0) ? $notifications->getUnreadCount() : '');
      $itemString.= '</span></a></li>';
      }
     }
    elseif ($value['label'] == '{{messages}}')
     {
     $itemString = '';
     if ($settings->messaging == 1)
      {
      $itemString = '<li><a href="' . $us_url_root . 'users/messages.php"><i class="glyphicon glyphicon-envelope"></i> <span id="msgCount" class="badge" style="margin-top: -5px">';
      if ($msgC > 0) $itemString.= $msgC;
      $itemString.= '</span></a></li>';
      }
     }
      else
     {
     $itemString = prepareItemString($value, $user->data()->id);
     include $abs_us_root . $us_url_root . 'users/includes/template/database_navigation_hooks.php';

     include $abs_us_root . $us_url_root . 'usersc/includes/database_navigation_hooks.php';

     }

    echo $itemString;
    }
   }
    else
   {
   if ($value['logged_in'] == 0)
    {
    $itemString = prepareItemString($value, 0);
    include $abs_us_root . $us_url_root . 'users/includes/template/database_navigation_hooks.php';

    include $abs_us_root . $us_url_root . 'usersc/includes/database_navigation_hooks.php';

    echo $itemString;
    }
   }
  }
   else
  {
  if ($user->isLoggedIn())
   {
   if ((hasPerm($authorizedGroups, $user->data()->id) || in_array(0, $authorizedGroups)) && $value['logged_in'] == 1)
    {
    $dropdownString = prepareDropdownString($value, $user->data()->id);
    include $abs_us_root . $us_url_root . 'users/includes/template/database_navigation_hooks_dropdown.php';

    include $abs_us_root . $us_url_root . 'usersc/includes/database_navigation_hooks_dropdown.php';

    echo $dropdownString;
    }
   }
    else
   {
   if ($value['logged_in'] == 0)
    {
    $dropdownString = prepareDropdownString($value, 0);
    include $abs_us_root . $us_url_root . 'users/includes/template/database_navigation_hooks_dropdown.php';

    include $abs_us_root . $us_url_root . 'usersc/includes/database_navigation_hooks_dropdown.php';

    echo $dropdownString;
    }
   }
  }
 }

?>
</ul>
</div><!--/.nav-collapse -->
</div><!--/.container-fluid -->
</div>
