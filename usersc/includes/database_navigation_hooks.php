<?php
/*Include your custom hooks here! Examples: */
  // $itemString = str_replace('{{lname}}',$user->data()->lname,$itemString);
  $itemString = parse_menu_hook('{{image_manager}}',lang("MENU_IMAGE_MANAGER"),$itemString);
  $itemString = parse_menu_hook('{{about}}',lang("MENU_ABOUT"),$itemString);
  $itemString = parse_menu_hook('{{menu_catalog}}',lang("MENU_RESEARCH_CATALOG"),$itemString);
  $itemString = parse_menu_hook('{{menu_help}}',lang("MENU_HELP"),$itemString);
 ?>
