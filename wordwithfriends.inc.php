<?php
# WordWithFriends

$alphabet['a'] = 9;
$alphabet['b'] = 2;
$alphabet['c'] = 2;
$alphabet['d'] = 5;
$alphabet['e'] = 13;
$alphabet['f'] = 2;
$alphabet['g'] = 3;
$alphabet['h'] = 4;
$alphabet['i'] = 8;
$alphabet['j'] = 1;
$alphabet['k'] = 1;
$alphabet['l'] = 4;
$alphabet['m'] = 2;
$alphabet['n'] = 5;
$alphabet['o'] = 8;
$alphabet['p'] = 2;
$alphabet['q'] = 1;
$alphabet['r'] = 6;
$alphabet['s'] = 5;
$alphabet['t'] = 7;
$alphabet['u'] = 4;
$alphabet['v'] = 2;
$alphabet['w'] = 2;
$alphabet['x'] = 1;
$alphabet['y'] = 2;
$alphabet['z'] = 1;
$alphabet['wild'] = 2;

$total = 0;
foreach($alphabet as $a){
    $total += $a;
}
$alphabet['total'] = $total;
unset($a,$total);
?>
