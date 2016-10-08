<?php
$musicUrl = "https://listingzen.com/music/Piano.mp3";
$urls = array( "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/001.jpg", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/002.jpg", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop0/003.jpg", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop2/prop2-006.jpg", "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/prop4657/4337MarinaCityDrPH43Reshoot-001.jpg" );
$profile_image = "https://shootinglacloud.com/images/ListingZen/mos/cimage/webroot/img.php?src=/agent2/agent1469316620.jpg";
$property = "711 E. Windsor Rd. ";
$line_1 = "Artur Grigio";
$line_2 = "(626) 555-1234";
$line_3 = "test@yahoo.com";

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

//// Downloading the Images
foreach ($urls as $key=>$url) {
    $file = $pathToImg.basename($url);
    file_put_contents($file, fopen($url, 'r'));
    exec('convert '.$file.' -resize 900x600 -background black -gravity center -extent 900x600 '.$file);
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
if($line_2 && $line_3)
    exec('convert -size 300x82 xc:"rgba(255,255,255,0.65)" -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$line_1.'\'" -draw "text 0,'. 2*($font+1) .' \''.$line_2.'\'" -draw "text 0,'. 3*($font+1) .' \''.$line_3.'\'" '.$pathToImg.'watermarkfile.png');
else if($line_2)
    exec('convert -size 300x65 xc:"rgba(255,255,255,0.65)" -font Arial -pointsize '. $font .' -gravity North -draw "text 0,'. $font .' \''.$line_1.'\'" -draw "text 0,'. 2*($font+1) .' \''.$line_2.'\'" '.$pathToImg.'watermarkfile.png');
else
    exec('convert -size 300x40 xc:"rgba(255,255,255,0.65)" -font Arial -pointsize '. $font .' -gravity Center -draw "text 0,0 \''.$line_1.'\'" '.$pathToImg.'watermarkfile.png');


// Creating the original OUT video
exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.jpg -i ".$pathToImg."music.mp3 -t ".count($images)*($transition+$holdFrame)." -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 ".$pathToImg.$out.".mp4");

// Placing the watermark
exec('ffmpeg -i '.$pathToImg.$out.'.mp4 -i '.$pathToImg.'watermarkfile.png -filter_complex "overlay=(main_w-overlay_w)-7:main_h-overlay_h-7" '.$out.'.mp4');
$retVid = $out.".mp4";
// Downloading The Agent Image
if($profile_image) {
    $profile = $pathToImg . basename($profile_image);
    file_put_contents($profile, fopen($profile_image, 'r'));
    exec('convert ' . $profile . ' -resize 85x85 -background black -gravity center -extent 85x85 ' . $profile);
    exec('ffmpeg -i ' . $out . '.mp4 -i ' . $profile . ' -filter_complex "overlay=7:main_h-overlay_h-7" ' . $out . '2.mp4');
    $retVid = $out."2.mp4";
}

// Deleting files
exec('rm -rf ./'.$pathToImg);

return $retVid;
?>
