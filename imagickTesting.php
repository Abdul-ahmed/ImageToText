<?php

function resizeImage()
{
    $img = new Imagick($_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg");
    $img->resizeImage(100,null,null,null,null);
    $img->writeImage($_SERVER['DOCUMENT_ROOT']."/images/resizeImage.jpeg");
    echo "<img src=\"images/fromogayusuf.jpeg\">";
    echo "<img src=\"images/resizeImage.jpeg\">";
}

function resizeImageSource() {
    $imagePath = $_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg";
    $width = 1000;
    $height = 500;
    $filterType = imagick::FILTER_UNDEFINED;
    $blur = 0.0;
    $bestFit = false;
    // $legacy = false;
    // $cropZoom;

    //The blur factor where > 1 is blurry, < 1 is sharp.
    $imagick = new \Imagick(realpath($imagePath));

    $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);

    // $cropWidth = $imagick->getImageWidth();
    // $cropHeight = $imagick->getImageHeight();

    // if ($cropZoom) {
    //     $newWidth = $cropWidth / 2;
    //     $newHeight = $cropHeight / 2;

    //     $imagick->cropimage(
    //         $newWidth,
    //         $newHeight,
    //         ($cropWidth - $newWidth) / 2,
    //         ($cropHeight - $newHeight) / 2
    //     );

    //     $imagick->scaleimage(
    //         $imagick->getImageWidth() * 4,
    //         $imagick->getImageHeight() * 4
    //     );
    // }


    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

function contrastStretchImage()
{
    $im = new Imagick($_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg");
    list($width, $height) = array_values($im->getImageGeometry ());
    $im->modulateImage(100, 0, 100);
    $im->contrastStretchImage($width * $height * 0.90, $width * $height * 0.95);
    $im->writeImage($_SERVER['DOCUMENT_ROOT']."/images/contrastStretchImage.jpeg");
    echo "<img src=\"images/fromogayusuf.jpeg\">";
    echo "<img src=\"images/contrastStretchImage.jpeg\">";
}

function mask()
{
    $width = 480;
    $height = 360;
    $mask = new Imagick();
    $mask->newImage($width, $height, "black");
    $draw = new ImagickDraw();
    $draw->setFillColor("white");
    $draw->ellipse($width / 2, $height / 2, $width * 5 / 12, $height * 5 / 12, 0, 360);
    $mask->drawImage($draw);
    $mask->blurImage(0, 50);
    $mask->contrastStretchImage(10, 125000);
    $mask->writeImage($_SERVER['DOCUMENT_ROOT']."/images/mask.jpeg");
    echo "<img src=\"images/mask.jpeg\">";
}

function edgeImage() {
    $imagePath = $_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg";
    $radius = 0;
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->edgeImage($radius);
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

function enhanceImage() {
    $imagePath = $_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg";
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->enhanceImage();
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

function normalizeImage()
{
    $imagePath = $_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg";
    $channel = imagick::CHANNEL_RED;
    $imagick = new \Imagick(realpath($imagePath));
    $original = clone $imagick;
    $original->cropimage($original->getImageWidth() / 2, $original->getImageHeight(), 0, 0);
    $imagick->normalizeImage($channel);
    $imagick->compositeimage($original, \Imagick::COMPOSITE_ATOP, 0, 0);
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

function adaptiveSharpenImage()
{
    try {
        $image = new Imagick($_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg");
        $radius = 1;
        $sigma = 1;
        $image->adaptiveSharpenImage($radius, $sigma);
        $image->writeImage($_SERVER['DOCUMENT_ROOT']."/images/adaptiveSharpenImage.jpeg");
    } catch(ImagickException $e) {
        echo 'Error: ' , $e->getMessage();
        die();
    }
    header('Content-type: image/png');
    // echo $image;
    echo "<img src=\"images/fromogayusuf.jpeg\">";
    echo "<img src=\"images/adaptiveSharpenImage.jpeg\">";
}

function sharpenImage() {
    $imagePath = $_SERVER['DOCUMENT_ROOT']."/images/fromogayusuf.jpeg";
    $radius = 2;
    $sigma = 1.0;
    // $channel = Imagick::CHANNEL_DEFAULT;
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->sharpenimage($radius, $sigma);
    header("Content-Type: image/jpg");
    $imagick->writeImage($_SERVER['DOCUMENT_ROOT']."/images/sharpenImage.jpeg");
    echo $imagick->getImageBlob();
}

function brightnessContrastImage($imagePath, $brightness, $contrast, $channel) {
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->brightnessContrastImage($brightness, $contrast, $channel);
    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

sharpenImage();

