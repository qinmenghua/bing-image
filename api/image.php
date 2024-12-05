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

$imageUrl = getBingDailyImage();

header("Location: {$imageUrl}");    // 跳转至目标图像
