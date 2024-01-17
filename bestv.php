<?php
error_reporting(0);
date_default_timezone_set("Asia/Shanghai");
$id = $_GET['id'] ?? 'cctv1hd8m';
$rate = match( $_GET[ "q" ] ) {
    'ld' => '1300000',
    'sd' => '2300000',
    'hd' => '4000000',
    'uhd'=> '15000000',
    default=>'8000000',
};
/*
可用域名
shuhuohb.live51.test.bestvcdn.com.cn
shuhuohbbak.live51.bestvcdn.com.cn
cqby.live.bestvcdn.com.cn
test-cos-tencent.bestvcdn.com.cn
*/

$date = date('YmdH');
$stream = "http://live-gitv-nm-yh.189smarthome.com/live/program/live/$id/$rate/";
$timestamp = intval(time()/10-2);
$current = "#EXTM3U" . "\r\n";
$current .= "#EXT-X-VERSION:3" . "\r\n";
$current .= "#EXT-X-TARGETDURATION:10" . "\r\n";
$current .= "#EXT-X-MEDIA-SEQUENCE:$timestamp" . "\r\n";
for ($i = 0; $i < 1; $i++) {
$timeMatch = $timestamp . '0';
$timeFirst = date('YmdH', $timeMatch);
$current .= "#EXTINF:10," . "\r\n";
$current .= $stream . $timeFirst . "/" . $timestamp . ".ts" . "\r\n";
$timestamp = $timestamp + 1;
}

header("Content-Disposition: attachment; filename=playlist.m3u8");
echo $current;

