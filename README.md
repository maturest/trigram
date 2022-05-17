<h1 align="center"> 简介 </h1>

<p align="center"> 为避免在不同的应用中重复书写同样的代码，和后期沉重的维护压力（如果有一个地方需要小的修改，那么各个应用需要同步进行维护），可以考虑将公共部分抽象出来，节省开发周期，减轻维护压力。单独做成一个模块，造一个轮子。</p>


## 安装

```shell
$ composer require maturest/trigram -vvv
```

## 用法

> 发布静态资源

```
php artisan vendor:publish --provider="Maturest\Trigram\DestinyServiceProvider"
```

> 初始化

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
```

> 是否显卦

```
$destiny->isAvailable();
```


> 标空亡

```
$destiny->whiteDeath();
```

> 部地支

```
$destiny->deployDiZhi();
```

> 本卦详情

```
$destiny->getYaoDetail();
```

> 空亡

```
$destiny->handleWhiteDeath();
```

> 暗动

```
$destiny->handleDarkOn();
```

> 六冲

```
$destiny->handleRelationSixCong();
```

> 六合

```
$destiny->handleRelationSixHe();
```

> 汇局

```
$destiny->handleRelationConvergeSet();
```

> 入墓

```
$destiny->handleEnterTomb();
```

> 进退神

```
$destiny->handleDilemma();
```

> 伏爻

```
$destiny->handleVoltTrigram();
```

> 画关系

```
$destiny->draw();
```

## 异常

- InvalidArgumentException 参数不合法
- ImagesNotFoundException 图片文件未找到


## TODO

- [x] 提供 ServiceProvider
- [x] 增加异常处理
- [x] 版本语义化
- [ ] 单元测试
- [ ] GitHub Actions 自动化测试
- [ ] StyleCI 自动化测试
- [ ] 其他有趣的图标（增加代码的健壮性）

## License

MIT