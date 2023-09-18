<?php

namespace Maturest\Trigram\Traits\TwelveGodNums;

trait KindTip
{
    // 项链部分（年-月）
    protected $default_content = [
        0 => '<div>' . '1. 关于大成局摆放方式的演示，我们有录制好说明视频，请您用自己的微信登录“易智荟” —查看演示视频。' . '</div>',
        1 => '<div>' . '2. 大成局摆放位置的重点：<span style="color: blue;font-weight:bold;">客厅或办公室以自己常坐的位置为太极点，去找相应方位的摆放方位；卧室以两枕头中间的位置为太极点，去找相应方位的摆放方位；</span>如仍有不清楚的可以联系客服微信“李氏易学客服 1”或“李氏易学客服 2”，我们会给到您精准的学术回答。' . '</div>',
        2 => '<div>' . '3. 温馨提醒十二神数调整中的地时通关（大成局的摆放到位）比人时通关（身上通关饰品的佩戴）更重要。' . '</div>',
        3 => '<div>' . '4. 温馨提醒您<span style="color: blue;font-weight:bold;"> 2023 年的五黄煞在西北方</span>，留意住家及办公室的西北方是否有动土，如有，需及时进行化解五黄煞的处理。' . '</div>',
        4 => '<div>' . '5. 若有出远门，建议您在出行前三天卜出行卦；如果能更早确定行程，也可提前至出行前1 个月左右卜出行卦化煞，并在出行前三天再次卜出行卦确认。出行卦请务必化至无煞后再出行。' . '</div>',
        5 => '<div>' . '6. 建议您每年年初正月初一到十五，卜当年的年运势卦。温馨提醒您尤其在<span style="background-color: yellow;color:red;font-weight:bold;">?</span>的正月十五日前最好要卜【年运势卦】。' . '</div>',
        6 => '<div>' . '7. 建议您在<span style="background-color: yellow;color:red;font-weight:bold;">阴历的?</span>卜【月运势卦】。' . '</div>',
        7 => '<div>' . '8. 建议您在<span style="background-color: yellow;color:red;font-weight:bold;">每日的?</span>尽量不做重大决定，开车或者外出请注意安全。' . '</div>',
        8 => '<div>' . '9. 温馨提醒您<span style="background-color: yellow;color:red;font-weight:bold;">尽量少去?，</span>若一定需要去，提前卜出行卦，若有出远门，建议您一定在出行前三天卜出行卦。' . '</div>',
        9 => '<div>' . '10. 建议您检查祖坟能量磁场。' . '</div>',
        10 => '<div>' . '11. 建议您根据以上个人十二神数的通关调整，先行购买齐全大成局通关摆件及通关饰品后，可先卜您本人的身体卦，调整好自身的身体能量磁场，有煞化煞；在身体能量调整好后，再卜卦择日摆放大成局及佩戴通关饰品，并在择日卦给出的吉日吉时中，进行通关物品的摆放及佩戴，<span style="color: blue;font-weight:bold;">建议卜卦问句如下：</span>' . '</div>',
        11 => '<div style="color: blue;font-weight:bold;">' . '1、我目前身体如何？' . '</div>',
        12 => '<div style="color: blue;font-weight:bold;">' . '2、何日摆放大成局及佩戴通关饰品对我未来有助？（温馨提醒：以上是择日卦是一个完整的卜卦问句，卜卦时要观想您摆放大成局的位置及摆放的物品，通关饰品佩戴的是什么及佩戴位置）' . '</div>',
    ];

