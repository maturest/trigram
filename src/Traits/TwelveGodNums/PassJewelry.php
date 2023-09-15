<?php

namespace Maturest\Trigram\Traits\TwelveGodNums;

use Illuminate\Support\Str;

trait PassJewelry
{

    // 项链部分（年-月）
    protected $necklace = [
        ['start' => 1, 'end' => 6, 'sex' => 0, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 0, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 0, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 0, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 0, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 0, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 0, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 0, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 0, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 0, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 0, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 0, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 0, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 0, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 0, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'content' => ['7', '红', '红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 0, 'content' => ['7', '红', '红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 0, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 0, 'content' => ['6', '红', '红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 0, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 0, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 0, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 1, 'end' => 6, 'sex' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 1, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 1, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 1, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 1, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 1, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 1, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 1, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
    ];

    // 手链部分（月-日）
    protected $bracelet = [
        ['start' => 1, 'end' => 6, 'sex' => 0, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 0, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 0, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 0, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 0, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 0, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 0, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 0, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 0, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 0, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 0, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 0, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 0, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 0, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 0, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'turn' => 1, 'content' => ['7', '红', '红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 0, 'turn' => 1, 'content' => ['7', '红', '红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 0, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 0, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 0, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 0, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 0, 'turn' => 1, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 1, 'end' => 6, 'sex' => 0, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 0, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 0, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 0, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 0, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 0, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 0, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 0, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 0, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 0, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 0, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 0, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 0, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 0, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 0, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'turn' => 2, 'content' => ['7', '红', '红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 0, 'turn' => 2, 'content' => ['7', '红', '红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 0, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 0, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 0, 'turn' => 2, 'content' => ['11', '黑', '黑', '咖啡']],
        ['start' => 1, 'end' => 6, 'sex' => 1, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 1, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 1, 'turn' => 1, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 1, 'turn' => 1, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 1, 'turn' => 1, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 1, 'turn' => 1, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 1, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 1, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 1, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 1, 'turn' => 1, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 1, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 1, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 1, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 1, 'turn' => 1, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 1, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 1, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 1, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 1, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 1, 'turn' => 1, 'content' => ['6', '红', '红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 1, 'turn' => 1, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 1, 'end' => 6, 'sex' => 1, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 1, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 1, 'turn' => 2, 'content' => ['4', '紫', '紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 1, 'turn' => 2, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 1, 'turn' => 2, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 1, 'turn' => 2, 'content' => ['5', '紫', '紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 1, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 1, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 1, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 1, 'turn' => 2, 'content' => ['8', '黄', '黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 1, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 1, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 1, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 1, 'turn' => 2, 'content' => ['2', '蓝', '蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 1, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 1, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 1, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 1, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 1, 'turn' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 1, 'turn' => 2, 'content' => ['10', '黑', '黑', '咖啡']],
    ];

    // 腰带部分（日-日）
    protected $belt = [
        ['start' => 6, 'end' => 10, 'sex' => 0, 'count' => 3, 'content' => ['黄', '白']],
        ['start' => 7, 'end' => 10, 'sex' => 0, 'count' => 3, 'content' => ['黄', '白']],
        ['start' => 6, 'end' => 10, 'sex' => 1, 'count' => 3, 'content' => ['黄', '白']],
        ['start' => 7, 'end' => 10, 'sex' => 1, 'count' => 3, 'content' => ['黄', '白']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'count' => 3, 'content' => ['蓝', '咖啡']],
        ['start' => 10, 'end' => 5, 'sex' => 0, 'count' => 3, 'content' => ['蓝', '咖啡']],
        ['start' => 10, 'end' => 4, 'sex' => 1, 'count' => 3, 'content' => ['蓝', '咖啡']],
        ['start' => 10, 'end' => 5, 'sex' => 1, 'count' => 3, 'content' => ['蓝', '咖啡']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'count' => 3, 'content' => ['蓝', '咖啡']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'count' => 2, 'content' => ['7', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'count' => 3, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'count' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'count' => 3, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 0, 'count' => 3, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 1, 'count' => 3, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 0, 'count' => 2, 'content' => ['6', '红', '红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 1, 'count' => 2, 'content' => ['6', '红', '红', '黄']],
    ];

    // 脚链部分（日-时）（年-时）
    protected $anklet = [
        ['start' => 1, 'end' => 6, 'sex' => 0, 'content' => ['紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 0, 'content' => ['紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 0, 'content' => ['紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 0, 'content' => ['紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 0, 'content' => ['紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 0, 'content' => ['紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 0, 'content' => ['黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 0, 'content' => ['黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 0, 'content' => ['黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 0, 'content' => ['黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'content' => ['蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 0, 'content' => ['蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 0, 'content' => ['蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 0, 'content' => ['蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 0, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 0, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 0, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 0, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 0, 'content' => ['红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 0, 'content' => ['黑', '咖啡']],
        ['start' => 1, 'end' => 6, 'sex' => 1, 'content' => ['紫', '红']],
        ['start' => 2, 'end' => 6, 'sex' => 1, 'content' => ['紫', '红']],
        ['start' => 12, 'end' => 6, 'sex' => 1, 'content' => ['紫', '红']],
        ['start' => 1, 'end' => 7, 'sex' => 1, 'content' => ['紫', '红']],
        ['start' => 2, 'end' => 7, 'sex' => 1, 'content' => ['紫', '红']],
        ['start' => 12, 'end' => 7, 'sex' => 1, 'content' => ['紫', '红']],
        ['start' => 6, 'end' => 10, 'sex' => 1, 'content' => ['黄', '黑']],
        ['start' => 7, 'end' => 10, 'sex' => 1, 'content' => ['黄', '黑']],
        ['start' => 6, 'end' => 11, 'sex' => 1, 'content' => ['黄', '黑']],
        ['start' => 7, 'end' => 11, 'sex' => 1, 'content' => ['黄', '黑']],
        ['start' => 10, 'end' => 4, 'sex' => 1, 'content' => ['蓝', '紫']],
        ['start' => 11, 'end' => 4, 'sex' => 1, 'content' => ['蓝', '紫']],
        ['start' => 10, 'end' => 5, 'sex' => 1, 'content' => ['蓝', '绿']],
        ['start' => 11, 'end' => 5, 'sex' => 1, 'content' => ['蓝', '绿']],
        ['start' => 4, 'end' => 3, 'sex' => 1, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 3, 'sex' => 1, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 8, 'sex' => 1, 'content' => ['红', '黄']],
        ['start' => 4, 'end' => 9, 'sex' => 1, 'content' => ['红', '黄']],
        ['start' => 5, 'end' => 9, 'sex' => 1, 'content' => ['红', '黄']],
        ['start' => 3, 'end' => 1, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 8, 'end' => 1, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 9, 'end' => 1, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 3, 'end' => 2, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 8, 'end' => 2, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 9, 'end' => 2, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 3, 'end' => 12, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 8, 'end' => 12, 'sex' => 1, 'content' => ['黑', '咖啡']],
        ['start' => 9, 'end' => 12, 'sex' => 1, 'content' => ['黑', '咖啡']],
    ];

    // 脚垫部分（时-年）
    protected $mat = [
        ['start' => 1, 'end' => 6, 'sex' => 0, 'content' => ['紫']],
        ['start' => 2, 'end' => 6, 'sex' => 0, 'content' => ['紫']],
        ['start' => 12, 'end' => 6, 'sex' => 0, 'content' => ['紫']],
        ['start' => 1, 'end' => 7, 'sex' => 0, 'content' => ['紫']],
        ['start' => 2, 'end' => 7, 'sex' => 0, 'content' => ['紫']],
        ['start' => 12, 'end' => 7, 'sex' => 0, 'content' => ['紫']],
        ['start' => 6, 'end' => 10, 'sex' => 0, 'content' => ['黄']],
        ['start' => 7, 'end' => 10, 'sex' => 0, 'content' => ['黄']],
        ['start' => 6, 'end' => 11, 'sex' => 0, 'content' => ['黄']],
        ['start' => 7, 'end' => 11, 'sex' => 0, 'content' => ['黄']],
        ['start' => 10, 'end' => 4, 'sex' => 0, 'content' => ['蓝']],
        ['start' => 11, 'end' => 4, 'sex' => 0, 'content' => ['蓝']],
        ['start' => 10, 'end' => 5, 'sex' => 0, 'content' => ['蓝']],
        ['start' => 11, 'end' => 5, 'sex' => 0, 'content' => ['蓝']],
        ['start' => 4, 'end' => 3, 'sex' => 0, 'content' => ['红']],
        ['start' => 5, 'end' => 3, 'sex' => 0, 'content' => ['红']],
        ['start' => 4, 'end' => 8, 'sex' => 0, 'content' => ['红']],
        ['start' => 5, 'end' => 8, 'sex' => 0, 'content' => ['红']],
        ['start' => 4, 'end' => 9, 'sex' => 0, 'content' => ['红']],
        ['start' => 5, 'end' => 9, 'sex' => 0, 'content' => ['红']],
        ['start' => 3, 'end' => 1, 'sex' => 0, 'content' => ['黑']],
        ['start' => 8, 'end' => 1, 'sex' => 0, 'content' => ['黑']],
        ['start' => 9, 'end' => 1, 'sex' => 0, 'content' => ['黑']],
        ['start' => 3, 'end' => 2, 'sex' => 0, 'content' => ['黑']],
        ['start' => 8, 'end' => 2, 'sex' => 0, 'content' => ['黑']],
        ['start' => 9, 'end' => 2, 'sex' => 0, 'content' => ['黑']],
        ['start' => 3, 'end' => 12, 'sex' => 0, 'content' => ['黑']],
        ['start' => 8, 'end' => 12, 'sex' => 0, 'content' => ['黑']],
        ['start' => 9, 'end' => 12, 'sex' => 0, 'content' => ['黑']],
        ['start' => 1, 'end' => 6, 'sex' => 1, 'content' => ['紫']],
        ['start' => 2, 'end' => 6, 'sex' => 1, 'content' => ['紫']],
        ['start' => 12, 'end' => 6, 'sex' => 1, 'content' => ['紫']],
        ['start' => 1, 'end' => 7, 'sex' => 1, 'content' => ['紫']],
        ['start' => 2, 'end' => 7, 'sex' => 1, 'content' => ['紫']],
        ['start' => 12, 'end' => 7, 'sex' => 1, 'content' => ['紫']],
        ['start' => 6, 'end' => 10, 'sex' => 1, 'content' => ['黄']],
        ['start' => 7, 'end' => 10, 'sex' => 1, 'content' => ['黄']],
        ['start' => 6, 'end' => 11, 'sex' => 1, 'content' => ['黄']],
        ['start' => 7, 'end' => 11, 'sex' => 1, 'content' => ['黄']],
        ['start' => 10, 'end' => 4, 'sex' => 1, 'content' => ['蓝']],
        ['start' => 11, 'end' => 4, 'sex' => 1, 'content' => ['蓝']],
        ['start' => 10, 'end' => 5, 'sex' => 1, 'content' => ['蓝']],
        ['start' => 11, 'end' => 5, 'sex' => 1, 'content' => ['蓝']],
        ['start' => 4, 'end' => 3, 'sex' => 1, 'content' => ['红']],
        ['start' => 5, 'end' => 3, 'sex' => 1, 'content' => ['红']],
        ['start' => 4, 'end' => 8, 'sex' => 1, 'content' => ['红']],
        ['start' => 5, 'end' => 8, 'sex' => 1, 'content' => ['红']],
        ['start' => 4, 'end' => 9, 'sex' => 1, 'content' => ['红']],
        ['start' => 5, 'end' => 9, 'sex' => 1, 'content' => ['红']],
        ['start' => 3, 'end' => 1, 'sex' => 1, 'content' => ['黑']],
        ['start' => 8, 'end' => 1, 'sex' => 1, 'content' => ['黑']],
        ['start' => 9, 'end' => 1, 'sex' => 1, 'content' => ['黑']],
        ['start' => 3, 'end' => 2, 'sex' => 1, 'content' => ['黑']],
        ['start' => 8, 'end' => 2, 'sex' => 1, 'content' => ['黑']],
        ['start' => 9, 'end' => 2, 'sex' => 1, 'content' => ['黑']],
        ['start' => 3, 'end' => 12, 'sex' => 1, 'content' => ['黑']],
        ['start' => 8, 'end' => 12, 'sex' => 1, 'content' => ['黑']],
        ['start' => 9, 'end' => 12, 'sex' => 1, 'content' => ['黑']],
    ];


    protected function get_necklace(int $start, int $end, int $sex): string
    {
        $basic_statement = '脖子：戴?颗?色珠子，用?色+?色线穿。';
        $content = collect($this->necklace)->whereStrict('start', $start)->whereStrict('end', $end)->whereStrict('sex', $sex)->first();
        return Str::replaceArray('?', ($content ? $content['content'] : ['4', '紫', '紫', '红']), $basic_statement);
    }

    protected function get_bracelet(int $start, int $end, int $sex, int $turn): string
    {
        $basic_statement = $turn === 1 ? '左手：戴?颗?色珠子，用?色+?色线穿。' : '右手：戴?颗?色珠子，用?色+?色线穿。';
        $content = collect($this->bracelet)->whereStrict('start', $start)->whereStrict('end', $end)->whereStrict('sex', $sex)->whereStrict('turn', $turn)->first();
        return Str::replaceArray('?', ($content ? $content['content'] : ['4', '紫', '紫', '红']), $basic_statement);
    }

    protected function get_belt(int $start, int $end, int $sex, int $turn, int $count): string
    {
        if ($count === 2) $basic_statement = $turn === 1 ? '左腰：戴?颗红色珠子，用?色+?色线穿' : '右腰：戴?颗红色珠子，用?色+?色线穿';
        else $basic_statement = $turn === 1 ? '建议您外裤以?色、?色为主' : '建议您内裤以?色、?色为主';
        $content = collect($this->belt)->whereStrict('start', $start)->whereStrict('end', $end)->whereStrict('sex', $sex)->whereStrict('count', $count)->first();
        return Str::replaceArray('?', ($content ? $content['content'] : ['7', '红', '红', '黄']), $basic_statement);
    }

    protected function get_anklet(int $start, int $end, int $sex, int $turn): string
    {
        $basic_statement = $turn === 1 ? '左脚：直接戴?色+?色双色绳结。' : '右脚：直接戴?色+?色双色绳结。';
        $content = collect($this->anklet)->whereStrict('start', $start)->whereStrict('end', $end)->whereStrict('sex', $sex)->first();
        return Str::replaceArray('?', ($content ? $content['content'] : ['紫', '红']), $basic_statement);
    }

    protected function get_mat(int $start, int $end, int $sex): string
    {
        $basic_statement = '建议您脚垫以?色为主';
        $content = collect($this->mat)->whereStrict('start', $start)->whereStrict('end', $end)->whereStrict('sex', $sex)->first();
        return Str::replaceArray('?', ($content ? $content['content'] : ['紫']), $basic_statement);
    }

    // 获取先天数被克关系
    protected function get_result(array $gram, array $front, array $later, int $sex): array
    {
        $result = [];

        foreach ($gram as $value) {
            $explode_gram = explode('-', $value);

            if (count($explode_gram) !== 2) {
                continue;
            }
            $start = intval($explode_gram[0]);
            $end = intval($explode_gram[1]);
            $left = $this->round_robin_comparison($front, $start, $end, $sex, 1);
            $right = $this->round_robin_comparison($later, $start, $end, $sex, 2);
            $result = array_merge($result, $left, $right);
        }
        usort($result, function ($a, $b) {
            return $a['sort'] - $b['sort'];
        });

        return array_column($result, 'content');
    }


    protected function round_robin_comparison(array $comparisons, int $start, int $end, int $sex, int $turn): array
    {
        $result = [];
        $array_count = count($comparisons);
        for ($i = 0; $i < $array_count; $i++) {
            $value = intval($comparisons[$i]);
            $next = intval($comparisons[($i + 1) % $array_count]);
            if (($value === $start && $next === $end) || ($value === $end && $next === $start)) {
                $result[] = [
                    'sort' => $i + $turn,
                    'content' => $this->get_content($array_count, $i, $start, $end, $sex, $turn),
                ];
            }
        }
        return $result;
    }

    protected function get_content(int $num, int $key, int $start, int $end, int $sex, int $turn): string
    {
        $contentSwitchCases = [
            [0 => 'get_necklace', 1 => 'get_bracelet', 2 => 'get_anklet', 3 => 'get_mat'],
            [0 => 'get_necklace', 1 => 'get_bracelet', 2 => 'get_belt', 3 => 'get_anklet', 4 => 'get_mat'],
            [0 => 'get_necklace', 1 => 'get_bracelet', 2 => 'get_belt', 3 => 'get_belt', 4 => 'get_anklet', 5 => 'get_mat'],
        ];
        $methodName = $contentSwitchCases[$num - 4][$key];
        return $this->$methodName($start, $end, $sex, $turn, $key);
    }

    public function wear_jewelry(array $plate, int $sex): array
    {
        $gram = array_column($plate['gram_statistics'], 'god_num');
        $front = array_values(array_filter($plate['front_nums']));
        $later = array_values(array_filter($plate['later_nums']));

        return $this->get_result($gram, $front, $later, $sex);
    }
}
