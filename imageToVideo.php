<?php
$musicUrl = htmlspecialchars($_POST["musicUrl"]);
$urls = json_decode(htmlspecialchars($_POST["images"]));
$profile_image = "/agent400/agent1471642106.jpg";// htmlspecialchars($_POST["profile_image"]);
$property = '711 E. Windsor Rd, Pasadena, CA 91107 #405 %test';// htmlspecialchars($_POST["property"]);
$line_1 = "a very long name that isest";// htmlspecialchars($_POST["line_1"]);
$line_2 = "another long line for line 2";// htmlspecialchars($_POST["line_2"]);
$line_3 = "line 3";// htmlspecialchars($_POST["line_3"]);
$fps = 10;// htmlspecialchars($_POST['framerate'])/100; // Frames per second

function imageToVideo (array $urls, $property,
                       $fps = 20,
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
    exec('mkdir ' . $pathToImg . '/');

// Downloading the Music File
    if ($musicUrl) {
        printf("Downloaded Song: %s\n", $musicUrl);
        exec('wget  -O ' . $pathToImg . '/music.mp3 ' . $musicUrl);
    }

// Copying the Images
<<<<<<< HEAD
    foreach ($urls as $key => $url) {
        printf("Downloaded Image: %s\n", $url);
        $file = $pathToImg . "non-morphed" . basename($url) . ".jpg";
        exec('cp ' . $pathToLZ . $url . " " . $file);
        exec('convert ' . $file . ' -resize 600x400 -background black -gravity center -extent 600x400 ' . $file);
        if ($url == end($urls)) {
            exec('cp ' . $pathToLZ . $url . " " . $file);
            exec('convert ' . $file . ' -resize 600x400 -background black -gravity center -extent 600x400 ' . $file);
        }
=======
foreach ($urls as $key=>$url) {
    printf("Downloaded Image: %s\n", $url);
    $file = $pathToImg."non-morphed".basename($url);
    exec('cp '.$pathToLZ.$url." ".$file);
    exec('convert '.$file.' -resize 600x400 -background black -gravity center -extent 600x400 '.$file);
    if($url == end($urls)) {
        $file = $pathToImg."z-non-morphed".basename($url);
        exec('cp '.$pathToLZ.$url." ".$file);
        exec('convert '.$file.' -resize 600x400 -background black -gravity center -extent 600x400 '.$file);
>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d
    }

// Downloading and Compositing the profile image
<<<<<<< HEAD
    if ($profile_image) {
        printf("Downloading the agent Image: %s\n", $profile_image);
        $profile = $pathToImg . basename($profile_image);
        exec('cp ' . $pathToLZ . $profile_image . ' ' . $profile);
        exec('convert ' . $profile . ' -resize 120x120 -background none -gravity center -extent 120x120 ' . $pathToImg . 'profile.jpg');
        exec('rm -f' . $profile);
    }
=======
if($profile_image) {
    printf("Downloading the agent Image: %s\n", $profile_image);
    $profile = $pathToImg . basename($profile_image);
    exec('cp '.$pathToLZ.$profile_image.' '.$profile);
    exec('convert ' . $profile . ' -resize 120x120 -background none -gravity center -extent 120x120 '.$pathToImg.'profile.png');
}
>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d

// Creating the Lines
    $lines = "";
    if ($line_1)
        $lines .= " -fill 'rgba(0,0,0,0.95)' -gravity North -annotate +0+163 '$line_1' ";
    if ($line_2)
        $lines .= " -fill 'rgba(0,0,0,0.95)' -gravity North -annotate +0+193 '$line_2' ";
    if ($line_3)
        $lines .= " -fill 'rgba(0,0,0,0.95)' -gravity North -annotate +0+223 '$line_3' ";
    $lines = " -pointsize ".ceil($font*1.3)." -fill 'rgba(255,255,255,0.55)' -draw 'rectangle 10,10,590,390' -fill 'rgba(0,0,0,0.95)' -gravity center -annotate +0+107 '$property' " . $lines;
// Creating the watermark.png
    exec("convert -size 600x400 xc:'rgba(0,0,0,0)' -pointsize ".$font." -font Helvetica $lines " . $pathToImg . "watermark.png");

// Getting the last Image
<<<<<<< HEAD
    $images = glob($pathToImg . "non-morphed*");
    $lastImage = end($images);
=======
$images = glob($pathToImg."z-non-morphed*");
$lastImage = $images[0];
printf("Last Image is: %s\n", $lastImage);
>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d
// Creating the last Image
    exec("convert -size 600x400 -composite " . $lastImage . " " . $pathToImg . "watermark.png -depth 8 " . $lastImage);
    exec("convert -size 600x400 -composite " . $lastImage . " " . $pathToImg . "profile.png -geometry +240+30 -depth 8 " . $lastImage);

// Morphing The images
<<<<<<< HEAD
    printf("Morphed the Images.\n");
    exec("convert $pathToImg*.jpg -morph " . $transition * $fps . " " . $pathToImg . "morph-%07d.png");
=======
printf("Morphed the Images.\n");
exec("convert $pathToImg*non-morphed*.jpg -morph ".$transition*$fps." ".$pathToImg."morph-%07d.png");
>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d

// Getting all Morphs
    $morphs = glob($pathToImg . "morph-*.*");

// Creating the Morph Sequence
<<<<<<< HEAD
    $counter = 0;
    foreach ($morphs as $key => $morph) {
        if ($key % ($transition * $fps + 1) == 0) {
            printf("Created 30 copies of: %s\n", $morph);
            for ($k = 0; $k < $holdFrame * $fps; $k++) {
                exec('cp ' . $morph . ' ' . $pathToImg . str_pad($counter++, 8, '0', STR_PAD_LEFT) . ".png");
            }
            // Morphing the last image for extra $holdframe
            if ($morph == end($morphs)) {
                for ($k = 0; $k < $holdFrame * $fps; $k++) {
                    exec('cp ' . $morph . ' ' . $pathToImg . str_pad($counter++, 8, '0', STR_PAD_LEFT) . ".png");
                }
            }
        }
        printf("Renamed Image: %s\n", $morph);
        exec('mv ' . $morph . ' ' . $pathToImg . str_pad($counter++, 8, '0', STR_PAD_LEFT) . ".png");
=======
$counter = 0;
foreach($morphs as $key=>$morph) {
    if($key % ($transition*$fps+1) == 0) {
        printf("Created %d copies of: %s\n", $holdFrame, $morph);
        for($k=0; $k<$holdFrame*$fps; $k++) {
            exec('cp '.$morph.' '.$pathToImg.str_pad($counter++, 8, '0', STR_PAD_LEFT).".png");
        }
>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d
    }

// Creating the first Image
<<<<<<< HEAD
    exec("convert -size 600x400 -composite " . $pathToImg . "00000000.png " . $pathToImg . "watermark.png -depth 8 " . $pathToImg . "00000000.png");
    exec("convert -size 600x400 -composite " . $pathToImg . "00000000.png " . $pathToImg . "profile.png -geometry +240+30 -depth 8 " . $pathToImg . "00000000.png");

    if ($musicUrl) {
        printf("Created Original video with Music: %s\n", $musicUrl);
        exec("ffmpeg -r " . $transition * $fps . " -i " . $pathToImg . "%08d.png -i " . $pathToImg . "music.mp3 -t " . count($images) * ($transition + $holdFrame) . " -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 -strict -2 " . $out . ".mp4");
        $retVid = $out . ".mp4";
    } else {
        printf("Created Original video without Music.\n");
        exec("ffmpeg -r " . $transition * $fps . " -i " . $pathToImg . "%08d.png -t " . count($images) * ($transition + $holdFrame) . " -vf scale=600:400 -pix_fmt yuv420p -vcodec libx264 -strict -2 " . $out . ".mp4");
        $retVid = $out . ".mp4";
    }
=======
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
>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d

// Deleting files
    printf("Deleting the temp folder: %s\n", $pathToImg);
    exec('rm -rf ' . $pathToImg);

    return $retVid;
}

<<<<<<< HEAD
echo json_encode(array(
    "response" => [
        "status"=>"success",
        "message"=>"video_created"
    ],
    "links" => imageToVideo($urls, $property, $fps, $musicUrl, $profile_image, $line_1, $line_2, $line_3)
))
=======
return $retVid;

>>>>>>> 86cd47f3a32d6347f8e4b9b4052982b4be6b953d
?>
