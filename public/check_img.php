<?php
$s = getimagesize('public/assets/logo.png');
echo 'logo: ' . $s[0] . 'x' . $s[1] . "\n";
$s2 = getimagesize('public/assets/logo1.png');
echo 'logo1: ' . $s2[0] . 'x' . $s2[1] . "\n";
