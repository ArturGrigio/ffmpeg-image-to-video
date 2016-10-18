<?php
$musicUrl = (isset($_POST['musicUrl'])) ? htmlspecialchars($_POST["musicUrl"]) : null;
$urls = json_decode(htmlspecialchars($_POST["urls"]));
$profile_image = (isset($_POST['profile_image'])) ? htmlspecialchars($_POST["profile_image"]) : null;
$property = (isset($_POST['property'])) ? htmlspecialchars($_POST["property"]) : "ListingZen Property";
$line_1 = htmlspecialchars($_POST["line_1"]);
$line_2 = htmlspecialchars($_POST["line_2"]);
$line_3 = htmlspecialchars($_POST["line_3"]);
$fps = (isset($_POST['framerate'])) ? htmlspecialchars($_POST['framerate']) : 20;

function imageToVideo (array $urls, $property, $fps,
                       $musicUrl = null,
                       $profile_image = null,
                       $line_1 = null,
                       $line_2 = null,
                       $line_3 = null) {

    $font = 18; // Font Size (Can't change without changing the Watermark Image Size
    $transition = 1; // In Seconds
    $holdFrame = 2; // Hold the frame in Seconds
    $out = preg_replace('/[^a-zA-Z0-9.\']/', '_', $property);
    $out = substr(str_replace(["'", " ", "."], '', $out), 0, 20) . "-" . time() % 1000000;
    $pathToImg = "/home/shootingla/var/www/html/images/ffmpeg-image-to-video/" . $out . "/";
    $pathToLZ = "/home/shootingla/var/www/html/images/ListingZen";

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
if($profile_image)
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
if($profile_image)
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
    //exec('rm -rf '.$pathToImg);
    return $retVid;
}

echo json_encode(array(
    "response" => [
        "status"=>"success",
        "message"=>"video_created"
    ],
    "link" => imageToVideo($urls, $property, $fps, $musicUrl, $profile_image, $line_1, $line_2, $line_3)
))
?>
