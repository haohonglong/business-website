<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-03 00:15
 */

namespace frontend\models;

use common\helpers\FamilyTree;
use common\models\Menu as CommonMenu;
use yii\helpers\ArrayHelper;

class Menu extends CommonMenu
{

    public function beforeSave($insert)
    {
        $this->type = self::FRONTEND_TYPE;
        return parent::beforeSave($insert);
    }

    private static function getTree($data = [], $parent_id = 0, $level = 0)
    {
        $tree = [];
        if ($data && is_array($data)) {
            foreach ($data as $v) {
                if ($v['parent_id'] == $parent_id) {
                    $tree[] = [
                        'id' => $v['id'],
                        'level' => $level,
                        'name' => $v['name'],
                        'url' => $v['url'],
                        'parent_id' => $v['parent_id'],
                        'children' => self::getTree($data, $v['id'], $level + 1),
                    ];
                }
            }
        }
        return $tree;
    }

    public static function getFrontMenus()
    {

        $menus = static::_getMenus(1);
        return self::getTree($menus);

    }
}