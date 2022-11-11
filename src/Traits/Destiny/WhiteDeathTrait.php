<?php


namespace Maturest\Trigram\Traits\Destiny;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait WhiteDeathTrait
{
    protected $benGuaDetail;

    protected $wxKe = [
        ['火', '金'],
        ['金', '木'],
        ['木', '土'],
        ['土', '水'],
        ['水', '火'],
    ];

    protected $wxSheng = [
        ['a' => '木', 'b' => '火'],
        ['a' => '火', 'b' => '土'],
        ['a' => '土', 'b' => '金'],
        ['a' => '金', 'b' => '水'],
        ['a' => '水', 'b' => '木'],
    ];

    protected $kongWang;

    protected $emptyDeath = [
        ['tian_gan' => '甲', 'dizhi' => '子', 'kongwang' => '戌亥'],
        ['tian_gan' => '乙', 'dizhi' => '丑', 'kongwang' => '戌亥'],
        ['tian_gan' => '丙', 'dizhi' => '寅', 'kongwang' => '戌亥'],
        ['tian_gan' => '丁', 'dizhi' => '卯', 'kongwang' => '戌亥'],
        ['tian_gan' => '戊', 'dizhi' => '辰', 'kongwang' => '戌亥'],
        ['tian_gan' => '己', 'dizhi' => '巳', 'kongwang' => '戌亥'],
        ['tian_gan' => '庚', 'dizhi' => '午', 'kongwang' => '戌亥'],
        ['tian_gan' => '辛', 'dizhi' => '未', 'kongwang' => '戌亥'],
        ['tian_gan' => '壬', 'dizhi' => '申', 'kongwang' => '戌亥'],
        ['tian_gan' => '癸', 'dizhi' => '酉', 'kongwang' => '戌亥'],
        ['tian_gan' => '甲', 'dizhi' => '戌', 'kongwang' => '申酉'],
        ['tian_gan' => '乙', 'dizhi' => '亥', 'kongwang' => '申酉'],
        ['tian_gan' => '丙', 'dizhi' => '子', 'kongwang' => '申酉'],
        ['tian_gan' => '丁', 'dizhi' => '丑', 'kongwang' => '申酉'],
        ['tian_gan' => '戊', 'dizhi' => '寅', 'kongwang' => '申酉'],
        ['tian_gan' => '己', 'dizhi' => '卯', 'kongwang' => '申酉'],
        ['tian_gan' => '庚', 'dizhi' => '辰', 'kongwang' => '申酉'],
        ['tian_gan' => '辛', 'dizhi' => '巳', 'kongwang' => '申酉'],
        ['tian_gan' => '壬', 'dizhi' => '午', 'kongwang' => '申酉'],
        ['tian_gan' => '癸', 'dizhi' => '未', 'kongwang' => '申酉'],
        ['tian_gan' => '甲', 'dizhi' => '申', 'kongwang' => '午未'],
        ['tian_gan' => '乙', 'dizhi' => '酉', 'kongwang' => '午未'],
        ['tian_gan' => '丙', 'dizhi' => '戌', 'kongwang' => '午未'],
        ['tian_gan' => '丁', 'dizhi' => '亥', 'kongwang' => '午未'],
        ['tian_gan' => '戊', 'dizhi' => '子', 'kongwang' => '午未'],
        ['tian_gan' => '己', 'dizhi' => '丑', 'kongwang' => '午未'],
        ['tian_gan' => '庚', 'dizhi' => '寅', 'kongwang' => '午未'],
        ['tian_gan' => '辛', 'dizhi' => '卯', 'kongwang' => '午未'],
        ['tian_gan' => '壬', 'dizhi' => '辰', 'kongwang' => '午未'],
        ['tian_gan' => '癸', 'dizhi' => '巳', 'kongwang' => '午未'],
        ['tian_gan' => '甲', 'dizhi' => '午', 'kongwang' => '辰巳'],
        ['tian_gan' => '乙', 'dizhi' => '未', 'kongwang' => '辰巳'],
        ['tian_gan' => '丙', 'dizhi' => '申', 'kongwang' => '辰巳'],
        ['tian_gan' => '丁', 'dizhi' => '酉', 'kongwang' => '辰巳'],
        ['tian_gan' => '戊', 'dizhi' => '戌', 'kongwang' => '辰巳'],
        ['tian_gan' => '己', 'dizhi' => '亥', 'kongwang' => '辰巳'],
        ['tian_gan' => '庚', 'dizhi' => '子', 'kongwang' => '辰巳'],
        ['tian_gan' => '辛', 'dizhi' => '丑', 'kongwang' => '辰巳'],
        ['tian_gan' => '壬', 'dizhi' => '寅', 'kongwang' => '辰巳'],
        ['tian_gan' => '癸', 'dizhi' => '卯', 'kongwang' => '辰巳'],
        ['tian_gan' => '甲', 'dizhi' => '辰', 'kongwang' => '寅卯'],
        ['tian_gan' => '乙', 'dizhi' => '巳', 'kongwang' => '寅卯'],
        ['tian_gan' => '丙', 'dizhi' => '午', 'kongwang' => '寅卯'],
        ['tian_gan' => '丁', 'dizhi' => '未', 'kongwang' => '寅卯'],
        ['tian_gan' => '戊', 'dizhi' => '申', 'kongwang' => '寅卯'],
        ['tian_gan' => '己', 'dizhi' => '酉', 'kongwang' => '寅卯'],
        ['tian_gan' => '庚', 'dizhi' => '戌', 'kongwang' => '寅卯'],
        ['tian_gan' => '辛', 'dizhi' => '亥', 'kongwang' => '寅卯'],
        ['tian_gan' => '壬', 'dizhi' => '子', 'kongwang' => '寅卯'],
        ['tian_gan' => '癸', 'dizhi' => '丑', 'kongwang' => '寅卯'],
        ['tian_gan' => '甲', 'dizhi' => '寅', 'kongwang' => '子丑'],
        ['tian_gan' => '乙', 'dizhi' => '卯', 'kongwang' => '子丑'],
        ['tian_gan' => '丙', 'dizhi' => '辰', 'kongwang' => '子丑'],
        ['tian_gan' => '丁', 'dizhi' => '巳', 'kongwang' => '子丑'],
        ['tian_gan' => '戊', 'dizhi' => '午', 'kongwang' => '子丑'],
        ['tian_gan' => '己', 'dizhi' => '未', 'kongwang' => '子丑'],
        ['tian_gan' => '庚', 'dizhi' => '申', 'kongwang' => '子丑'],
        ['tian_gan' => '辛', 'dizhi' => '酉', 'kongwang' => '子丑'],
        ['tian_gan' => '壬', 'dizhi' => '戌', 'kongwang' => '子丑'],
        ['tian_gan' => '癸', 'dizhi' => '亥', 'kongwang' => '子丑'],
    ];

