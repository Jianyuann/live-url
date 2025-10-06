<?php

final class miguVideo
{
    private const array SALT_TABLE = [
        "7c8ddcab45b340ecbb02bc979c7f58c8", "7a5d79ed05ed48c4908b0179d5a5eb2c",
        "2195d5312d114db397bcfb5ade3784cf", "5454203c18274e8a961efe328a59d1f9",
        "aa4688fcf6844e809cb428dc4bd5f265", "96f3d14a9fe144589f10c775e0c9b4b0",
        "fbc05527db71425f8094e659d62eb878", "c8e65a8b8b3d46f89397573bfa06f68a",
        "a1ef732fa53846c3ba96ada1dcf2513d", "48172134576c43889a5b82f0e2809779",
        "b7334bae489846ccb5b04574e62c9b7c", "5e6c8bee9ad449488d6a60a82ae6e2dc",
        "78c979d58cdb4caa849229a11363bd7c", "5889ccde4570438790be07ee2d8ecde0",
        "f3ebbe5ad4cf42569d1450780789fa2d", "60e57db48d1c4a0f9d614d1ce43fa865",
        "ee892b1bd1074dd7bbd6ab84c3b21fc4", "df0d80d82df84a9590469ad943a758c2",
        "7ce5870b296d42119dea1b0780892167", "0637030a22db41c78615d67cfc42da04",
        "803b409a8df045f990b4cabde9e3cce5", "869973ee8f3543599600cd838503475a",
        "6c83090c16f84d57a987edd3bdd11599", "926ca9cb02674db69e50afde57d8c67b",
        "3ce941cc3cbc40528bfd1c64f9fdf6c0", "eb3de9fccd40429ab7480d857308612d",
        "980ff7db262f49e1820075a7d932deb5", "906c7c50da224618",
        "f81d1140ebb94bbba74baf5858cf132e", "dbfd1cfe66ee4bbc8cdb13ba8758b8fc",
        "fe57125553fe4cbdbe12abf7c7cd6ed1", "5be7f5b3331f4a6e95f6976d7aaeaa28",
        "68979e717f0b424ba64c8e53ecbcc8ac", "4e61f98facc64fb2a4b91eaea736a5c7",
        "f05aa2f4f2124faa89802fd01d3ba436", "32f3994485ff48b3bce430ba3618ba39",
        "be0ff8b380444ef69f775729c0c191b0", "b30ccc7e48ec469c945aa546757e9ab4",
        "bc1deb4002b44ddf8d181f1972a3cb6a", "4bcc96256014c4172878",
        "37856b8633a841aebfb76d0ff596b9df", "ab2fcbf4d28c4ac9897f867af6c25f9d",
        "535200fa8b5d41db8f95ad6bd9033b48", "75a9af00d3da4ceebc2a70018aea842c",
        "08398753dbdb4bcab39a5ce820d220bd", "2d0dc516945f4c03b462571bca898234",
        "c3f3f929917547af8b8dd76b7eafbfa8", "2c5190bb4e244501a4f1be0e8de5015e",
        "035f814657c44324bc4fe073898f0789", "df6d1836cf7b4a118cbca68a5103dc7b",
        "a27aceb56688403fa5163c0ae02987dc", "a8ef203282724897a707d8c3f264f7ad",
        "16264f8569764a5b932c5a6e4206f487", "fea3a87c09bb406182796c08943713ae",
        "85b14746e58c4b33a56abec13cd3290b", "61e74ad5375f479d86c4997336bbc459",
        "b3991eed9c734f06a721ba97e43024a1", "11fba116b6474a16955b738490f8983f",
        "f8a5e365c8a448888dce771e27d0a6c7", "773a341ae0e542088c9655dbd232d1bd",
        "863f85c3032e4012b3c87d5b52d5fb8c", "3e6098467d6c40828e6412293148648f",
        "c5d2cc3c27aa44ec9c2daca6045d7e8e", "4ead9ffe0aa04f8c93a7",
        "29748e6741b142ffa67a9f9c7411eece", "932dcb4ba6084e1eb4d2639cf7c64d9c",
        "c0e6340469604cf7ae3cc7c9e5db0f66", "c387dbdaf30d496aa1b7a3dda102bf08",
        "3281503f3dfe4ed3b474cd550d229cd7", "10187fd2e6504a8bbd4e1c1b88d9a0f1",
        "608489b77e6f4d1c8e90f5c60003a698", "2992342e0cb74c7491a7480d97041dcc",
        "e14825a4dcaa45ffb222a519f292a61f", "bc648171ed0b46ff93396746e3d96a88",
        "44a41389e4df4f7da6c7c48eff751266", "14db12bdfdc94c92941b7df55e8e5d15",
        "a23350dfdb2247aa832c3251ccc560b2", "c1a62f301b6e4f119f4c6a278d660e68",
        "f458f40c3d1c44ef833a8a5e933df839", "a1bcb6ca2ebd4f5497d0e83c3534c319",
        "068d8051a7324a5bbf9fbe0e1c199062", "da2e57efa74a4eca847a346513f66c9d",
        "e4876dd41a5d4136886ded262ae7d522", "60e88c6eb37e4edbb1014e3785e64a1b",
        "fe996131d5e0429688cb7e8c990cf6a9", "e8ba509d0d094c068f9d00d627c59c6e",
        "66f1f4a79c8c4cdfaf8f27a12b1625fc", "865002edf65543abb23b0177da39d602",
        "d1196d8595cb459f82e7ae5bc460441d", "55ce840e78e04c28951fa5ebac61e66f",
        "4ad156b75be24f8a9732d516079ce872", "e1d757845a4c4a6690f640ca817675ba",
        "dd8982151e9b4be4b1324cb59b24f5de", "1d7ff52f2bf046b09d08731587459c0d",
        "4bb5342486844c1689d9ba7a676bab87", "5d6936ea19004c698739e2cfe82fc968",
        "a8e968e5cf934cd29197c2bfa5186cc1", "11422727790b4f29a356ac2730aa2d0b",
        "1842dbb5cec54267b9ed05ec64fd59b6", "58cf465392214c91bc18bd8c46d3b109"
    ];

