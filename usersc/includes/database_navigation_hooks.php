<?php
/*Include your custom hooks here! Examples: */
  // $itemString = str_replace('{{lname}}',$user->data()->lname,$itemString);
  $itemString = parse_menu_hook('{{image_manager}}',lang("MENU_IMAGE_MANAGER"),$itemString);
  $itemString = parse_menu_hook('{{about}}',lang("MENU_ABOUT"),$itemString);
  $itemString = parse_menu_hook('{{menu_catalog}}',lang("MENU_RESEARCH_CATALOG"),$itemString);
  $itemString = parse_menu_hook('{{menu_help}}',lang("MENU_HELP"),$itemString);
  $itemString = parse_menu_hook('{{tutorials}}', lang("TAB_TUTORIALS"), $itemString);
  $itemString = parse_menu_hook('{{data_analysis}}', lang("TAB_SERVICES"), $itemString);
  $itemString = parse_menu_hook('{{catalog}}', lang("CATALOG_MENU_ITEM"), $itemString);
 ?>
