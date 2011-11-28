<?php
require_once('globals.php');

include_once('reload-game.php');


if( isset($_POST['gametype']) ) 
    $gametype = $_POST['gametype'];
else 
    $gametype = 'wf';

//print_r($_POST);

?>
<html><head><title>Wordfeud | WordsWithFriends | Letter Counter</title>
<style type="text/css" media="all">
body {font-size: 1em; font-family: Verdana;}
h1 {font-size: 1.5em; color: red; }
label {font-style: italic;}
input[type="text"], textarea { 
  font-family: "Courier New", monospace; 
  font-size: 14px; 
  font-weight: bold;
  letter-spacing: 3px;
}
#saved-games{ border: 1px solid grey; padding: 5px 5px;  float: right; 
  overflow: scroll;
  width: 300px; min-height: 230px; max-height: 350px;
  margin-top: -250px;
}
</style>
</head>
<body>
<h1>Wordfeud | WordsWithFriends | Letter Counter</h1>
<a href="./" target="_blank">[ NEW ]</a>
<hr>
<form method='POST' action='index.php'>

<input type="radio" name="gametype" value="wf" <?php if($gametype=='wf') print 'checked="checked"';?> /> <label>Wordfeud</label>
<input type="radio" name="gametype" value="wwf" <?php if($gametype=='wwf') print 'checked="checked"';?> /> <label>WordWithFriend</label>
<br>

<label>Words on the board, skip letters that join:</label> <br>
<textarea name="board" rows="8" cols="40"><?php print isset($_POST['board'])?$_POST['board']:"";?></textarea> <br>

<label>Your tiles:</label><input type="text" name="yourtiles" value="<?php print isset($_POST['yourtiles'])?$_POST['yourtiles']:"";?>" />
<br>
Save game with name: <input type="text" name="game_name" value="<?PHP print isset($_POST['game_name']) ? $_POST['game_name'] : date("Ymd-"); ?>">
<br>
<input type="submit" />
<input type="hidden" name="action" value="count" />

</form>

<div id='saved-games'>
Saved Games
<hr>
<ul>
<?php
$files = scandir($tmp_dir);
unset($files[0], $files[1]);#TODO: hack, this only applies to linux directories (".","..")?
#print_r($files);
foreach($files as $f){
  print "<li><a href='?action=load&game_name=$f'>$f</a></li>";
}
?>
</ul>
</div>
<?php 
if( $action == 'count' ){

    # saves the game state
    include_once('save-game.php');

    if( $_POST['gametype'] == "wf" ){
        include('wordfeud.inc.php');
    }
    else {
        include('wordwithfriends.inc.php');
    }

    #print "<hr><strong>Total number of playable tiles:</strong> {$alphabet['total']}<br>\n";

    #$keys = array_keys($alphabet);
    #foreach($keys as $a){ print ord($a) . ',';}


    //counters
    $totalPlayed=0; 
    $wilds = array();



    # Temp array
    $remainingLetters = $alphabet; 
    unset($remainingLetters['total']);//just getting rid of this because we don't need it

    # Existing known tiles
    $knownTiles =  
        str_split( 
            strtolower( 
                $_POST['board'] 
                . $_POST['yourtiles']  
            ) 
        ); 


    # Counting what we have, storing into $remainingLetters
    $totalKnownTiles = count($knownTiles);
    for($i=0; $i < $totalKnownTiles; $i++)
    {

        $k = $knownTiles[$i];

        # if character is in [a-z]
        if( ( ord($k) >= 97 && ord($k) <=122 ) || ord($k) == 42) { 
            #no white spaces, proceed as normal

            $totalPlayed++; 

            # Count wildcard letters
            if( ord($k)==42 ) $remainingLetters['wild']--;
            else $remainingLetters[$k]--;
        }
        else
        {
            # Get rid of "whitespace" characters
            # so it doesn't foobar our counts down below
            unset($knownTiles[$i]);
        }
        #print "count: . " . count($knownTiles). "<br> ";
    }
    unset($i);

    print "<hr>";
    print "<strong>Total Played (includes your tiles):</strong> " . $totalPlayed . "<br>\n"; 
    print "================<br>\n";


    print '<div id="remainingLetters">';
    print "<strong>Tiles Remaining:</strong><br>================<br>";
        $keys = array_keys($remainingLetters);
        $total = 0;
        foreach($keys as $k){
            
            if( $remainingLetters[$k] > 0 || $remainingLetters[$k] < 0 ){
                print $k . '=>' . $remainingLetters[$k] . "<br>\n";
                $total += $remainingLetters[$k];
            }
        }
        print "================<br>\n";
        print "<strong>Total:</strong> " . ( $total ) ;
    print '</div>';
}
print '<hr>';
print $message;
#print '<hr>';
#print_r($_POST);
?>
</body>
</html>