    private readonly string $contId;

    public function __construct(string $channel)
    {
        $channelKey = strtolower(trim($channel));
        $channelMap = [
			'cctv1'    => '608807420', // CCTV1 综合
            'cctv2'    => '631780532', // CCTV2 财经
            'cctv3'    => '624878271', // CCTV3 综艺
            'cctv4'    => '631780421', // CCTV4 中文国际
            'cctv4a'   => '608807416', // CCTV4 美洲
            'cctv4o'   => '608807419', // CCTV4 欧洲
            'cctv5'    => '641886683', // CCTV5 体育
            'cctv5p'   => '641886773', // CCTV5+ 体育赛事
            'cctv6'    => '624878396', // CCTV6 电影
            'cctv7'    => '673168121', // CCTV7 国防军事
            'cctv8'    => '624878356', // CCTV8 电视剧
            'cctv9'    => '673168140', // CCTV9 纪录
            'cctv10'   => '624878405', // CCTV10 科教
            'cctv11'   => '667987558', // CCTV11 戏曲
            'cctv12'   => '673168185', // CCTV12 社会与法
            'cctv13'   => '608807423', // CCTV13 新闻
            'cctv14'   => '624878440', // CCTV14 少儿
            'cctv15'   => '673168223', // CCTV15 音乐
            'cctv17'   => '673168256', // CCTV17 农业农村

            'fxzl'     => '624878970', // CCTV 发现之旅
            'lgs'      => '884121956', // CCTV 老故事
            'zxs'      => '708869532', // CCTV 中学生

            'cgtnen'   => '609017205', // CGTN
            'cgtndoc'  => '609006487', // CGTN 纪录
            'cgtnep'   => '609006450', // CCTV 西班牙语
            'cgtnfr'   => '609006476', // CCTV 法语
            'cgtnar'   => '609154345', // CCTV 阿拉伯语
            'cgtnru'   => '609006446', // CCTV 俄语

            'dfws'     => '651632648', // 东方卫视
            'cqws'     => '738910914', // 重庆卫视
            'jlws'     => '738906889', // 吉林卫视
            'lnws'     => '630291707', // 辽宁卫视
            'nmws'     => '738911430', // 内蒙古卫视
            'nxws'     => '738910535', // 宁夏卫视
            'gsws'     => '738910997', // 甘肃卫视
            'qhws'     => '738898486', // 青海卫视
            'snws'     => '738910838', // 陕西卫视
            'sdws'     => '738910366', // 山东卫视
            'haws'     => '790187291', // 河南卫视
            'hews'     => '738906825', // 湖北卫视
            'hnws'     => '635491149', // 湖南卫视
            'jxws'     => '783847495', // 江西卫视
            'jsws'     => '623899368', // 江苏卫视
            'dnws'     => '849116810', // 东南卫视
            'hxws'     => '849119120', // 海峡卫视
            'gdws'     => '608831231', // 广东卫视
            'nfws'     => '608917627', // 大湾区卫视
            'gxws'     => '783844132', // 广西卫视
            'ynws'     => '783846580', // 云南卫视
            'gzws'     => '783845222', // 贵州卫视
            'xjws'     => '738910476', // 新疆卫视
            'xzws'     => '738910461', // 西藏卫视
            'hiws'     => '738906860', // 海南卫视
            'shdy'     => '895358641', // 四海钓鱼
            'chcjt'    => '644368373', // CHC 家庭影院
            'chcdz'    => '644368714', // CHC 动作电影
            'chcym'    => '952383261', // CHC 影迷电影
            'dfys'     => '617290047', // 东方影视
            'shxwzh'   => '651632657', // 上海新闻综合
            'dycj'     => '608780988', // 上海第一财经
            'shjsrw'   => '617289997', // 上视纪实人文
            'shics'    => '618954688', // 上海外语
            'fztd'     => '790188943', // 法治天地
            'jbty'     => '796071336', // 劲爆体育
            'mlzq'     => '796070308', // 魅力足球
            'ly'       => '796070452', // 乐游
            'hxjc'     => '790187880', // 欢笑剧场
            'qcxj'     => '796071456', // 七彩戏剧
            'yxfy'     => '790188417', // 游戏风云
            'nlws'     => '956904896', // 农林卫视
            'lttv'     => '668225749', // 临洮电视台

            'jscs'     => '626064714', // 江苏城市
            'jszy'     => '626065193', // 江苏综艺
            'jsys'     => '626064697', // 江苏影视
            'jsggxw'   => '626064693', // 江苏公共新闻
            'jsgj'     => '626064674', // 江苏国际
            'jsjy'     => '628008321', // 江苏教育
            'jstyxx'   => '626064707', // 江苏体育休闲
            'ymkt'     => '626064703', // 优漫卡通

            'njxwzh'   => '838109047', // 南京新闻综合
            'njkj'     => '838153729', // 南京教科
            'njsb'     => '838151753', // 南京十八

            'haxwzh'   => '639731826', // 淮安新闻综合
            'lygxwzh'  => '639731715', // 连云港新闻综合
            'szxwzh'   => '639731952', // 苏州新闻综合
            'tzxwzh'   => '639731818', // 泰州新闻综合
            'sqxwzh'   => '639731832', // 宿迁新闻综合
            'xzxwzh'   => '639731747', // 徐州新闻综合

            'gdys'     => '614961829', // 广东影视
            'jjkt'     => '614952364', // 嘉佳卡通

            '24hyzb'   => '895932793', // 24小时亚洲杯频道
            'cbajd'    => '788813182', // CBA 经典
            'gdjys'    => '631354620', // 掼蛋精英赛
            'gqdp'     => '629943678', // 高清大片
            'hpjy'     => '780290695', // 和平精英赛事
            'hslbt'    => '713600957', // 红色轮播台
            'jddh'     => '629942219', // 经典动画大集合
            'xgdy'     => '625703337', // 经典香港电影
            'jsdp'     => '617432318', // 军事迷必看大片
            'hyytzqy'  => '707671890', // 华语乐坛最强音
            'mg24hty'  => '654102378', // 咪咕24小时体育台
            'nbajd'    => '788815380', // NBA 经典
            'ozzqfy'   => '788816794', // 欧洲足球风云
            'qmpp'     => '788818045', // 全民乒乓
            'sszjd'    => '646596895', // 赛事最经典
            'ttmlh'    => '629943305', // 体坛名栏汇
            'ufcgdjx'  => '788818804', // UFC 格斗精选
            'wdlsjd'   => '780288994', // 五大联赛经典
            'jsjc'     => '713591450', // 金色剧场
            'xczx'     => '713589837', // 乡村振兴
            'xfzgn'    => '617432318', // 幸福中国年
            'xpfyt'    => '619495952', // 新片放映厅
            'jpjc'     => '615810094', // 精品剧场
            'yxlmss'   => '780286989', // 英雄联盟赛事
            'zjlxc'    => '625133682', // 周杰伦现场
            'zqzyp'    => '629942228', // 最强综艺趴
        ];
        $this->contId = $channelMap[$channelKey] ?? $channelKey;
    }

