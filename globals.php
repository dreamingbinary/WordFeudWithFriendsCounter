<?php
/* Global file, contains global variables, etc. */

// Where to write files to...
$tmp_dir = 'tmp';

// Prints stuff at the bottom.
$message = ''; #initializing




if( isset($_REQUEST['action']) ) $action = $_REQUEST['action'];
else $action = 'default';