    protected $year = [
        ['start' => 1, 'end' => 6, 'content' => ['鼠年', '蛇年']],
        ['start' => 2, 'end' => 6, 'content' => ['牛年', '蛇年']],
        ['start' => 12, 'end' => 6, 'content' => ['猪年', '蛇年']],
        ['start' => 1, 'end' => 7, 'content' => ['鼠年', '马年']],
        ['start' => 2, 'end' => 7, 'content' => ['牛年', '马年']],
        ['start' => 12, 'end' => 7, 'content' => ['猪年', '马年']],
        ['start' => 6, 'end' => 10, 'content' => ['蛇年', '鸡年']],
        ['start' => 7, 'end' => 10, 'content' => ['马年', '鸡年']],
        ['start' => 6, 'end' => 11, 'content' => ['蛇年', '狗年']],
        ['start' => 7, 'end' => 11, 'content' => ['马年', '狗年']],
        ['start' => 10, 'end' => 4, 'content' => ['鸡年', '兔年']],
        ['start' => 11, 'end' => 4, 'content' => ['狗年', '兔年']],
        ['start' => 10, 'end' => 5, 'content' => ['鸡年', '龙年']],
        ['start' => 11, 'end' => 5, 'content' => ['狗年', '龙年']],
        ['start' => 4, 'end' => 3, 'content' => ['兔年', '虎年']],
        ['start' => 5, 'end' => 3, 'content' => ['龙年', '虎年']],
        ['start' => 4, 'end' => 8, 'content' => ['兔年', '羊年']],
        ['start' => 5, 'end' => 8, 'content' => ['龙年', '羊年']],
        ['start' => 4, 'end' => 9, 'content' => ['兔年', '猴年']],
        ['start' => 5, 'end' => 9, 'content' => ['龙年', '猴年']],
        ['start' => 3, 'end' => 1, 'content' => ['虎年', '鼠年']],
        ['start' => 8, 'end' => 1, 'content' => ['羊年', '鼠年']],
        ['start' => 9, 'end' => 1, 'content' => ['猴年', '鼠年']],
        ['start' => 3, 'end' => 2, 'content' => ['虎年', '牛年']],
        ['start' => 8, 'end' => 2, 'content' => ['羊年', '牛年']],
        ['start' => 9, 'end' => 2, 'content' => ['猴年', '牛年']],
        ['start' => 3, 'end' => 12, 'content' => ['虎年', '猪年']],
        ['start' => 8, 'end' => 12, 'content' => ['羊年', '猪年']],
        ['start' => 9, 'end' => 12, 'content' => ['猴年', '猪年']],
    ];

    protected $month = [
        ['start' => 1, 'end' => 6, 'content' => ['一月', '六月']],
        ['start' => 2, 'end' => 6, 'content' => ['二月', '六月']],
        ['start' => 12, 'end' => 6, 'content' => ['十二月', '六月']],
        ['start' => 1, 'end' => 7, 'content' => ['一月', '七月']],
        ['start' => 2, 'end' => 7, 'content' => ['二月', '七月']],
        ['start' => 12, 'end' => 7, 'content' => ['十二月', '七月']],
        ['start' => 6, 'end' => 10, 'content' => ['六月', '十月']],
        ['start' => 7, 'end' => 10, 'content' => ['七月', '十月']],
        ['start' => 6, 'end' => 11, 'content' => ['六月', '十一月']],
        ['start' => 7, 'end' => 11, 'content' => ['七月', '十一月']],
        ['start' => 10, 'end' => 4, 'content' => ['十月', '四月']],
        ['start' => 11, 'end' => 4, 'content' => ['十一月', '四月']],
        ['start' => 10, 'end' => 5, 'content' => ['十月', '五月']],
        ['start' => 11, 'end' => 5, 'content' => ['十一月', '五月']],
        ['start' => 4, 'end' => 3, 'content' => ['四月', '三月']],
        ['start' => 5, 'end' => 3, 'content' => ['五月', '三月']],
        ['start' => 4, 'end' => 8, 'content' => ['四月', '八月']],
        ['start' => 5, 'end' => 8, 'content' => ['五月', '八月']],
        ['start' => 4, 'end' => 9, 'content' => ['四月', '九月']],
        ['start' => 5, 'end' => 9, 'content' => ['五月', '九月']],
        ['start' => 3, 'end' => 1, 'content' => ['三月', '一月']],
        ['start' => 8, 'end' => 1, 'content' => ['八月', '一月']],
        ['start' => 9, 'end' => 1, 'content' => ['九月', '一月']],
        ['start' => 3, 'end' => 2, 'content' => ['三月', '二月']],
        ['start' => 8, 'end' => 2, 'content' => ['八月', '二月']],
        ['start' => 9, 'end' => 2, 'content' => ['九月', '二月']],
        ['start' => 3, 'end' => 12, 'content' => ['三月', '十二月']],
        ['start' => 8, 'end' => 12, 'content' => ['八月', '十二月']],
        ['start' => 9, 'end' => 12, 'content' => ['九月', '十二月']],
    ];

