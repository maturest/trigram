<?php


namespace Maturest\Trigram\Traits\TwelveGodNums;


trait BigFailScene
{
    // 自定义的清理内容
    protected $defuses = [
        'case_one' => '不能有马的画像、蛇图腾摆件或观音的画像摆件，电视、电脑、暖气、炉灶、电灯、台灯，发热物体，红色或粉红色的物品',
        'case_two' => '不能有流动的水、水管、鱼缸；雨伞雨具、镜子、大玻璃；珠宝、鞋子、饮水机，装有液体的瓶瓶罐罐；老鼠、猪、牛、大象的摆件；或是青、蓝、咖啡色的物体',
        'case_three' => '不能有父亲或少女的照片、佛像、佛珠、黑色的（如电视机）或银色的金属制品；鸡、狗、鸟类等饰品、刀枪、玉石类的摆件',
        'case_four' => '不能有盆栽、药材、粮食、书报；紫色、绿色的床单、被褥、衣物等物品；兔子、龙等摆件、木制的艺术品，空调、风扇等',
        'case_five' => '不能有母亲、年长女性及其他已过世人及建筑、山水画/照片，猫、老虎、羊或猴公仔类，保险柜、鞋柜、屏风、瓶瓶罐罐、陶土或石头制品等，或是黄色、白色的物品',
    ];

    // 大败局，大败局没有男女之分
    protected $bigFailScenes = [
        ['num' => '1-6', 'orientation' => '正北方', 'defuse_key' => 'case_one', 'sort' => 1],
        ['num' => '1-6', 'orientation' => '东南偏南方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '2-6', 'orientation' => '东北偏北方', 'defuse_key' => 'case_one', 'sort' => 20],
        ['num' => '2-6', 'orientation' => '东南偏南方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '12-6', 'orientation' => '西北偏北方', 'defuse_key' => 'case_one', 'sort' => 20],
        ['num' => '12-6', 'orientation' => '东南偏南方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '1-7', 'orientation' => '正北方', 'defuse_key' => 'case_one', 'sort' => 1],
        ['num' => '1-7', 'orientation' => '正南方', 'defuse_key' => 'case_two', 'sort' => 1],
        ['num' => '2-7', 'orientation' => '东北偏北方', 'defuse_key' => 'case_one', 'sort' => 20],
        ['num' => '2-7', 'orientation' => '正南方', 'defuse_key' => 'case_two', 'sort' => 1],
        ['num' => '12-7', 'orientation' => '西北偏北方', 'defuse_key' => 'case_one', 'sort' => 20],
        ['num' => '12-7', 'orientation' => '正南方', 'defuse_key' => 'case_two', 'sort' => 1],
        ['num' => '6-10', 'orientation' => '东南偏南方', 'defuse_key' => 'case_three', 'sort' => 20],
        ['num' => '6-10', 'orientation' => '正西方', 'defuse_key' => 'case_one', 'sort' => 1],
        ['num' => '7-10', 'orientation' => '正南方', 'defuse_key' => 'case_three', 'sort' => 1],
        ['num' => '7-10', 'orientation' => '正西方', 'defuse_key' => 'case_one', 'sort' => 1],
        ['num' => '6-11', 'orientation' => '东南偏南方', 'defuse_key' => 'case_three', 'sort' => 20],
        ['num' => '6-11', 'orientation' => '西北偏西方', 'defuse_key' => 'case_one', 'sort' => 20],
        ['num' => '7-11', 'orientation' => '正南方', 'defuse_key' => 'case_three', 'sort' => 1],
        ['num' => '7-11', 'orientation' => '西北偏西方', 'defuse_key' => 'case_one', 'sort' => 20],
        ['num' => '10-4', 'orientation' => '正西方', 'defuse_key' => 'case_four', 'sort' => 1],
        ['num' => '10-4', 'orientation' => '正东方', 'defuse_key' => 'case_three', 'sort' => 1],
        ['num' => '11-4', 'orientation' => '西北偏西方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '11-4', 'orientation' => '正东方', 'defuse_key' => 'case_three', 'sort' => 1],
        ['num' => '10-5', 'orientation' => '正西方', 'defuse_key' => 'case_four', 'sort' => 1],
        ['num' => '10-5', 'orientation' => '东南偏东方', 'defuse_key' => 'case_three', 'sort' => 20],
        ['num' => '11-5', 'orientation' => '西北偏西方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '11-5', 'orientation' => '东南偏东方', 'defuse_key' => 'case_three', 'sort' => 20],
        ['num' => '4-3', 'orientation' => '正东方', 'defuse_key' => 'case_five', 'sort' => 1],
        ['num' => '4-3', 'orientation' => '东北偏东方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '5-3', 'orientation' => '东南偏东方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '5-3', 'orientation' => '东北偏东方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '4-8', 'orientation' => '正东方', 'defuse_key' => 'case_five', 'sort' => 1],
        ['num' => '4-8', 'orientation' => '西南偏南方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '5-8', 'orientation' => '东南偏东方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '5-8', 'orientation' => '西南偏南方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '4-9', 'orientation' => '正东方', 'defuse_key' => 'case_five', 'sort' => 1],
        ['num' => '4-9', 'orientation' => '西南偏西方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '5-9', 'orientation' => '东南偏东方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '5-9', 'orientation' => '西南偏西方', 'defuse_key' => 'case_four', 'sort' => 20],
        ['num' => '3-1', 'orientation' => '东北偏东方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '3-1', 'orientation' => '正北方', 'defuse_key' => 'case_five', 'sort' => 1],
        ['num' => '8-1', 'orientation' => '西南偏南方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '8-1', 'orientation' => '正北方', 'defuse_key' => 'case_five', 'sort' => 1],
        ['num' => '9-1', 'orientation' => '西南偏西方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '9-1', 'orientation' => '正北方', 'defuse_key' => 'case_five', 'sort' => 1],
        ['num' => '3-2', 'orientation' => '东北偏东方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '3-2', 'orientation' => '东北偏北方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '8-2', 'orientation' => '西南偏南方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '8-2', 'orientation' => '东北偏北方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '9-2', 'orientation' => '西南偏西方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '9-2', 'orientation' => '东北偏北方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '3-12', 'orientation' => '东北偏东方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '3-12', 'orientation' => '西北偏北方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '8-12', 'orientation' => '西南偏南方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '8-12', 'orientation' => '西北偏北方', 'defuse_key' => 'case_five', 'sort' => 20],
        ['num' => '9-12', 'orientation' => '西南偏西方', 'defuse_key' => 'case_two', 'sort' => 20],
        ['num' => '9-12', 'orientation' => '西北偏北方', 'defuse_key' => 'case_five', 'sort' => 20],
    ];

    /**
     * 清理大败局
     * @param array $gram_nums 克关系数组
     * @return mixed
     */
    public function clearBigFail(array $gram_nums)
    {
        // 1、找出相克的数组所对应的数据
        $rows = collect($this->bigFailScenes)
            ->whereIn('num', $gram_nums)
            ->groupBy('defuse_key')
            ->map(function ($item, $key) {
                //1、取出方向,按排序权重进行排序
                $orientation = collect($item)->sortBy('sort')->pluck('orientation')->unique()->implode('、');
                //2、取出大败局
                $fail = $this->defuses[$key];
                return $orientation . '：' . $fail . '。';
            })->values()->toArray();

        return $rows;
    }
}