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
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bing 每日图片</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #000;
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <?php if ($imageUrl): ?>
        <img src="<?php echo htmlspecialchars($imageUrl); ?>" alt="Bing 每日图片">
    <?php else: ?>
        <p>无法获取 Bing 每日图片，请稍后再试。</p>
    <?php endif; ?>
</body>
</html>
