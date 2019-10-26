<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-02 21:00
 */

namespace frontend\models;

use common\models\Category;
use Yii;
use common\models\Article as CommonArticle;
use yii\data\SqlDataProvider;
use yii\web\NotFoundHttpException;

class Article extends CommonArticle
{
    /**
     * 原生sql 分页 ，判断page 是否超出总页数
     * @param $id
     * @param $page_n
     * @param int $rows
     * @return array
     * @throws \yii\db\Exception
     */
    public static function _getList($id,$page_n,$rows=10)
    {
        //处理
        $page_n = intval($page_n);
        $rows = intval($rows);
        $page_n = $page_n > 0 ? $page_n : 1;
        $rows = $rows > 0 ? $rows : 1;

        $where = "
        from category as a 
        LEFT JOIN article as b on a.id = b.cid
        where a.id = :id  and b.status = :status and b.flag_slide_show = 0
        ";

        //计算总行数
        $sql = "select count(1) $where";

        $total = Yii::$app->db->createCommand($sql,[
            ':status'=> \common\models\Article::ARTICLE_PUBLISHED,
            ':id'=>$id,
        ])->queryScalar();
        $total = intval($total);
        $total = ceil($total/$rows);
        $page_n = $page_n > $total ? $total : $page_n;
        $page_n = intval(($page_n-1)*$rows);
        $sql = "select b.title,a.name,b.id,a.id as cid,b.updated_at,b.summary,b.thumb $where order by b.id limit :m,:n";

        $models = Yii::$app->db->createCommand($sql,[
            ':status'=>Article::ARTICLE_PUBLISHED,
            ':id'=>$id,
            ':m'=>$page_n,
            ':n'=>$rows,
        ])->queryAll();
//var_dump($page_n,$rows,$total,$models);exit;
        foreach ($models as $k=> $v){
            $models[$k]['date'] = date('Y-m-d',$v['updated_at']);
        }
        return [
            'models'=>$models,
            'total'=>$total,
        ];
    }

    /**
     * 文章列表
     * @param $id
     * @param $page_n
     * @param int $rows
     * @return array
     * @throws \yii\db\Exception
     */
    public static function getList($id,$page_n,$rows=10)
    {


        $where = "
        from category as a 
        LEFT JOIN article as b on a.id = b.cid
        where a.id = :id  and b.status = :status and b.flag_slide_show = 0
        ";

        $sql = "select count(1) $where";
        $total = Yii::$app->db->createCommand($sql, [
            ':status'=> CommonArticle::ARTICLE_PUBLISHED,
            ':id'=>$id,
        ])->queryScalar();
        $sql = "select b.title,a.name,b.id,a.id as cid,b.updated_at,b.summary,b.thumb $where";

        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => [
                ':status'=>Article::ARTICLE_PUBLISHED,
                ':id'=>$id,
            ],
            'totalCount' => $total,
            'pagination' => [
                'pageSize' => $rows,
            ],
        ]);

        $models = $provider->getModels();

        foreach ($models as $k=>$v){
            $models[$k]['date'] = date('Y-m-d',$v['updated_at']);
        }
        return [
            'models'=>$models,
            'total'=>$total,
        ];
    }

    /**
     * 由类别名称获取下属的文章内容和图片，先查看类别名称是否存在如果不存在就报错
     * 此方法用于Banner
     * @param $name
     * @return array
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public static function getContentByName($name)
    {
        $category = Category::find()
            ->select(['id'])
            ->from('category')
            ->where(['alias' => $name])
            ->limit(1)
            ->one();
        if(!isset($category->id)){
            throw new NotFoundHttpException("类别名称 '{$name}' 不存在");
        }else{
            $sql = "
                select a.id,a.title,a.summary,b.value from article as a 
                left join article_meta as b on b.aid = a.id   
                where a.cid = :cid and a.status= :status
            ";
            $models = Yii::$app->db->createCommand($sql,[
                ':status'=>Article::ARTICLE_PUBLISHED,
                ':cid'=>$category->id,
            ])->queryAll();
            $arr = [];
            foreach ($models as $item){
                if(!isset($arr[$item['id']])){
                    $arr[$item['id']] = [
                        'id' => $item['id'],
                        'title' => $item['title'],
                        'summary' => $item['summary'],
                        'images' => [],
                    ];
                }
                $arr[$item['id']]['images'][] = $item['value'];

            }
            return array_values($arr);
        }

    }
}