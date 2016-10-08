<?php

$pathToImg = "./images/";
$pathToMusic = "./music/";
$music = "jass.mp3";
$agent_name = "artur grigio";
$agent_phone = "(626) 555-1234";
$agent_email = "test@yahoo.com";
$font = 15;

$transition = 1; // In Seconds
$holdFrame = 2; // Hold the frame in Seconds
$fps = 30; // Frames per second

$images = glob("$pathToImg*.jpg");

exec("convert $pathToImg*.jpg -morph ".$transition*$fps." $pathToImg%07d.jpg");
$morphs = glob($pathToImg."0*.jpg");

$counter = 0;
foreach($morphs as $key=>$morph) {
    if($key % ($transition*$fps+1) == 0) {
        for($k=0; $k<$holdFrame*$fps; $k++) {
            copy($morph, $pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".jpg");
        }
    }
    rename($morph, $pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".jpg");
}
// Creating the original OUT video
exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.jpg -i ".$pathToMusic.$music." -t ".count($images)*($transition+$holdFrame)." -c:v mpeg4 out.mp4");
// Adding Agent Info
if($agent_phone && $agent_email)
    exec('convert -size 500x500 xc:none -font Arial -pointsize '. $font .' -gravity NorthWest -draw "text 0,0 \''.$agent_name.'\'" -draw "text 0,'. ($font+1) .' \'Phone: '.$agent_phone.'\'" -draw "text 0,'. 2*($font+1) .' \'E-Mail: '.$agent_email.'\'" watermarkfile.png');
else if($agent_phone)
    exec('convert -size 500x500 xc:none -font Arial -pointsize '. $font .' -gravity NorthWest -draw "text 0,0 \''.$agent_name.'\'" -draw "text 0,'. ($font+1) .' \'Phone: '.$agent_phone.'\'" watermarkfile.png');
else
    exec('convert -size 500x500 xc:none -font Arial -pointsize '. $font .' -gravity NorthWest -draw "text 0,0 \''.$agent_name.'\'" watermarkfile.png');

// Placing the watermark
exec('ffmpeg -i out.mp4 -i watermarkfile.png -filter_complex "overlay=7:7" finished.mp4');

// Deleting files
exec("rm $pathToImg"."0*.jpg");
exec('rm ./watermarkfile.png');
exec('rm ./out.mp4');

?>
