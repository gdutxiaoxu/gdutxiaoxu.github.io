<?php
//从博客根目录加载百度站点地图
$xmlfile = './baidusitemap.xml';
//解析站点地图，并将所有站点链接存入数组$locs
$xml = simplexml_load_file($xmlfile);
$locs = [];
foreach ($xml->url as $child) {
  array_push($locs,$child->loc->__toString());
}
//调用百度主动推送接口，将baidusitemap.xml中所有的站点链接提交
//site和token请换成你自己的
$api = 'http://data.zz.baidu.com/urls?site=www.yoursite.com&token=yourtoken';
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode("\n", $locs),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
//echo $result;
print_r($result);
?>