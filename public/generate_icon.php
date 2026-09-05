<?php
$sourceFile = __DIR__ . '/assets/logo.png';
$destFile = __DIR__ . '/assets/pwa-icon.png';
$targetSize = 512;

$sourceImage = imagecreatefrompng($sourceFile);
$sourceWidth = imagesx($sourceImage);
$sourceHeight = imagesy($sourceImage);

$scale = min($targetSize / $sourceWidth, $targetSize / $sourceHeight);
$newWidth = (int)($sourceWidth * $scale);
$newHeight = (int)($sourceHeight * $scale);

$targetImage = imagecreatetruecolor($targetSize, $targetSize);
// Make background white
$bgColor = imagecolorallocate($targetImage, 255, 255, 255);
imagefill($targetImage, 0, 0, $bgColor);

$offsetX = (int)(($targetSize - $newWidth) / 2);
$offsetY = (int)(($targetSize - $newHeight) / 2);

// Enable alpha blending and save alpha flag
imagealphablending($targetImage, true);
imagesavealpha($targetImage, true);

imagecopyresampled(
    $targetImage, $sourceImage,
    $offsetX, $offsetY, 0, 0,
    $newWidth, $newHeight, $sourceWidth, $sourceHeight
);

imagepng($targetImage, $destFile);
imagedestroy($sourceImage);
imagedestroy($targetImage);

echo "PWA Icon generated successfully at $destFile\n";