    public function getStreamUrl(): string
    {
        [$timestampMs, $saltEightDigits, $signature] = $this->generateSign();
        $apiUrl = sprintf(
            'https://play.miguvideo.com/playurl/v1/play/playurl?audio=false&contId=%s&dolby=true&multiViewN=2&h265=true&os=13&ott=true&rateType=8&salt=%s&sign=%s&timestamp=%s&ua=oneplus-13&vr=true',
            $this->contId, $saltEightDigits, $signature, $timestampMs
        );

        $headers = [
            'Host: play.miguvideo.com',
            'Accept: */*',
            'Connection: keep-alive',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; oneplus-13 Build/TP1A.220624.014)',
            'appId: miguvideo',
            'terminalId: android',
            'MG-BH: true',
            'userToken: nlpsxxxxxxx',  //your userToken
            'appVersion: 2600037000',
            'Phone-Info: oneplus-13|13',
            'X-UP-CLIENT-CHANNEL-ID: 2600037000-99000-200300220100002',
            'userId: xxxxxx',  //your userId
            'APP-VERSION-CODE: 260370016',
        ];

        $responseBody = $this->httpRequest($apiUrl, $headers);
        $rawUrl = json_decode($responseBody, true)['body']['urlInfo']['url'];
        return $this->ddCalcu($rawUrl);
    }

    private function generateSign(): array
    {
        $timestampMs = (string)(int)(microtime(true) * 1000);
        $prefixMd5 = md5($timestampMs . $this->contId . substr('2600037000', 0, 8));
        $saltEightDigits = (string)random_int(10000000, 99999999);
        $idx = ((int)substr($saltEightDigits, 6)) % 100;
        $signature = md5($prefixMd5 . self::SALT_TABLE[$idx] . 'migu' . substr($saltEightDigits, 0, 4));
        return [$timestampMs, $saltEightDigits, $signature];
    }

    private function httpRequest(string $url, array $headers): string
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT => 10,
        ]);
        $raw = curl_exec($ch);
        curl_close($ch);
        return (string)$raw;
    }

    private function ddCalcu(string $playUrl): string
    {
        $urlParts = parse_url($playUrl);
        parse_str($urlParts['query'], $queryParams);

        $puData = (string)($queryParams['puData'] ?? '');
        $userId = (string)($queryParams['userid'] ?? '');
        $timestamp = (string)($queryParams['timestamp'] ?? '');
        $programId = (string)($queryParams['ProgramID'] ?? '');
        $channelId = (string)($queryParams['Channel_ID'] ?? '');
        $playUrlVersion = (string)($queryParams['playurlVersion'] ?? '');

        $puDataChars = preg_split('//u', $puData, -1, PREG_SPLIT_NO_EMPTY);
        $nChars = count($puDataChars);
        $halfLen = (int)(($nChars + 1) / 2);
        $ddBuilder = '';

        for ($i = 0; $i < $halfLen; $i++) {
            if ($nChars % 2 === 1 && $i === $halfLen - 1) {
                $ddBuilder .= $puDataChars[$i];
                break;
            }

            $ddBuilder .= $puDataChars[$nChars - 1 - $i] . $puDataChars[$i];

            switch ($i) {
                case 1:
                    $userChars = preg_split('//u', $userId, -1, PREG_SPLIT_NO_EMPTY);
                    if (count($userChars) > 2) {
                        $ddBuilder .= $userChars[2];
                    } else {
                        $verChars = preg_split('//u', $playUrlVersion, -1, PREG_SPLIT_NO_EMPTY);
                        $ddBuilder .= count($verChars) > 0 ? mb_strtolower($verChars[count($verChars) - 1], 'UTF-8') : '';
                    }
                    break;
                case 2:
                    $tsChars = preg_split('//u', $timestamp, -1, PREG_SPLIT_NO_EMPTY);
                    $ddBuilder .= (count($tsChars) > 6) ? $tsChars[6] : $puDataChars[$i];
                    break;
                case 3:
                    $progChars = preg_split('//u', $programId, -1, PREG_SPLIT_NO_EMPTY);
                    $ddBuilder .= (count($progChars) > 2) ? $progChars[2] : $puDataChars[$i];
                    break;
                case 4:
                    $chanChars = preg_split('//u', $channelId, -1, PREG_SPLIT_NO_EMPTY);
                    $ddBuilder .= (count($chanChars) >= 4) ? $chanChars[count($chanChars) - 4] : $puDataChars[$i];
                    break;
            }
        }

        $baseUrl = strstr($playUrl, '?', true) ?: $playUrl;
        return sprintf('%s?%s&ddCalcu=%s', $baseUrl, $urlParts['query'], $ddBuilder);
    }
}

$channelId = $_GET['id'] ?? 'cctv1';
header('Location: ' . new miguVideo($channelId)->getStreamUrl());
