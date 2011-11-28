<?php
/* handles reload the state of the last game */

if ($action=='load') {


  if ( isset($_REQUEST['game_name']) ) {
  
    $filename = $tmp_dir . '/' . htmlentities($_REQUEST['game_name'], ENT_QUOTES);

    if ( file_exists($filename) ) {
      $state = file_get_contents($filename);
      #print $state;
      #print "<hr>";
      $state = json_decode($state, true);

      #print_r($state);
      #print "<hr>";
      #print_r($_POST);

      $_POST = array_merge($_POST, $state);

      #print "<hr>";
      #print_r($_POST);

    } else {
      $message .= "Sorry, could not load that game. Please try again or start over.";
    }

  } else {
    $message .= "Messing around with query string incorrectly?";
  }  


} else {
  #$message .= "No load";

}


