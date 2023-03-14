<?php

$search_query = 'old radios';
$url = 'https://www.google.com/search?q=' . urlencode($search_query) . '&tbm=isch';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.102 Safari/537.36');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$html = curl_exec($ch);
if ($html === false) {
    echo 'Error retrieving data from Google Images';
    exit();
}

curl_close($ch);

preg_match_all('/<img[^>]+>/i', $html, $matches);
$image_tags = $matches[0];

if (count($image_tags) == 0) {
    echo 'No image results found';
    exit();
}

$filtered_images = array();
foreach ($image_tags as $tag) {
    preg_match('/src="([^"]+)/i', $tag, $image);
    preg_match('/alt="([^"]+)/i', $tag, $alt);
    preg_match('/class="([^"]+)/i', $tag, $class);
    preg_match('/width="([^"]+)/i', $tag, $width);
    preg_match('/height="([^"]+)/i', $tag, $height);
    $size = (int) $width[1] * (int) $height[1];
    if (strpos($class[1], 'rg_i rg_sz') === false && $size >= 50000) {
        $filtered_images[] = array('url' => $image[1], 'alt' => $alt[1]);
    }
}

if (count($filtered_images) == 0) {
    echo 'No image results found';
    exit();
}

$random_image = $filtered_images[array_rand($filtered_images)];
?>

<html>
<head>
    <title>Random Image</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        img {
            display: block;
            margin: auto;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <a href="<?php echo $random_image['url']; ?>" target="_blank">
        <img src="<?php echo $random_image['url']; ?>" alt="<?php echo $random_image['alt']; ?>">
    </a>
</body>
</html>
