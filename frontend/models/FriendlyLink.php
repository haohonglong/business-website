<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-07 12:06
 */

namespace frontend\models;

use common\models\FriendlyLink as CommonFriendLink;
use yii\db\Query;

class FriendlyLink extends CommonFriendLink
{
    public static function getAll()
    {
        $model = (new Query())->select(['name', 'url'])
            ->from('friendly_link')
            ->all();
        return $model;
    }
}