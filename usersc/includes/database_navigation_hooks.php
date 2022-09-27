<?php
/*Include your custom hooks here! Examples: */
  // $itemString = str_replace('{{lname}}',$user->data()->lname,$itemString);
  $itemString = parse_menu_hook('{{image_manager}}',lang("MENU_IMAGE_MANAGER"),$itemString);
 ?>