    protected $dotCoords = [
        ['position' => '11', 'x' => '164', 'y' => '142'],
        ['position' => '12', 'x' => '164', 'y' => '264'],
        ['position' => '13', 'x' => '164', 'y' => '386'],
        ['position' => '14', 'x' => '164', 'y' => '509'],
        ['position' => '15', 'x' => '164', 'y' => '631'],
        ['position' => '16', 'x' => '164', 'y' => '753'],
        ['position' => '21', 'x' => '237', 'y' => '142'],
        ['position' => '22', 'x' => '237', 'y' => '264'],
        ['position' => '23', 'x' => '237', 'y' => '386'],
        ['position' => '24', 'x' => '237', 'y' => '509'],
        ['position' => '25', 'x' => '237', 'y' => '631'],
        ['position' => '26', 'x' => '237', 'y' => '753'],
        ['position' => '31', 'x' => '295', 'y' => '145'],
        ['position' => '32', 'x' => '295', 'y' => '268'],
        ['position' => '33', 'x' => '295', 'y' => '390'],
        ['position' => '34', 'x' => '295', 'y' => '511'],
        ['position' => '35', 'x' => '295', 'y' => '635'],
        ['position' => '36', 'x' => '295', 'y' => '758'],
        ['position' => '41', 'x' => '346', 'y' => '142'],
        ['position' => '42', 'x' => '346', 'y' => '264'],
        ['position' => '43', 'x' => '346', 'y' => '386'],
        ['position' => '44', 'x' => '346', 'y' => '509'],
        ['position' => '45', 'x' => '346', 'y' => '631'],
        ['position' => '46', 'x' => '346', 'y' => '753'],
        ['position' => '51', 'x' => '438', 'y' => '142'],
        ['position' => '52', 'x' => '438', 'y' => '264'],
        ['position' => '53', 'x' => '438', 'y' => '386'],
        ['position' => '54', 'x' => '438', 'y' => '509'],
        ['position' => '55', 'x' => '438', 'y' => '631'],
        ['position' => '56', 'x' => '438', 'y' => '753'],
        ['position' => '61', 'x' => '588', 'y' => '222'],
        ['position' => '62', 'x' => '588', 'y' => '434'],
        ['position' => '63', 'x' => '588', 'y' => '643'],
        ['position' => '71', 'x' => '400', 'y' => '161'],
        ['position' => '72', 'x' => '400', 'y' => '284'],
        ['position' => '73', 'x' => '400', 'y' => '406'],
        ['position' => '74', 'x' => '400', 'y' => '528'],
        ['position' => '75', 'x' => '400', 'y' => '651'],
        ['position' => '76', 'x' => '400', 'y' => '773'],
        ['position' => '81', 'x' => '402', 'y' => '151'],
        ['position' => '82', 'x' => '402', 'y' => '273'],
        ['position' => '83', 'x' => '402', 'y' => '395'],
        ['position' => '84', 'x' => '402', 'y' => '518'],
        ['position' => '85', 'x' => '402', 'y' => '640'],
        ['position' => '86', 'x' => '402', 'y' => '762'],
    ];

