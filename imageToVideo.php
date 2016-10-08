<?php
$urls = array( "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/001.jpg&w=900&h=600&fill-to-fit=d8d8d8", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/002.jpg&w=900&h=600&fill-to-fit=d8d8d8", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/003.jpg&w=900&h=600&fill-to-fit=d8d8d8" );

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

foreach ($urls as $key=>$url) {
    file_put_contents($pathToImg.$key.".jpg", fopen($url, 'r'));
}
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

// Adding Agent Info
if($agent_phone && $agent_email)
    exec('convert -size 300x80 xc:white -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$agent_name.'\'" -draw "text 0,'. 2*($font+1) .' \'Phone: '.$agent_phone.'\'" -draw "text 0,'. 3*($font+1) .' \'E-Mail: '.$agent_email.'\'" watermarkfile.png');
else if($agent_phone)
    exec('convert -size 300x80 xc:white -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$agent_name.'\'" -draw "text 0,'. 2*($font+1) .' \'Phone: '.$agent_phone.'\'" watermarkfile.png');
else
    exec('convert -size 300x80 xc:white -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$agent_name.'\'" watermarkfile.png');


// Creating the original OUT video
exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.jpg -i ".$pathToMusic.$music." -t ".count($images)*($transition+$holdFrame)." -vf scale=600:400 -c:v mpeg4 out.mp4");

// Placing the watermark
exec('ffmpeg -i out.mp4 -i watermarkfile.png -filter_complex "overlay=(main_w-overlay_w)-7:main_h-overlay_h-7" finished.mp4');

// Deleting files
exec("rm $pathToImg"."0*.jpg");
exec('rm ./watermarkfile.png');
exec('rm ./out.mp4');

?>
