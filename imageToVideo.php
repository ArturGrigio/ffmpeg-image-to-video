<?php
$musicUrl = htmlspecialchars($_POST["musicUrl"]);
printf("Music: %s\n", $musicUrl);
$urls = ['/prop0/001.jpg', '/prop0/002.jpg'];// json_decode(htmlspecialchars($_POST["images"]));
$profile_image = "/agent400/agent1471642106.jpg";// htmlspecialchars($_POST["profile_image"]);
$property = '711 E. Windsor Rd, Pasadena, CA 91107 #405 %test';// htmlspecialchars($_POST["property"]);
printf("Property: %s\n", $property);
$line_1 = "a very long name that isest";// htmlspecialchars($_POST["line_1"]);
$line_2 = "another long line for line 2";// htmlspecialchars($_POST["line_2"]);
$line_3 = "line 3";// htmlspecialchars($_POST["line_3"]);

$out = preg_replace('/[^a-zA-Z0-9.\']/', '_', $property);
$out = substr(str_replace(["'", " ", "."], '', $out),0, 20)."-".time()%1000000;
$pathToImg = "/home/shootingla/var/www/html/images/ffmpeg-image-to-video/".$out."/";
$pathToLZ = "/home/shootingla/var/www/html/images/ListingZen";

$font = 18; // Font Size (Can't change without changing the Watermark Image Size
$transition = 1; // In Seconds
$holdFrame = 2; // Hold the frame in Seconds
$fps = 10;// htmlspecialchars($_POST['framerate'])/100; // Frames per second

// Creating the folder
printf("Made Folder %s \n", $pathToImg);
exec('mkdir '.$pathToImg.'/');

// Downloading the Music File
if($musicUrl) {
    printf("Downloaded Song: %s\n", $musicUrl);
    exec('wget  -O '.$pathToImg.'/music.mp3 '.$musicUrl);
}

// Copying the Images
foreach ($urls as $key=>$url) {
    printf("Downloaded Image: %s\n", $url);
    $file = $pathToImg."non-morphed".basename($url);
    exec('cp '.$pathToLZ.$url." ".$file);
    exec('convert '.$file.' -resize 600x400 -background black -gravity center -extent 600x400 '.$file);
    if($url == end($urls)) {
        $file = $pathToImg."z-non-morphed".basename($url);
        exec('cp '.$pathToLZ.$url." ".$file);
        exec('convert '.$file.' -resize 600x400 -background black -gravity center -extent 600x400 '.$file);
    }
}

// Downloading and Compositing the profile image
if($profile_image) {
    printf("Downloading the agent Image: %s\n", $profile_image);
    $profile = $pathToImg . basename($profile_image);
    exec('cp '.$pathToLZ.$profile_image.' '.$profile);
    exec('convert ' . $profile . ' -resize 120x120 -background none -gravity center -extent 120x120 '.$pathToImg.'profile.png');
}

// Creating the Lines
$lines = "";
if ($line_1)
    $lines .= " -fill 'rgba(0,0,0,0.95)' -gravity North -annotate +0+163 '$line_1' ";
if ($line_2)
    $lines .= " -fill 'rgba(0,0,0,0.95)' -gravity North -annotate +0+193 '$line_2' ";
if ($line_3)
    $lines .= " -fill 'rgba(0,0,0,0.95)' -gravity North -annotate +0+223 '$line_3' ";
$lines = " -pointsize 20 -fill 'rgba(255,255,255,0.55)' -draw 'rectangle 10,10,590,390' -fill 'rgba(0,0,0,0.95)' -gravity center -annotate +0+107 '$property' ".$lines;
// Creating the watermark.png
exec("convert -size 600x400 xc:'rgba(0,0,0,0)' -pointsize 18 -font Helvetica $lines ".$pathToImg."watermark.png");

// Getting the last Image
$images = glob($pathToImg."z-non-morphed*");
$lastImage = $images[0];
printf("Last Image is: %s\n", $lastImage);
// Creating the last Image
exec("convert -size 600x400 -composite ".$lastImage." ".$pathToImg."watermark.png -depth 8 ".$lastImage);
exec("convert -size 600x400 -composite ".$lastImage." ".$pathToImg."profile.png -geometry +240+30 -depth 8 ".$lastImage);

// Morphing The images
printf("Morphed the Images.\n");
exec("convert $pathToImg*non-morphed*.jpg -morph ".$transition*$fps." ".$pathToImg."morph-%07d.png");

// Getting all Morphs
$morphs = glob($pathToImg."morph-*.*");

// Creating the Morph Sequence
$counter = 0;
foreach($morphs as $key=>$morph) {
    if($key % ($transition*$fps+1) == 0) {
        printf("Created %d copies of: %s\n", $holdFrame, $morph);
        for($k=0; $k<$holdFrame*$fps; $k++) {
            exec('cp '.$morph.' '.$pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".png");
        }
    }
    printf("Renamed Image: %s\n", $morph);
    exec('mv '.$morph.' '.$pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".png");
}

// Creating the first Image
exec("convert -size 600x400 -composite ".$pathToImg."00000000.png ".$pathToImg."watermark.png -depth 8 ".$pathToImg."00000000.png");
exec("convert -size 600x400 -composite ".$pathToImg."00000000.png ".$pathToImg."profile.png -geometry +240+30 -depth 8 ".$pathToImg."00000000.png");

if($musicUrl) {
    printf("Created Original video with Music: %s\n", $musicUrl);
    exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.png -i ".$pathToImg."music.mp3 -t ".count($morphs)*($transition+$holdFrame)." -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 -strict -2 ".$out.".mp4");
    $retVid = $out.".mp4";
} else {
    printf("Created Original video without Music.\n");
    exec("ffmpeg -r ".$transition*$fps." -i ".$pathToImg."%08d.png -t ".count($morphs)*($transition+$holdFrame)." -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 -strict -2 ".$out.".mp4");
    $retVid = $out.".mp4";
}

// Deleting files
printf("Deleting the temp folder: %s\n", $pathToImg);
exec('rm -rf '.$pathToImg);

return $retVid;

?>
