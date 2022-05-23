<h1 align="center"> 简介 </h1>

为避免在不同的应用中重复书写同样的代码，和后期沉重的维护压力（如果有一个地方需要小的修改，那么各个应用需要同步进行维护），可以考虑将公共部分抽象出来，节省开发周期，减轻维护压力。单独做成一个模块，造一个轮子。


## 安装

```shell
$ composer require maturest/trigram
```

## 使用

> 发布静态资源

```
php artisan vendor:publish --provider="Maturest\Trigram\DestinyServiceProvider"
```

> 六爻自动装卦

```
use Maturest\Trigram\DestinyService;

$date = '2022-05-07 16:53:29';
$trigram = '142142';
$extends = [
    'question' => '我何时能够暴富', //自定义问句
    'userName' => '张三', //用户姓名
    'trigramType' => '问事', //类型
];

$destiny = DestinyService::getInstance($date,$trigram,$extends);

// 判断是否显卦
$isAvailable = $destiny->isAvailable();

// 获取装卦图
$result = $destiny->getTrigramPic();

/*
    [
        'pic_url' => 'xxxx.png', // 装卦图
        'is_dangerous' => $this->resultDiZhi['is_dangerous'] ?? false, // 是否卦变
        'dangerous_note' => $this->resultDiZhi['dangerous_note'] ?? '', // 卦变化煞提示
    ];
*/

```

> 钱包密码

```
use Maturest\Trigram\WalletPassword;

// 初始化
$walletPassword = new WalletPassword();

// 阳历生日的钱包密码
$res_solar = $walletPassword->getResultBySolar('1990-11-20');

// 阴历生日的钱包密码
$res_lunar = $walletPassword->getResultByLunar('1990-10-04');

array:2 [▼
  "banknotes" => 2900 //新钞数量
  "wallet" => array:5 [▼  //钱包属性
    "month" => "10"
    "primary" => array:1 [▼  //主要颜色
      0 => "yellow"
    ]
    "secondary" => array:2 [▼ //辅助颜色
      0 => "black"
      1 => "gray"
    ]
    "note" => "黄色为主，黑色、灰色为辅" //备注说明
    "img" => "wallet/ybg.png" //示例图片
  ]
]
```

> 最强方位

```
use Maturest\Trigram\Orientation;

// 初始化
$orientation = new Orientation();

// 阳历生日的最强方位
$res_solar = $orientation->getResultBySolar('1990-11-20');

// 阴历生日的最强方位
$res_lunar = $orientation->getResultByLunar('1990-10-04');

/*
array:4 [▼
  "zhi" => "午", //年份的地支
  "strong" => "坐南朝北", //最强方位 
  "weakness" => "坐北朝南", //最弱方位
  "img" => "orientation/north.png", //朝向图片
]
*/
```

> 神数排盘

```
use Maturest\Trigram\Plate;

// 初始化
$plate = new Plate();

// 阳历生日的排盘
$res_solar = $plate->getResultBySolar('1999-11-11 19:05:36');

// 阴历生日的排盘
$res_lunar = $plate->getResultByLunar('1999-11-11 19:05:36');

/*
array:13 [▼
  "front_nums" => array:9 [▶] // 先天数
  "later_nums" => array:9 [▶] // 后天数
  "front_gram_relation" => array:9 [▶] // 先天数克关系
  "later_gram_relation" => array:9 [▶] // 后天数克关系
  "gram_statistics" => array:3 [▶] // 克关系的统计
  "front_wx" => array:9 [▶] // 先天数的五行
  "later_wx" => array:9 [▶] // 后天数的五行
  "front_lunar_solar" => array:9 [▶] // 先天数的阴阳
  "later_lunar_solar" => array:9 [▶] // 后天数的阴阳
  "front_raw_relation" => array:9 [▶] // 先天数生关系
  "later_raw_relation" => array:9 [▶] // 后天数生关系
  "front_prosper_relation" => array:9 [▶] // 先天数比旺关系
  "later_prosper_relation" => array:9 [▶] // 后天数比旺关系
]
*/

```

>十二神数

```
use Maturest\Trigram\TwelveGodNums;

//初始化
$twelveGodNums = new TwelveGodNums();

//神数相克数组
$gram_nums = ['11-4','10-4','10-5'];

//清理大败局
$clearFail = $twelveGodNums->clearBigFail($gram_nums);

//摆放大成局
$drawSuccess = $twelveGodNums->drawBigSuccess($gram_nums,2);

```


## 异常

- InvalidArgumentException 参数不合法
- ImagesNotFoundException 图片文件未找到


## TODO

- [x] 六爻自动装卦
- [x] 提供 ServiceProvider
- [x] 增加异常处理
- [x] 版本语义化
- [x] 增加钱包密码
- [x] 增加最强方位
- [x] 增加神数排盘
- [x] 增加十二神数
- [ ] 增加手机号调整
- [ ] 增加开机密码
- [ ] 增加财富密码
- [ ] 增加穿衣指南
- [ ] 单元测试
- [ ] GitHub Actions 自动化测试
- [ ] StyleCI 自动化测试
- [ ] 其他有趣的图标（增加代码的健壮性）

## License

MIT