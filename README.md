<h1 align="center"> 简介 </h1>

为避免在不同的应用中重复书写同样的代码，和后期沉重的维护压力（如果有一个地方需要小的修改，那么各个应用需要同步进行维护），可以考虑将公共部分抽象出来，节省开发周期，减轻维护压力。单独做成一个模块，造一个轮子。


## 安装

```shell
$ composer require maturest/trigram -vvv
```

## 用法

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
- [ ] 单元测试
- [ ] GitHub Actions 自动化测试
- [ ] StyleCI 自动化测试
- [ ] 其他有趣的图标（增加代码的健壮性）

## License

MIT