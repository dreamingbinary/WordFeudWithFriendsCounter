<?php
/* This guy will be responsible for saving the game's state */



/*****************
 * Saving the game's state
 ******************/

$state = json_encode($_POST);

if ( file_exists($tmp_dir) ){
  if( is_writeable($tmp_dir) ) {
    $filename = $tmp_dir . '/' . htmlentities($_POST['game_name'], ENT_QUOTES);

    # overwriting everything in file
    $fh = fopen($filename, "w");
    fwrite($fh, $state);
    fclose($fh);

  } else { // writeable
    $message .= "$tmp_dir is not writable";
  }
} else {
  if(  $res = mkdir($tmp_dir) ) {
    $message .= "Created directory successfully: $res.";
  } else {
    $message .= "Can't create temp directory: $res. ";
  }
} //checking existence of $tmp_dir