    protected $coords = [
        'six_qin' => '1',
        'shi_ying' => '2',
        'gua' => '3',
        'di_zhi' => '4',
        'trans_di_zhi' => '5',
        'ri_ling' => '6',
        'hr' => '7',
        'dark_on' => '8',
    ];

    protected $totalGua = [
        '222121' => ['ben_gua' => '乾金', 'di_zhi' => '未,巳,卯,酉,未,巳', 'liu_qin' => '父,官,财,兄,父,官', 'shi_ying' => '应,,,世,,'],
        '222211' => ['ben_gua' => '乾金', 'di_zhi' => '未,巳,卯,未,巳,卯', 'liu_qin' => '父,官,财,父,官,财', 'shi_ying' => '应,,,世,,'],
        '111121' => ['ben_gua' => '乾金', 'di_zhi' => '子,寅,辰,酉,未,巳', 'liu_qin' => '子,财,父,兄,父,官', 'shi_ying' => ',,世,,,应'],
        '222221' => ['ben_gua' => '乾金', 'di_zhi' => '未,巳,卯,戌,子,寅', 'liu_qin' => '父,官,财,父,子,财', 'shi_ying' => ',应,,,世,'],
        '221111' => ['ben_gua' => '乾金', 'di_zhi' => '辰,午,申,午,申,戌', 'liu_qin' => '父,官,兄,官,兄,父', 'shi_ying' => ',世,,,应,'],
        '111111' => ['ben_gua' => '乾金', 'di_zhi' => '子,寅,辰,午,申,戌', 'liu_qin' => '子,财,父,官,兄,父', 'shi_ying' => ',,应,,,世'],
        '222111' => ['ben_gua' => '乾金', 'di_zhi' => '未,巳,卯,午,申,戌', 'liu_qin' => '父,官,财,官,兄,父', 'shi_ying' => ',,世,,,应'],
        '211111' => ['ben_gua' => '乾金', 'di_zhi' => '丑,亥,酉,午,申,戌', 'liu_qin' => '父,子,兄,官,兄,父', 'shi_ying' => '世,,,应,,'],
        '121222' => ['ben_gua' => '坎水', 'di_zhi' => '卯,丑,亥,丑,亥,酉', 'liu_qin' => '子,官,兄,官,兄,父', 'shi_ying' => '应,,,世,,'],
        '121112' => ['ben_gua' => '坎水', 'di_zhi' => '卯,丑,亥,亥,酉,未', 'liu_qin' => '子,官,兄,兄,父,官', 'shi_ying' => '应,,,世,,'],
        '212222' => ['ben_gua' => '坎水', 'di_zhi' => '寅,辰,午,丑,亥,酉', 'liu_qin' => '子,官,财,官,兄,父', 'shi_ying' => ',,世,,,应'],
        '121122' => ['ben_gua' => '坎水', 'di_zhi' => '卯,丑,亥,午,申,戌', 'liu_qin' => '子,官,兄,财,父,官', 'shi_ying' => ',应,,,世,'],
        '122212' => ['ben_gua' => '坎水', 'di_zhi' => '子,寅,辰,申,戌,子', 'liu_qin' => '兄,子,官,父,官,兄', 'shi_ying' => ',世,,,应,'],
        '212212' => ['ben_gua' => '坎水', 'di_zhi' => '寅,辰,午,申,戌,子', 'liu_qin' => '子,官,财,父,官,兄', 'shi_ying' => ',,应,,,世'],
        '121212' => ['ben_gua' => '坎水', 'di_zhi' => '卯,丑,亥,申,戌,子', 'liu_qin' => '子,官,兄,父,官,兄', 'shi_ying' => ',,世,,,应'],
        '112212' => ['ben_gua' => '坎水', 'di_zhi' => '巳,卯,丑,申,戌,子', 'liu_qin' => '财,子,官,父,官,兄', 'shi_ying' => '世,,,应,,'],
        '112211' => ['ben_gua' => '艮土', 'di_zhi' => '巳,卯,丑,未,巳,卯', 'liu_qin' => '父,官,兄,兄,父,官', 'shi_ying' => '应,,,世,,'],
        '112121' => ['ben_gua' => '艮土', 'di_zhi' => '巳,卯,丑,酉,未,巳', 'liu_qin' => '父,官,兄,子,兄,父', 'shi_ying' => '应,,,世,,'],
        '221211' => ['ben_gua' => '艮土', 'di_zhi' => '辰,午,申,未,巳,卯', 'liu_qin' => '兄,父,子,兄,父,官', 'shi_ying' => ',,世,,,应'],
        '112111' => ['ben_gua' => '艮土', 'di_zhi' => '巳,卯,丑,午,申,戌', 'liu_qin' => '父,官,兄,父,子,兄', 'shi_ying' => ',应,,,世,'],
        '111221' => ['ben_gua' => '艮土', 'di_zhi' => '子,寅,辰,戌,子,寅', 'liu_qin' => '财,官,兄,兄,财,官', 'shi_ying' => ',世,,,应,'],
        '221221' => ['ben_gua' => '艮土', 'di_zhi' => '辰,午,申,戌,子,寅', 'liu_qin' => '兄,父,子,兄,财,官', 'shi_ying' => ',,应,,,世'],
        '112221' => ['ben_gua' => '艮土', 'di_zhi' => '巳,卯,丑,戌,子,寅', 'liu_qin' => '父,官,兄,兄,财,官', 'shi_ying' => ',,世,,,应'],
        '121221' => ['ben_gua' => '艮土', 'di_zhi' => '卯,丑,亥,戌,子,寅', 'liu_qin' => '官,兄,财,兄,财,官', 'shi_ying' => '世,,,应,,'],
        '211112' => ['ben_gua' => '震木', 'di_zhi' => '丑,亥,酉,亥,酉,未', 'liu_qin' => '财,父,官,父,官,财', 'shi_ying' => '应,,,世,,'],
        '211222' => ['ben_gua' => '震木', 'di_zhi' => '丑,亥,酉,丑,亥,酉', 'liu_qin' => '财,父,官,财,父,官', 'shi_ying' => '应,,,世,,'],
        '122112' => ['ben_gua' => '震木', 'di_zhi' => '子,寅,辰,亥,酉,未', 'liu_qin' => '父,兄,财,父,官,财', 'shi_ying' => ',,世,,,应'],
        '211212' => ['ben_gua' => '震木', 'di_zhi' => '丑,亥,酉,申,戌,子', 'liu_qin' => '财,父,官,官,财,父', 'shi_ying' => ',应,,,世,'],
        '212122' => ['ben_gua' => '震木', 'di_zhi' => '寅,辰,午,午,申,戌', 'liu_qin' => '兄,财,子,子,官,财', 'shi_ying' => ',世,,,应,'],
        '122122' => ['ben_gua' => '震木', 'di_zhi' => '子,寅,辰,午,申,戌', 'liu_qin' => '父,兄,财,子,官,财', 'shi_ying' => ',,应,,,世'],
        '211122' => ['ben_gua' => '震木', 'di_zhi' => '丑,亥,酉,午,申,戌', 'liu_qin' => '财,父,官,子,官,财', 'shi_ying' => ',,世,,,应',],
        '222122' => ['ben_gua' => '震木', 'di_zhi' => '未,巳,卯,午,申,戌', 'liu_qin' => '财,子,兄,子,官,财', 'shi_ying' => '世,,,应,,',],
        '122221' => ['ben_gua' => '巽木', 'di_zhi' => '子,寅,辰,戌,子,寅', 'liu_qin' => '父,兄,财,财,父,兄', 'shi_ying' => '应,,,世,,',],
        '122111' => ['ben_gua' => '巽木', 'di_zhi' => '子,寅,辰,午,申,戌', 'liu_qin' => '父,兄,财,子,官,财', 'shi_ying' => '应,,,世,,',],
        '211221' => ['ben_gua' => '巽木', 'di_zhi' => '丑,亥,酉,戌,子,寅', 'liu_qin' => '财,父,官,财,父,兄', 'shi_ying' => ',,世,,,应',],
        '122121' => ['ben_gua' => '巽木', 'di_zhi' => '子,寅,辰,酉,未,巳', 'liu_qin' => '父,兄,财,官,财,子', 'shi_ying' => ',应,,,世,',],
        '121211' => ['ben_gua' => '巽木', 'di_zhi' => '卯,丑,亥,未,巳,卯', 'liu_qin' => '兄,财,父,财,子,兄', 'shi_ying' => ',世,,,应,',],
        '211211' => ['ben_gua' => '巽木', 'di_zhi' => '丑,亥,酉,未,巳,卯', 'liu_qin' => '财,父,官,财,子,兄', 'shi_ying' => ',,应,,,世',],
        '122211' => ['ben_gua' => '巽木', 'di_zhi' => '子,寅,辰,未,巳,卯', 'liu_qin' => '父,兄,财,财,子,兄', 'shi_ying' => ',,世,,,应',],
        '111211' => ['ben_gua' => '巽木', 'di_zhi' => '子,寅,辰,未,巳,卯', 'liu_qin' => '父,兄,财,财,子,兄', 'shi_ying' => '世,,,应,,',],
        '212111' => ['ben_gua' => '离火', 'di_zhi' => '寅,辰,午,午,申,戌', 'liu_qin' => '父,子,兄,兄,财,子', 'shi_ying' => '应,,,世,,',],
        '212221' => ['ben_gua' => '离火', 'di_zhi' => '寅,辰,午,戌,子,寅', 'liu_qin' => '父,子,兄,子,官,父', 'shi_ying' => '应,,,世,,',],
        '121111' => ['ben_gua' => '离火', 'di_zhi' => '卯,丑,亥,午,申,戌', 'liu_qin' => '父,子,官,兄,财,子', 'shi_ying' => ',,世,,,应',],
        '212211' => ['ben_gua' => '离火', 'di_zhi' => '寅,辰,午,未,巳,卯', 'liu_qin' => '父,子,兄,子,兄,父', 'shi_ying' => ',应,,,世,',],
        '211121' => ['ben_gua' => '离火', 'di_zhi' => '丑,亥,酉,酉,未,巳', 'liu_qin' => '子,官,财,财,子,兄', 'shi_ying' => ',世,,,应,',],
        '121121' => ['ben_gua' => '离火', 'di_zhi' => '卯,丑,亥,酉,未,巳', 'liu_qin' => '父,子,官,财,子,兄', 'shi_ying' => ',,应,,,世',],
        '212121' => ['ben_gua' => '离火', 'di_zhi' => '寅,辰,午,酉,未,巳', 'liu_qin' => '父,子,兄,财,子,兄', 'shi_ying' => ',,世,,,应',],
        '221121' => ['ben_gua' => '离火', 'di_zhi' => '辰,午,申,酉,未,巳', 'liu_qin' => '子,兄,财,财,子,兄', 'shi_ying' => '世,,,应,,',],
        '111212' => ['ben_gua' => '坤土', 'di_zhi' => '子,寅,辰,申,戌,子', 'liu_qin' => '财,官,兄,子,兄,财', 'shi_ying' => '应,,,世,,',],
        '111122' => ['ben_gua' => '坤土', 'di_zhi' => '子,寅,辰,午,申,戌', 'liu_qin' => '财,官,兄,父,子,兄', 'shi_ying' => '应,,,世,,',],
        '222212' => ['ben_gua' => '坤土', 'di_zhi' => '未,巳,卯,申,戌,子', 'liu_qin' => '兄,父,官,子,兄,财', 'shi_ying' => ',,世,,,应',],
        '111112' => ['ben_gua' => '坤土', 'di_zhi' => '子,寅,辰,亥,酉,未', 'liu_qin' => '财,官,兄,财,子,兄', 'shi_ying' => ',应,,,世,',],
        '112222' => ['ben_gua' => '坤土', 'di_zhi' => '巳,卯,丑,丑,亥,酉', 'liu_qin' => '父,官,兄,兄,财,子', 'shi_ying' => ',世,,,应,',],
        '222222' => ['ben_gua' => '坤土', 'di_zhi' => '未,巳,卯,丑,亥,酉', 'liu_qin' => '兄,父,官,兄,财,子', 'shi_ying' => ',,应,,,世',],
        '111222' => ['ben_gua' => '坤土', 'di_zhi' => '子,寅,辰,丑,亥,酉', 'liu_qin' => '财,官,兄,兄,财,子', 'shi_ying' => ',,世,,,应',],
        '122222' => ['ben_gua' => '坤土', 'di_zhi' => '子,寅,辰,丑,亥,酉', 'liu_qin' => '财,官,兄,兄,财,子', 'shi_ying' => '世,,,应,,',],
        '221122' => ['ben_gua' => '兑金', 'di_zhi' => '辰,午,申,午,申,戌', 'liu_qin' => '父,官,兄,官,兄,父', 'shi_ying' => '应,,,世,,',],
        '221212' => ['ben_gua' => '兑金', 'di_zhi' => '辰,午,申,申,戌,子', 'liu_qin' => '父,官,兄,兄,父,子', 'shi_ying' => '应,,,世,,',],
        '112122' => ['ben_gua' => '兑金', 'di_zhi' => '巳,卯,丑,午,申,戌', 'liu_qin' => '官,财,父,官,兄,父', 'shi_ying' => ',,世,,,应',],
        '221222' => ['ben_gua' => '兑金', 'di_zhi' => '辰,午,申,丑,亥,酉', 'liu_qin' => '父,官,兄,父,子,兄', 'shi_ying' => ',应,,,世,',],
        '222112' => ['ben_gua' => '兑金', 'di_zhi' => '未,巳,卯,亥,酉,未', 'liu_qin' => '父,官,财,子,兄,父', 'shi_ying' => ',世,,,应,',],
        '112112' => ['ben_gua' => '兑金', 'di_zhi' => '巳,卯,丑,亥,酉,未', 'liu_qin' => '官,财,父,子,兄,父', 'shi_ying' => ',,应,,,世',],
        '221112' => ['ben_gua' => '兑金', 'di_zhi' => '辰,午,申,亥,酉,未', 'liu_qin' => '父,官,兄,子,兄,父', 'shi_ying' => ',,世,,,应',],
        '212112' => ['ben_gua' => '兑金', 'di_zhi' => '寅,辰,午,亥,酉,未', 'liu_qin' => '财,父,官,子,兄,父', 'shi_ying' => '世,,,应,,',],
    ];