    protected $hour = [
        ['start' => 1, 'end' => 6, 'content' => ['子时（23:00-1:00）', '巳时（9:00-11:00）']],
        ['start' => 2, 'end' => 6, 'content' => ['丑时（1:00-3:00）', '巳时（9:00-11:00）']],
        ['start' => 12, 'end' => 6, 'content' => ['亥时（21:00-23:00）', '巳时（9:00-11:00）']],
        ['start' => 1, 'end' => 7, 'content' => ['子时（23:00-1:00）', '午时（11:00-13:00）']],
        ['start' => 2, 'end' => 7, 'content' => ['丑时（1:00-3:00）', '午时（11:00-13:00）']],
        ['start' => 12, 'end' => 7, 'content' => ['亥时（21:00-23:00）', '午时（11:00-13:00）']],
        ['start' => 6, 'end' => 10, 'content' => ['巳时（9:00-11:00）', '酉时（17:00-19:00）']],
        ['start' => 7, 'end' => 10, 'content' => ['午时（11:00-13:00）', '酉时（17:00-19:00）']],
        ['start' => 6, 'end' => 11, 'content' => ['巳时（9:00-11:00）', '戌时（19:00-21:00）']],
        ['start' => 7, 'end' => 11, 'content' => ['午时（11:00-13:00）', '戌时（19:00-21:00）']],
        ['start' => 10, 'end' => 4, 'content' => ['酉时（17:00-19:00）', '卯时（5:00-7:00）']],
        ['start' => 11, 'end' => 4, 'content' => ['戌时（19:00-21:00）', '卯时（5:00-7:00）']],
        ['start' => 10, 'end' => 5, 'content' => ['酉时（17:00-19:00）', '辰时（7:00-9:00）']],
        ['start' => 11, 'end' => 5, 'content' => ['戌时（19:00-21:00）', '辰时（7:00-9:00）']],
        ['start' => 4, 'end' => 3, 'content' => ['卯时（5:00-7:00）', '寅时（3:00-5:00）']],
        ['start' => 2, 'end' => 3, 'content' => ['辰时（7:00-9:00）', '寅时（3:00-5:00）']],
        ['start' => 4, 'end' => 8, 'content' => ['卯时（5:00-7:00）', '未时（13:00-15:00）']],
        ['start' => 5, 'end' => 8, 'content' => ['辰时（7:00-9:00）', '未时（13:00-15:00）']],
        ['start' => 4, 'end' => 9, 'content' => ['卯时（5:00-7:00）', '申时（15:00-17:00）']],
        ['start' => 5, 'end' => 9, 'content' => ['辰时（7:00-9:00）', '申时（15:00-17:00）']],
        ['start' => 3, 'end' => 1, 'content' => ['寅时（3:00-5:00）', '子时（23:00-1:00）']],
        ['start' => 8, 'end' => 1, 'content' => ['未时（13:00-15:00）', '子时（23:00-1:00）']],
        ['start' => 9, 'end' => 1, 'content' => ['申时（15:00-17:00）', '子时（23:00-1:00）']],
        ['start' => 3, 'end' => 2, 'content' => ['寅时（3:00-5:00）', '丑时（1:00-3:00）']],
        ['start' => 8, 'end' => 2, 'content' => ['未时（13:00-15:00）', '丑时（1:00-3:00）']],
        ['start' => 9, 'end' => 2, 'content' => ['申时（15:00-17:00）', '丑时（1:00-3:00）']],
        ['start' => 3, 'end' => 12, 'content' => ['寅时（3:00-5:00）', '亥时（21:00-23:00）']],
        ['start' => 8, 'end' => 12, 'content' => ['未时（13:00-15:00）', '亥时（21:00-23:00）']],
        ['start' => 9, 'end' => 12, 'content' => ['申时（15:00-17:00）', '亥时（21:00-23:00）']],
    ];

