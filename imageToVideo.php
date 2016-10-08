<?php
$musicUrl = "https://listingzen.com/music/Piano.mp3";
$urls = array( "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/001.jpg&w=900&h=600&fill-to-fit=d8d8d8", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/002.jpg&w=900&h=600&fill-to-fit=d8d8d8", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/003.jpg&w=900&h=600&fill-to-fit=d8d8d8", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/004.jpg&w=900&h=600&fill-to-fit=d8d8d8" );
$property = "711 E. ";

$agent_name = "Artur Grigio";
$agent_phone = "(626) 555-1234";
$agent_email = "test@yahoo.com";

$out = preg_replace('/[^a-zA-Z0-9.\']/', '_', $property);
$out = substr(str_replace(["'", " ", "."], '', $out),0, 20)."-".time()%1000000;
$pathToImg = $out."/";

$font = 15; // Font Size (Can't change without changing the Watermark Image Size
$transition = 1; // In Seconds
$holdFrame = 2; // Hold the frame in Seconds
$fps = 30; // Frames per second

// Creating the folder
mkdir("./$pathToImg");

// Downloading the Music File
file_put_contents($pathToImg."music.mp3", fopen($musicUrl, 'r'));
// Downloading the Images
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
    exec('convert -size 300x82 xc:white -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$agent_name.'\'" -draw "text 0,'. 2*($font+1) .' \'Phone: '.$agent_phone.'\'" -draw "text 0,'. 3*($font+1) .' \'E-Mail: '.$agent_email.'\'" '.$pathToImg.'watermarkfile.jpg');
else if($agent_phone)
    exec('convert -size 300x65 xc:white -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$agent_name.'\'" -draw "text 0,'. 2*($font+1) .' \'Phone: '.$agent_phone.'\'" '.$pathToImg.'watermarkfile.jpg');
else
    exec('convert -size 300x40 xc:white -font Arial -pointsize '. $font .' -gravity Center -draw "text 0,0 \''.$agent_name.'\'" '.$pathToImg.'watermarkfile.jpg');


// Creating the original OUT video
exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.jpg -i ".$pathToImg."music.mp3 -t ".count($images)*($transition+$holdFrame)." -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 ".$pathToImg.$out.".mp4");

// Placing the watermark
exec('ffmpeg -i '.$pathToImg.$out.'.mp4 -i '.$pathToImg.'watermarkfile.jpg -filter_complex "overlay=(main_w-overlay_w)-7:main_h-overlay_h-7" '.$out.'.mp4');

// Deleting files
exec('rm -rf ./'.$pathToImg);

?>