    /**
     * > It takes an array of objects, and returns an array of strings
     *
     * @return The object itself.
     */
    public function handleDarkOn()
    {
        $dongs = array_values(Arr::where($this->benGuaDetail, function ($item, $key) {
            return $item['is_an_dong'];
        }));

        $this->draw['an_dong']['coords'] = [];
        foreach ($dongs as $dong) {
            $this->draw['an_dong']['coords'][] = ($dong['column'] + 4) . $dong['row'];
        }

        return $this;
    }


    public function getYaoDetail()
    {
        $ben_gua = str_split($this->gua);

        $ben_di_zhi = explode(',', $this->resultDiZhi['di_zhi']);

        $ben_gua_arr = [];
        $column = '4';
        foreach ($ben_gua as $key => $value) {
            $row = (6 - $key);
            if (in_array($value, [1, 2])) {
                if ($this->isCongRelation($this->diZhiDay, $ben_di_zhi[$key])) {
                    $ben_gua_arr[] = ['dz' => $ben_di_zhi[$key], 'is_dong' => false, 'is_an_dong' => true, 'column' => $column, 'row' => $row];
                } else {
                    $ben_gua_arr[] = ['dz' => $ben_di_zhi[$key], 'is_dong' => false, 'is_an_dong' => false, 'column' => $column, 'row' => $row];
                }
            } else {
                $ben_gua_arr[] = ['dz' => $ben_di_zhi[$key], 'is_dong' => true, 'is_an_dong' => false, 'column' => $column, 'row' => $row];
            }
        }

        $this->benGuaDetail = $ben_gua_arr;

        return $this;
    }