    protected $position = [
        ['start' => 1, 'end' => 6, 'content' => ['正北方', '东南偏南方']],
        ['start' => 2, 'end' => 6, 'content' => ['东北偏北方', '东南偏南方']],
        ['start' => 12, 'end' => 6, 'content' => ['西北偏北方', '东南偏南方']],
        ['start' => 1, 'end' => 7, 'content' => ['正北方', '正南方']],
        ['start' => 2, 'end' => 7, 'content' => ['东北偏北方', '正南方']],
        ['start' => 12, 'end' => 7, 'content' => ['西北偏北方', '正南方']],
        ['start' => 6, 'end' => 10, 'content' => ['东南偏南方', '正西方']],
        ['start' => 7, 'end' => 10, 'content' => ['正南方', '正西方']],
        ['start' => 6, 'end' => 11, 'content' => ['东南偏南方', '西北偏西方']],
        ['start' => 7, 'end' => 11, 'content' => ['正南方', '西北偏西方']],
        ['start' => 10, 'end' => 4, 'content' => ['正西方', '正东方']],
        ['start' => 11, 'end' => 4, 'content' => ['西北偏西方', '正东方']],
        ['start' => 10, 'end' => 5, 'content' => ['正西方', '东南偏东方']],
        ['start' => 11, 'end' => 5, 'content' => ['西北偏西方', '东南偏东方']],
        ['start' => 4, 'end' => 3, 'content' => ['正东方', '东北偏东方']],
        ['start' => 5, 'end' => 3, 'content' => ['东南偏东方', '东北偏东方']],
        ['start' => 4, 'end' => 8, 'content' => ['正东方', '西南偏南方']],
        ['start' => 5, 'end' => 8, 'content' => ['东南偏东方', '西南偏南方']],
        ['start' => 4, 'end' => 9, 'content' => ['正东方', '西南偏西方']],
        ['start' => 5, 'end' => 9, 'content' => ['东南偏东方', '西南偏西方']],
        ['start' => 3, 'end' => 1, 'content' => ['东北偏东方', '正北方']],
        ['start' => 8, 'end' => 1, 'content' => ['西南偏南方', '正北方']],
        ['start' => 9, 'end' => 1, 'content' => ['西南偏西方', '正北方']],
        ['start' => 3, 'end' => 2, 'content' => ['东北偏东方', '东北偏北方']],
        ['start' => 8, 'end' => 2, 'content' => ['西南偏南方', '东北偏北方']],
        ['start' => 9, 'end' => 2, 'content' => ['西南偏西方', '东北偏北方']],
        ['start' => 3, 'end' => 12, 'content' => ['东北偏东方', '西北偏北方']],
        ['start' => 8, 'end' => 12, 'content' => ['西南偏南方', '西北偏北方']],
        ['start' => 9, 'end' => 12, 'content' => ['西南偏西方', '西北偏北方']],
    ];

    protected function get_year(int $start, int $end)
    {
        $content = collect($this->year)->whereStrict('start', $start)->whereStrict('end', $end)->first();
        return $content ? $content['content'] : [];
    }

    protected function get_month(int $start, int $end)
    {
        $content = collect($this->month)->whereStrict('start', $start)->whereStrict('end', $end)->first();
        return $content ? $content['content'] : [];
    }

    protected function get_hour(int $start, int $end)
    {
        $content = collect($this->hour)->whereStrict('start', $start)->whereStrict('end', $end)->first();
        return $content ? $content['content'] : [];
    }

    protected function get_position(int $start, int $end)
    {
        $content = collect($this->position)->whereStrict('start', $start)->whereStrict('end', $end)->first();
        return $content ? $content['content'] : [];
    }

    protected function replace(array $original, array $gram_nums, $index, $getValueCallback): array
    {
        $result = '';
        $values = [];
        foreach ($gram_nums as $value) {
            $explode_gram = explode('-', $value);
            if (count($explode_gram) !== 2) continue;
            $start = intval($explode_gram[0]);
            $end = intval($explode_gram[1]);
            $values[] = $getValueCallback($start, $end);
        }

        foreach ($values as $value) {
            $result .= $value[0] . '、' . $value[1] . '、';
        }

        if ($getValueCallback[1] === 'get_month') $result = $this->sortChineseMonths(explode('、', rtrim($result, '、')));
        $original[$index] = str_replace('?', rtrim($result, '、'), $original[$index]);
        return $original;
    }

    protected function sortChineseMonths(array $month): string
    {
        $result = '';
        // 定义一个月份与数字的映射关系数组
        $monthMapping = [
            '一月' => 1,
            '二月' => 2,
            '三月' => 3,
            '四月' => 4,
            '五月' => 5,
            '六月' => 6,
            '七月' => 7,
            '八月' => 8,
            '九月' => 9,
            '十月' => 10,
            '十一月' => 11,
            '十二月' => 12,
        ];

        usort($month, function ($a, $b) use ($monthMapping) {
            $monthA = $monthMapping[$a];
            $monthB = $monthMapping[$b];
            return $monthA - $monthB;
        });
        foreach ($month as $value) {
            $result .= $value . '、';
        }
        return $result;
    }


    public function kind_tip(array $gram_nums): array
    {
        $replacements = [
            ['index' => 5, 'callback' => 'get_year'],
            ['index' => 6, 'callback' => 'get_month'],
            ['index' => 7, 'callback' => 'get_hour'],
            ['index' => 8, 'callback' => 'get_position'],
        ];
        $original = $this->default_content;
        foreach ($replacements as $replacement) {
            $original = $this->replace($original, $gram_nums, $replacement['index'], [$this, $replacement['callback']]);
        }
        return $original;
    }
}
