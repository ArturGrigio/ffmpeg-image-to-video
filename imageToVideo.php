<?php

    $pathToImg = "./";
    $pathToMusic = "./";
    $music = "jass.mp3";
    $postfix = "morph";
    $transition = 1; // In Seconds
    $holdFrame = 1; // Hold the frame in Seconds
    $fps = 30; // Frames per second

    $images = glob("$pathToImg*.jpg");
    exec("convert $pathToImg*.jpg -morph ".$transition*$fps." $pathToImg%08d\-$postfix.jpg");
    $morphs = glob("$pathToImg*$postfix.jpg");
    $counter = 0;
    foreach($morphs as $key=>$morph) {
        if($key % ($transition*$fps+1) == 0) {
            for($k=0; $k<$holdFrame*$fps; $k++) {
                copy($pathToImg.$morph,$pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT)."$postfix.jpg");
            }
        }
        rename($pathToImg.$morph, $pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT)."$postfix.jpg");
    }
    exec("ffmpeg -r ".$transition*$fps." -i $pathToImg%08d$postfix.jpg -i $pathToMusic$music -t ".count($images)*($transition+$holdFrame)." -c:v mpeg4 $pathToImg"."out.mp4");
    exec("rm $pathToImg*$postfix.jpg");

    exec('convert -size 500x500 xc:none -font Arial -pointsize 20 -gravity NorthWest -draw "text 0,0 \'Artur Grigio\'" -draw "text 0,24 \'test\'" watermarkfile.png');
    exec('ffmpeg -i out.mp4 -i watermarkfile.png -filter_complex "overlay=10:15" birds1.mp4')

?>