/*
CCTV16-4K,  https://tvhub.vercel.app/bestv.php?id=cctv16hd4k&q=uhd
CCTV-4K,  https://tvhub.vercel.app/bestv.php?id=cctv4k&q=uhd
CCTV1,  https://tvhub.vercel.app/bestv.php?id=cctv1hd8m
CCTV2,  https://tvhub.vercel.app/bestv.php?id=cctv2hd8m
CCTV3,  https://tvhub.vercel.app/bestv.php?id=cctv38m
CCTV4,  https://tvhub.vercel.app/bestv.php?id=cctv4hd8m
CCTV5,  https://tvhub.vercel.app/bestv.php?id=cctv58m
CCTV5+,  https://tvhub.vercel.app/bestv.php?id=cctv5phd8m
CCTV6,  https://tvhub.vercel.app/bestv.php?id=cctv6hd8m
CCTV7,  https://tvhub.vercel.app/bestv.php?id=cctv7hd8m
CCTV8,  https://tvhub.vercel.app/bestv.php?id=cctv8hd8m
CCTV9,  https://tvhub.vercel.app/bestv.php?id=cctv9hd8m
CCTV10,  https://tvhub.vercel.app/bestv.php?id=cctv10hd8m
CCTV11,  https://tvhub.vercel.app/bestv.php?id=cctv11hd8m
CCTV12,  https://tvhub.vercel.app/bestv.php?id=cctv12hd8m
CCTV13,  https://tvhub.vercel.app/bestv.php?id=cctv13xwhd8m
CCTV14,  https://tvhub.vercel.app/bestv.php?id=cctvsehd8m
CCTV15,  https://tvhub.vercel.app/bestv.php?id=cctv15hd8m
CCTV16,  https://tvhub.vercel.app/bestv.php?id=cctv16hd8m
CCTV17,  https://tvhub.vercel.app/bestv.php?id=cctv17hd8m
江苏卫视,  https://tvhub.vercel.app/bestv.php?id=jswshd8m
广西卫视,  https://tvhub.vercel.app/bestv.php?id=gxwshd8m
四川卫视,  https://tvhub.vercel.app/bestv.php?id=scwshd
湖南卫视,  https://tvhub.vercel.app/bestv.php?id=hunanwshd8m
浙江卫视,  https://tvhub.vercel.app/bestv.php?id=zjwshd8m
东方卫视,  https://tvhub.vercel.app/bestv.php?id=dfwshd8m
北京卫视,  https://tvhub.vercel.app/bestv.php?id=bjwshd8m
天津卫视,  https://tvhub.vercel.app/bestv.php?id=tjwshd8m
辽宁卫视,  https://tvhub.vercel.app/bestv.php?id=lnwshd8m
安徽卫视,  https://tvhub.vercel.app/bestv.php?id=ahwshd8m
黑龙江卫视,  https://tvhub.vercel.app/bestv.php?id=hljwshd8m
广东卫视,  https://tvhub.vercel.app/bestv.php?id=gdwshd8m
深圳卫视,  https://tvhub.vercel.app/bestv.php?id=szwshd8m
湖北卫视,  https://tvhub.vercel.app/bestv.php?id=hubeiws8m
吉林卫视,  https://tvhub.vercel.app/bestv.php?id=jlwshd8m
山东卫视,  https://tvhub.vercel.app/bestv.php?id=sdws8m
江西卫视,  https://tvhub.vercel.app/bestv.php?id=jxws8m
河南卫视,  https://tvhub.vercel.app/bestv.php?id=hnwshd8m
河北卫视,  https://tvhub.vercel.app/bestv.php?id=hbwshd8m
甘肃卫视,  https://tvhub.vercel.app/bestv.php?id=gswshd8m
重庆卫视,  https://tvhub.vercel.app/bestv.php?id=cqws8m
东南卫视,  https://tvhub.vercel.app/bestv.php?id=dnwshd8m
云南卫视,  https://tvhub.vercel.app/bestv.php?id=ynwshd8m
贵州卫视,  https://tvhub.vercel.app/bestv.php?id=gzwshd8m
海南卫视,  https://tvhub.vercel.app/bestv.php?id=hainanwshd8m
劲爆体育,  https://tvhub.vercel.app/bestv.php?id=jbtyhd8m
快乐垂钓,  https://tvhub.vercel.app/bestv.php?id=klcd8m
金鹰纪实,  https://tvhub.vercel.app/bestv.php?id=jyjs8m
戏曲精选,  https://tvhub.vercel.app/bestv.php?id=xqjx8m
上海第一财经,  https://tvhub.vercel.app/bestv.php?id=dycjhd8m
上视新闻,  https://tvhub.vercel.app/bestv.php?id=xwzhhd8m
上海都市,  https://tvhub.vercel.app/bestv.php?id=dshd8m
上海纪实,  https://tvhub.vercel.app/bestv.php?id=jspdhd&q=hd
东方影视,  https://tvhub.vercel.app/bestv.php?id=dfyshd8m
五星体育,  https://tvhub.vercel.app/bestv.php?id=wxtyhd8m
上视外语,  https://tvhub.vercel.app/bestv.php?id=icshd8m
七彩戏剧,  https://tvhub.vercel.app/bestv.php?id=qcxjhd8m
上海教育,  https://tvhub.vercel.app/bestv.php?id=setvhd
全纪实,  https://tvhub.vercel.app/bestv.php?id=qjshd8m
生活时尚,  https://tvhub.vercel.app/bestv.php?id=shss8m
新视觉,  https://tvhub.vercel.app/bestv.php?id=xsjhd8m
游戏风云,  https://tvhub.vercel.app/bestv.php?id=yxfy8m
热门综艺,  https://tvhub.vercel.app/bestv.php?id=rmzy8m
超级体育,  https://tvhub.vercel.app/bestv.php?id=qcsj8m
健康养生,  https://tvhub.vercel.app/bestv.php?id=jkys8m
百变课堂,  https://tvhub.vercel.app/bestv.php?id=bbkt8m
看天下精选,  https://tvhub.vercel.app/bestv.php?id=ktxjx8m
华语影院,  https://tvhub.vercel.app/bestv.php?id=hyyy8m
电竞天堂,  https://tvhub.vercel.app/bestv.php?id=djtt8m
青春动漫,  https://tvhub.vercel.app/bestv.php?id=qcdm8m
宝宝动画,  https://tvhub.vercel.app/bestv.php?id=bbdh8m
星光影院,  https://tvhub.vercel.app/bestv.php?id=xgyy8m
谍战剧场,  https://tvhub.vercel.app/bestv.php?id=dzjc8m
全球大片,  https://tvhub.vercel.app/bestv.php?id=qqdp8m
热门剧场,  https://tvhub.vercel.app/bestv.php?id=rmjc8m
卡酷少儿,  https://tvhub.vercel.app/bestv.php?id=kkse8m
纪实科教,  https://tvhub.vercel.app/bestv.php?id=dajs8m
茶频道,  https://tvhub.vercel.app/bestv.php?id=cpdhdavs8m
足球高清,  https://tvhub.vercel.app/bestv.php?id=zqpd8m
炫动卡通,  https://tvhub.vercel.app/bestv.php?id=hhxd8m
东方财经,  https://tvhub.vercel.app/bestv.php?id=dfcjhd8m
都市剧场,  https://tvhub.vercel.app/bestv.php?id=dsjc8m
动漫秀场,  https://tvhub.vercel.app/bestv.php?id=dmxc8m
法治天地,  https://tvhub.vercel.app/bestv.php?id=fztd8m
金色学堂,  https://tvhub.vercel.app/bestv.php?id=jingsepd8m
魅力足球,  https://tvhub.vercel.app/bestv.php?id=mlyyhd8m
CGTN, https://tvhub.vercel.app/bestv.php?id=ottcctvnews&q=ld
CETV1HD, https://tvhub.vercel.app/bestv.php?id=zgjy1t8m
CETV2, https://tvhub.vercel.app/bestv.php?id=cetv2&q=sd
CETV4HD, https://tvhub.vercel.app/bestv.php?id=zgjy4hd8m
中国天气, https://tvhub.vercel.app/bestv.php?id=zgqx&q=ld
内蒙古卫视,  https://tvhub.vercel.app/bestv.php?id=nmgws&q=ld
宁夏卫视,  https://tvhub.vercel.app/bestv.php?id=nxws&q=ld
青海卫视, https://tvhub.vercel.app/bestv.php?id=qhws&q=ld
陕西卫视,  https://tvhub.vercel.app/bestv.php?id=sxws&q=ld
山西卫视,  https://tvhub.vercel.app/bestv.php?id=shanxiws&q=ld
厦门卫视,  https://tvhub.vercel.app/bestv.php?id=xmws&q=ld
康巴卫视, https://tvhub.vercel.app/bestv.php?id=kbws&q=sd
新疆卫视,  https://tvhub.vercel.app/bestv.php?id=xjws&q=ld
兵团卫视,  https://tvhub.vercel.app/bestv.php?id=btws&q=ld
西藏卫视,  https://tvhub.vercel.app/bestv.php?id=xzws&q=sd
西藏藏语卫视,  https://tvhub.vercel.app/bestv.php?id=xzwszy&q=sd
北京纪实科教, https://tvhub.vercel.app/bestv.php?id=dajs8m
卡酷少儿, https://tvhub.vercel.app/bestv.php?id=kkse8m
东方影视, https://tvhub.vercel.app/bestv.php?id=dfyshd8m
东方购物, https://tvhub.vercel.app/bestv.php?id=dfgwsxhd8m
第一财*, https://tvhub.vercel.app/bestv.php?id=dycjhd8m
上海新闻综合, https://tvhub.vercel.app/bestv.php?id=xwzhhd8m
上海ICS, https://tvhub.vercel.app/bestv.php?id=icshd8m
哈哈炫动, https://tvhub.vercel.app/bestv.php?id=hhxd8m
法治天地, https://tvhub.vercel.app/bestv.php?id=fztd8m
欢笑剧场, https://tvhub.vercel.app/bestv.php?id=hxjc8m
欢笑剧场4K, https://tvhub.vercel.app/bestv.php?id=hxjc4k&q=uhd
都市剧场, https://tvhub.vercel.app/bestv.php?id=dsjc8m
七彩戏剧, https://tvhub.vercel.app/bestv.php?id=qcxjhd8m
劲爆体育, https://tvhub.vercel.app/bestv.php?id=jbtyhd8m
新视觉, https://tvhub.vercel.app/bestv.php?id=xsjhd8m
游戏风云, https://tvhub.vercel.app/bestv.php?id=yxfy8m
生活时尚, https://tvhub.vercel.app/bestv.php?id=shss8m
金色学堂, https://tvhub.vercel.app/bestv.php?id=jingsepd8m
乐游HD, https://tvhub.vercel.app/bestv.php?id=qjshd8m
魅力足球, https://tvhub.vercel.app/bestv.php?id=mlyyhd8m
上海教育, https://tvhub.vercel.app/bestv.php?id=setvhd
浦东电视台, https://tvhub.vercel.app/bestv.php?id=hhse&q=sd
足球频道, https://tvhub.vercel.app/bestv.php?id=zqpd8m
茶频道, https://tvhub.vercel.app/bestv.php?id=cpdhdavs8m
快乐垂钓, https://tvhub.vercel.app/bestv.php?id=klcd8m
金鹰纪实, https://tvhub.vercel.app/bestv.php?id=jyjs8m
金鹰卡通, https://tvhub.vercel.app/bestv.php?id=jykt&q=ld
陶瓷频道, https://tvhub.vercel.app/bestv.php?id=taocihd
嘉佳卡通, https://tvhub.vercel.app/bestv.php?id=jjkt&q=ld
财富天下, https://tvhub.vercel.app/bestv.php?id=cftx&q=sd
戏曲精选, https://tvhub.vercel.app/bestv.php?id=xqjx8m
热门综艺, https://tvhub.vercel.app/bestv.php?id=rmzy8m
超级体育, https://tvhub.vercel.app/bestv.php?id=qcsj8m
健康养生, https://tvhub.vercel.app/bestv.php?id=jkys8m
百变课堂, https://tvhub.vercel.app/bestv.php?id=bbkt8m
看天下精选, https://tvhub.vercel.app/bestv.php?id=ktxjx8m
华语影院, https://tvhub.vercel.app/bestv.php?id=hyyy8m
电竞天堂, https://tvhub.vercel.app/bestv.php?id=djtt8m
青春动漫, https://tvhub.vercel.app/bestv.php?id=qcdm8m
宝宝动画, https://tvhub.vercel.app/bestv.php?id=bbdh8m
星光影院, https://tvhub.vercel.app/bestv.php?id=xgyy8m
谍战剧场, https://tvhub.vercel.app/bestv.php?id=dzjc8m
全球大片, https://tvhub.vercel.app/bestv.php?id=qqdp8m
热门剧场, https://tvhub.vercel.app/bestv.php?id=rmjc8m
汽车世界, https://tvhub.vercel.app/bestv.php?id=qcsj8m
空中课堂一年级, https://tvhub.vercel.app/bestv.php?id=kkyinj&q=ld
空中课堂二年级, https://tvhub.vercel.app/bestv.php?id=kkernj&q=ld
空中课堂三年级, https://tvhub.vercel.app/bestv.php?id=kksannj&q=ld
空中课堂四年级, https://tvhub.vercel.app/bestv.php?id=kksinj&q=ld
空中课堂五年级, https://tvhub.vercel.app/bestv.php?id=kkwunj&q=ld
空中课堂六年级, https://tvhub.vercel.app/bestv.php?id=kkliunj&q=ld
空中课堂七年级, https://tvhub.vercel.app/bestv.php?id=kkqinj&q=ld
空中课堂八年级, https://tvhub.vercel.app/bestv.php?id=kkbanj&q=ld
空中课堂九年级, https://tvhub.vercel.app/bestv.php?id=kkjiunj&q=ld
空中课堂高一, https://tvhub.vercel.app/bestv.php?id=kkgaoyinj&q=ld
空中课堂高二, https://tvhub.vercel.app/bestv.php?id=kkgaoernj&q=ld
空中课堂高三, https://tvhub.vercel.app/bestv.php?id=kkgaosannj&q=ld

, 
*/