    /**
     * A function to judge whether a person is dangerous or not.
     *
     * @param arr the array of the original hexagram and the transformed hexagram
     */
    public function getIsDangerous($arr)
    {
        $res = [];
        $ben_gua_dz = mb_substr($arr['ben_gua'], -1, 1);
        $tans_gua_dz = mb_substr($arr['gua_bian'], -1, 1);
        $res['is_dangerous'] = $this->judgeIsDangerous($tans_gua_dz, $ben_gua_dz);
        $res['dangerous_note'] = $this->judgeDangerousNote($tans_gua_dz, $ben_gua_dz);

        return $res;
    }


    /**
     * > It returns true if the two given numbers are in the array `->wxKe`
     *
     * @param dz_one The first point of the two points to be judged
     * @param dz_two the second dice
     */
    public function judgeIsDangerous($dz_one, $dz_two)
    {
        return in_array([$dz_one, $dz_two], $this->wxKe);
    }


    /**
     * > If the string starts with `` and ends with ``, return the string after ``
     * and before ``
     *
     * @param dz_one The first note of the two notes
     * @param dz_two The first two characters of the current address
     *
     * @return the note for the dangerous combination of the two given dizhi.
     */
    public function judgeDangerousNote($dz_one, $dz_two)
    {
        foreach ($this->dangerous as $dangerous) {
            if (Str::startsWith($dangerous, "{$dz_two}变{$dz_one}")) {
                return Str::after($dangerous, "{$dz_two}变{$dz_one}：");
            }
        }
        return '';
    }


