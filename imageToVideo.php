<?php
$musicUrl = htmlspecialchars($_POST["musicUrl"]);
$urls = ["/prop0/001.jpg"]; // htmlspecialchars($_POST["images"]);
$profile_image =  // htmlspecialchars($_POST["profile_image"]);
$property = "test"; //htmlspecialchars($_POST["property"]);
$line_1 = htmlspecialchars($_POST["line_1"]);
$line_2 = htmlspecialchars($_POST["line_2"]);
$line_3 = htmlspecialchars($_POST["line_3"]);

$out = preg_replace('/[^a-zA-Z0-9.\']/', '_', $property);
$out = substr(str_replace(["'", " ", "."], '', $out),0, 20)."-".time()%1000000;
$pathToImg = "/home/shootingla/var/www/html/images/ffmpeg-image-to-video/".$out."/";
$pathToLZ = "/home/shootingla/var/www/html/images/ListingZen";

$font = 15; // Font Size (Can't change without changing the Watermark Image Size
$transition = 1; // In Seconds
$holdFrame = 2; // Hold the frame in Seconds
$fps = 30; // Frames per second

// Creating the folder
exec('mkdir '.$pathToImg.'/');

// Downloading the Music File
if($musicUrl)
    exec('wget  -O '.$pathToImg.'/music.mp3 '.$musicUrl);

// Copying the Images
foreach ($urls as $key=>$url) {
    $file = $pathToImg.basename($url);
    exec('cp '.$pathToLZ.$url." ".$file);
    exec('convert '.$file.' -resize 900x600 -background black -gravity center -extent 900x600 '.$file);
}
$images = glob($pathToImg."*.jpg");

exec("convert $pathToImg*.jpg -morph ".$transition*$fps." $pathToImg%07d.jpg");
$morphs = glob($pathToImg."0*.jpg");

$counter = 0;
foreach($morphs as $key=>$morph) {
    if($key % ($transition*$fps+1) == 0) {
        for($k=0; $k<$holdFrame*$fps; $k++) {
            exec('cp '.$morph.' '.$pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".jpg");
        }
    }
    exec('mv '.$morph.' '.$pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".jpg");
}

// Adding Agent Info
if($line_1 || $line_2 || $line_3) {
    if($line_2 && $line_3) {
        exec('convert -size 300x85 xc:"rgba(255,255,255,0.65)" -font Helvetica -pointsize '. $font .' -gravity North -draw "text 0,'. ($font+3) .' \''.$line_1.'\'" -draw "text 0,'. 2*($font+2) .' \''.$line_2.'\'" -draw "text 0,'. 3*($font+2) .' \''.$line_3.'\'" '.$pathToImg.'watermarkfile.png');
    } else if($line_2) {
        exec('convert -size 300x85 xc:"rgba(255,255,255,0.65)" -font Helvetica -pointsize '. $font .' -gravity North -draw "text 0,'. 2*($font-2) .' \''.$line_1.'\'" -draw "text 0,'. 2*($font+8) .' \''.$line_2.'\'" '.$pathToImg.'watermarkfile.png');
    } else {
        exec('convert -size 300x85 xc:"rgba(255,255,255,0.65)" -font Helvetica -pointsize '. $font .' -gravity Center -draw "text 0,0 \''.$line_1.'\'" '.$pathToImg.'watermarkfile.png');
    }
}

// Creating the original OUT video
if($musicUrl) {
    exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.jpg -i ".$pathToImg."music.mp3 -t ".count($images)*($transition+$holdFrame)." -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 -strict -2 ".$out.".mp4");
    $retVid = $out.".mp4";
} else {
    exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.jpg -t ".count($images)*($transition+$holdFrame)." -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 -strict -2 ".$out.".mp4");
    $retVid = $out.".mp4";
}

// Placing the watermark
if($profile_image && ($line_1 || $line_2 || $line_3)) {
    exec('ffmpeg -i '.$out.'.mp4 -i '.$pathToImg.'watermarkfile.png -filter_complex "overlay=92:main_h-92" -strict -2 '.$out.'.mp4');
    $retVid = $out.".mp4";
} else if ($line_1 || $line_2 || $line_3) {
    exec('ffmpeg -i '.$out.'.mp4 -i '.$pathToImg.'watermarkfile.png -filter_complex "overlay=(main_w-overlay_w)-7:main_h-overlay_h-7" -strict -2 '.$out.'.mp4');
    $retVid = $out.".mp4";
}
// Downloading The Agent Image
if($profile_image) {
    $profile = $pathToImg . basename($profile_image);
    exec('cp '.$pathToLZ.$profile_image.' '.$profile);
    exec('convert ' . $profile . ' -resize 85x85 -background black -gravity center -extent 85x85 ' . $profile);
    exec('ffmpeg -i ' . $out . '.mp4 -i ' . $profile . ' -filter_complex "overlay=7:main_h-overlay_h-7" -strict -2 '.$out.'.mp4');
    $retVid = $out."2.mp4";
}

// Deleting files
exec('rm -rf '.$pathToImg);

return $retVid;
?>
