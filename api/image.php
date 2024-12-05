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
        return "https://cn.bing.com" . $image['url']; // 直接返回图片链接
    }

    return null;
}

$imageUrl = getBingDailyImage();

// 判断是否成功获取到图片链接
if ($imageUrl) {
    // 关闭任何输出缓冲
    ob_start();
    header("Location: {$imageUrl}"); // 跳转至目标图像
    ob_end_flush();
    exit;
} else {
    // 如果获取失败，可以跳转到默认图片或显示错误信息
    header("Location: https://s.awy.me/2024/awymebgimg.webp"); // 这里是备用图片的 URL
    exit;
}
?>