    /**
     * > It returns true if the two given numbers are in the array of valid combinations
     *
     * @param wx_one The first card
     * @param wx_two The second card
     */
    public function judgeIsGrow($wx_one, $wx_two)
    {
        return in_array(['a' => $wx_one, 'b' => $wx_two], $this->wxSheng);
    }


    /**
     * > Given a wuxing, return the wuxing that grows it
     *
     * @param wx the wx you want to get the who-grew-me for
     */
    public function getWhoGrowMe($wx)
    {
        $row = collect($this->wxSheng)->where('b', $wx)->first();
        return $row['a'];
    }


    /**
     * It returns the first element of the array that matches the condition.
     *
     * @param wx the wechat id of the person you want to send the message to
     *
     * @return The name of the person who has the given WeChat ID.
     */
    public function getWhoKeMe($wx)
    {
        $row = collect($this->wxKe)->first(function ($value, $key) use ($wx) {
            return $value[1] == $wx;
        });
        return $row[0];
    }


    /**
     * It takes the gua number, and returns the gua number of the ben gua, and the di zhi of the ben
     * gua
     *
     * @return An array with the trans_di_zhi and gua_bian keys.
     */
    public function transBenGua()
    {
        $arr = [];
        $trans_gua = str_replace('3', '2', $this->gua);
        $trans_gua = str_replace('4', '1', $trans_gua);

        $trans = $this->getBaGuaByGua($trans_gua);

        $trans_di_zhi = explode(',', $trans['di_zhi']);
        $original_gua_arr = str_split($this->gua);
        foreach ($original_gua_arr as $key => $value) {
            if (in_array($value, [1, 2])) {
                $trans_di_zhi[$key] = '';
            }
        }
        $arr['trans_di_zhi'] = implode(',', $trans_di_zhi);

        $need_gua_bian = $this->upEqualDown();
        if ($need_gua_bian) {
            $arr['gua_bian'] = $trans['ben_gua'];
        }

        return $arr;
    }


