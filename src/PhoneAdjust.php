<?php


namespace Maturest\Trigram;


class PhoneAdjust
{
    protected $phoneList = [
        ['tj_point' => 9, 'tail_num' => '44931', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '44913', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '44933', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43931', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43913', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43933', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43921', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43912', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43923', 'note' => ''],
        ['tj_point' => 9, 'tail_num' => '43932', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99834', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99843', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99845', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99854', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99856', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99865', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99836', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '99863', 'note' => ''],
        ['tj_point' => 8, 'tail_num' => '19834', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19843', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19845', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19854', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19856', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19865', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19836', 'note' => '天1慎用'],
        ['tj_point' => 8, 'tail_num' => '19863', 'note' => '天1慎用'],
        ['tj_point' => 6, 'tail_num' => '38686', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '38668', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '38666', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '38688', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '38656', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '38665', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '35686', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '35668', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '35666', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '35688', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '35656', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '35665', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '98686', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '98668', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '98666', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '98688', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '18686', 'note' => '天1慎用'],
        ['tj_point' => 6, 'tail_num' => '18668', 'note' => '天1慎用'],
        ['tj_point' => 6, 'tail_num' => '18666', 'note' => '天1慎用'],
        ['tj_point' => 6, 'tail_num' => '18688', 'note' => '天1慎用'],
        ['tj_point' => 6, 'tail_num' => '95686', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '95668', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '95666', 'note' => ''],
        ['tj_point' => 6, 'tail_num' => '95688', 'note' => ''],
        ['tj_point' => 1, 'tail_num' => '36198', 'note' => ''],
        ['tj_point' => 1, 'tail_num' => '36189', 'note' => ''],
        ['tj_point' => 1, 'tail_num' => '36188', 'note' => ''],
        ['tj_point' => 1, 'tail_num' => '86188', 'note' => '天8慎用'],
    ];

    public function getPhoneList()
    {
        return collect($this->phoneList)->groupBy('tj_point')->toArray();
    }
}