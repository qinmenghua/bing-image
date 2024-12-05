<?php
// 设置时区
date_default_timezone_set("Asia/Shanghai");

// 获取 Bing 图片 API 数据
function getBingDailyImage() {
    $url = "https://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=zh-CN";
    $response = file_get_contents($url);

    if ($response === false) {
        return null;
    }

    $data = json_decode($response, true);

    if (isset($data['images'][0])) {
        $image = $data['images'][0];
        return "https://www.bing.com" . $image['url']; // 直接返回图片链接
    }

    return null;
}

// 获取 Bing 每日图片
$imageUrl = getBingDailyImage();

// 如果获取图片失败，使用默认图片
if (!$imageUrl) {
    $imageUrl = 'https://s.awy.me/2024/awymebgimg.webp'; // 默认图片 URL
}

// 获取图片内容
$imageContent = file_get_contents($imageUrl);

if ($imageContent === false) {
    echo "无法加载图片";
    exit;
}

// 获取图片的 MIME 类型
$imageInfo = getimagesizefromstring($imageContent);
header("Content-Type: " . $imageInfo['mime']);

// 输出图片内容
echo $imageContent;
?>