    /**
     * It takes a string of numbers and returns a string of numbers.
     *
     * @return The trans_gua is being returned.
     */
    public function getTransGua()
    {
        $original_gua_arr = str_split($this->gua);
        $trans_gua = [];
        foreach ($original_gua_arr as $val) {
            if ($val == '1') {
                $trans_gua[] = '2';
            } else if ($val == '2') {
                $trans_gua[] = '1';
            } else {
                $trans_gua[] = $val;
            }
        }
        $trans_gua = implode('', $trans_gua);

        return $trans_gua;
    }


    /**
     * It checks if the resultDiZhi array has a key called 'trans_di_zhi' and if it has a value.
     *
     * @return The result of the function is the value of the variable
     * ->resultDiZhi['trans_di_zhi'].
     */
    public function transGuaExists()
    {
        return isset($this->resultDiZhi['trans_di_zhi']) && $this->resultDiZhi['trans_di_zhi'];
    }


    /**
     * It returns the kongwang of the day.
     *
     * @return The object itself.
     */
    public function whiteDeath()
    {
        $row = collect($this->emptyDeath)
            ->where('tian_gan', $this->tianGanDay)
            ->where('dizhi', $this->diZhiDay)
            ->first();

        $this->kongWang = $row['kongwang'];

        return $this;
    }


