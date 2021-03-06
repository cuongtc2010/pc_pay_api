<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/10/2019
 * Time: 22:40
 */

namespace api\controllers;


use api\models\ThongTinCaNhan\ThongTinNhanVien;
use api\models\ThongTinCaNhan\ThongTinNhanVienUtil;
use api\models\User\User;
use yii\rest\Controller;
use Yii;
use common\Utilities\DatetimeUtils;

class ThongTinNhanVienController extends Controller
{
    private $_result = [
        "status" => 200,
        "data" => null
    ];
    public function verbs()
    {
        return [
            "index" => ["GET","OPTIONS"],
            "update" => ["POST","OPTIONS"]
        ];
    }


    /**
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        $modelUser = User::findIdentity($this->userId->data->id);
        if (Yii::$app->response->getStatusCode() == 200){
            if(!is_null($modelUser)){
                $modelUser["ngay_sinh"] = DatetimeUtils::formatDate($modelUser["ngay_sinh"]);
                $this->_result["data"]["profile"] = $modelUser;
                return $this->_result;
            }
            return $this->_result;
        }
        throw new NotFoundHttpException();
    }

    public function actionUpdate()
    {
        $params = Yii::$app->request->post();
        $modelThongTinNhanVien = new ThongTinNhanVien();

        if(!empty($this->userId->data->id)){
            $modelThongTinNhanVien = ThongTinNhanVien::findOne(["id"=>$this->userId->data->id]);
        }

        if (!empty($params)){
            $modelThongTinNhanVien->attributes = $params;
            if (ThongTinNhanVienUtil::saveThongTinCaNhan($modelThongTinNhanVien)){
                return $this->_result["data"] = ["message"=>"Thành công!"];
            }else{
                $this->_result["status"] = ["message" => "Thất bại!"];
            }
        }

        return $this->_result;
    }

    public function action()
    {
        return parent::actions(); // TODO: Change the autogenerated stub
    }
}