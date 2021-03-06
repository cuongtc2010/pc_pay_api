<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/2/2019
 * Time: 23:42
 */

namespace api\models\SanPham;


use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use yii\db\ActiveRecord;


/**
 * @property string $ma_sp
 * @property string $ten_sp
 * @property string $gia
 * @property string $so_luong
 * @property string $don_gia
 * @property bool $is_delete
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $created_at
 */
class SanPham extends ActiveRecord
{
    public static function tableName()
    {
        return '{{san_pham}}'; // TODO: Change the autogenerated stub
    }

    public function rules()
    {
        return [
            ["ma_sp","trim"],
            ["ten_sp","trim"],
            ["gia","trim"],
            ["so_luong","trim"],
            ["don_gia","trim"],
            ["is_delete","default", "value"=>0],
            ['created_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['updated_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['created_by', 'default', 'value' => SessionUtils::getUsername()],
            ['updated_by', 'default', 'value' => SessionUtils::getUsername()]
        ];
    }
}