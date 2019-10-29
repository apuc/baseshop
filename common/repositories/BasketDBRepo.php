<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 21:40
 */

namespace common\repositories;


use common\interfaces\BasketRepo;
use common\models\User;
use Yii;
use yii\base\BaseObject;
use common\models\Basket;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\ErrorAction;
use yii\web\HttpException;

class BasketDBRepo extends BaseObject implements BasketRepo
{

    public function add($prodId)
    {
        if (Yii::$app->user->isGuest) {
            return;
        } else {
            $basket = new Basket();
            $basket->product_id = $prodId;
            $basket->user_id = Yii::$app->user->id;
            $basket->save();
        }
    }

    public function getList()
    {
        if (Yii::$app->user->isGuest) {
            throw new httpException(403, 'access denied');
        }
            $arr = ArrayHelper::toArray(Basket::find()->where(['user_id' => Yii::$app->user->id])->with('product')->all());
            $result = [];
            foreach ($arr as $k => $item)
            {
                $result[$k]['id'] = $item['product_id'];
                $result[$k]['count'] = 1;
            }
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        die();

       return $result;
    }

    public function remove($prodId)
    {
        if (Yii::$app->user->isGuest) {
            throw new httpException(403, 'access denied');
        } else {
            Basket::deleteAll(['user_id' => Yii::$app->user->id, 'product_id' => $prodId]);
        }
    }

    public function hasProd()
    {
        if (Yii::$app->user->isGuest) {
            throw new httpException(403, 'access denied');
        }
        if (Basket::find()->where(['user_id' => Yii::$app->user->id])) {
            return true;
        } else {
            return false;
        }
    }

    public function clear()
    {
        if (Yii::$app->user->isGuest) {
            throw new httpException(403, 'access denied');
        } else {
            Basket::deleteAll(['user_id' => Yii::$app->user->id]);
        }
    }
}