    /**
     * It takes the coordinates of the two death stars and the coordinates of the two trans-death stars
     * and merges them into one array
     *
     * @return The object itself.
     */
    public function handleWhiteDeath()
    {
        $di_zhi_coords = $this->getCoords($this->resultDiZhi['di_zhi']);
        $trans_di_zhi_coords = $this->getCoords($this->resultDiZhi['trans_di_zhi'], 'trans');
        $dots = array_merge($di_zhi_coords, $trans_di_zhi_coords);

        $coords = $this->getCoordsByDots($dots);
        $this->draw['kong_wang']['coords'] = $coords;
        return $this;
    }


    /**
     * It takes a string of numbers separated by commas, and returns an array of coordinates
     *
     * @param di_zhi The address of the empty position, such as:
     * "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25
     * @param type original or trans_di_zhi
     */
    public function getCoords($di_zhi, $type = 'original')
    {
        $coords = [];
        collect(array_reverse(explode(',', $di_zhi)))->each(function ($item, $key) use ($type, &$coords) {
            if (Str::contains($this->kongWang, $item)) {
                if ($type == 'original') {
                    $coords[] = $this->coords['di_zhi'] . ($key + 1);
                } else {
                    $coords[] = $this->coords['trans_di_zhi'] . ($key + 1);
                }
            }
        });

        return $coords;
    }


    /**
     * It takes an array of dot positions and returns an array of coordinates
     *
     * @param dots an array of dot positions, e.g. [1, 2, 3, 4, 5, 6, 7, 8, 9]
     *
     * @return An array of arrays.
     */
    public function getCoordsByDots($dots)
    {
        $coords = [];
        foreach ($dots as $position) {
            $xy = collect($this->dotCoords)->where('position', $position)->first();
            $x = Arr::get($xy, 'x');
            $y = Arr::get($xy, 'y');
            $coords[] = compact('x', 'y', 'position');
        }
        return $coords;
    }


}
