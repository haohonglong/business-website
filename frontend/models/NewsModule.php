<?php


namespace frontend\models;

use Yii;
use yii\base\Module;
use common\models\Article;

class NewsModule extends Module
{
    public static function getArticleList($id)
    {
        $sql = <<<SQL
select b.title,b.id,b.updated_at,b.summary,b.thumb 
from category as a 
LEFT JOIN article as b on a.id = b.cid 
where a.id = :id and b.status = :status
limit 0,5

SQL;

        $article = Yii::$app->db->createCommand($sql)
            ->bindValue(':id', $id)
            ->bindValue(':status', Article::ARTICLE_PUBLISHED)
            ->queryAll();
        $data = [];
        foreach ($article as $v){

            $data[] =[
                'id'=>$v['id'],
                'title'=>$v['title'],
                'summary'=>$v['summary'],
                'thumb'=>$v['thumb'],
                'date'=>date('Y-m-d',$v['updated_at']),
            ];
        }

        return $data;
    }

}