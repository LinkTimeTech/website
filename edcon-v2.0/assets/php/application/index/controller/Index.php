<?php

namespace app\index\controller;

use think\Db;
use think\Controller;
use Endroid\QrCode\QrCode;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Index extends Controller
{
    public function _initialize()
    {
        config('default_return_type', 'json');
    }

    public function uploadfile()
    {

        $file = $this->request->file('image');
        $savePath = 'upload/image/' . date('Ymd') . DS;
        $uppath = SERVER_ROOT . $savePath;
        if (!file_exists($uppath)) {
            mkdir($uppath, 0777, true);
        }
        if (!$file->checkSize(5120)) {
            return [
                'status' => 1,
                'message' => 'The profile is too large. Image must be smaller than 5m.'
            ];
        }
        $tmpName = $file->getInfo('tmp_name');
        $fi = new \finfo(FILEINFO_MIME_TYPE);
        $mime = explode('/', $fi->file($tmpName));
        if ($mime[0] != 'image') {
            return [
                'status' => 1,
                'message' => 'upload fail your upload file is not a picture.',
            ];
        }
        $ext = '.' . $mime[1];
        $fn = md5_file($tmpName);
        $saveName = $uppath . $fn . $ext;
        move_uploaded_file($tmpName, $saveName);
        $src = '/' . $savePath . $fn . $ext;
        return [
            'status' => 0,
            'message' => 'upload success.',
            'data' => [
                'src' => $src
            ]
        ];
    }

    public function registration()
    {
        require_once '../lib/vendor/autoload.php';
        require_once '../lib/qrcode/vendor/autoload.php';
        define('OMISE_PUBLIC_KEY', 'pkey_test_5acsuittt50wpshlf49');
        define('OMISE_SECRET_KEY', 'skey_test_5aaqj86dz4wq716mo0m');
        $errorMsg = '';
        $error = true;
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'title' => $param['title'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'type' => $param['type'],
            'cardNumber' => $param['cardNumber'],
            'nameOnCard' => $param['nameOnCard'],
            'expiryMonth' => $param['expiryMonth'],
            'expiryYear' => $param['expiryYear'],
            'securityCode' => $param['securityCode']
        ];
        foreach ($insert as $i) {
            if (strlen($i) <= 0) {
                $error = false;
                $errorMsg = 'Please complete the information before submit.';
                break;
            }
        }
        $chargeInfo = [
            'currency' => 'sgd',
            'card' => $param['token'],
            'description' => 'EDCON charge info.',
        ];

        switch ($param['type']) {
            case '0': //早鸟
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 0])->
                count();
                if ($count > 100) {
                    $error = false;
                    $errorMsg = 'Early bird tickets sold out, please try other tickets, thanks!';
                    break;
                }
                $chargeInfo['amount'] = 56000;
                break;
            case '1': //标准
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 1])->
                whereOr(['type' => 2])->
                count();
                if ($count > 450) {
                    $error = false;
                    $errorMsg = 'Standard tickets sold out, please try other tickets, thanks!';
                    break;
                }
                $chargeInfo['amount'] = 70000;
                break;
            case '2': //开发者
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 1])->
                whereOr(['type' => 2])->
                count();
                if ($count > 450) {
                    $error = false;
                    $errorMsg = 'Developer tickets sold out, please try other tickets, thanks!';
                    break;
                }
                if (empty($param['repo'])) {
                    $error = false;
                    $errorMsg = 'Please complete the information before submit.';
                    break;
                }
                $insert['repo'] = $param['repo'];
                $chargeInfo['amount'] = 35000;
                break;
            case '3': //学生
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 3])->
                count();
                if ($count > 100) {
                    $error = false;
                    $errorMsg = 'Student tickets sold out, please try other tickets, thanks!';
                    break;
                }
                if (empty($param['school'])) {
                    $error = false;
                    $errorMsg = 'Please enter your school name.';
                    break;
                }
                if (empty($param['student_card'])) {
                    $error = false;
                    $errorMsg = 'Please upload the picture of your student card.';
                    break;
                }
                $insert['school'] = $param['school'];
                $insert['student_card'] = $param['student_card'];
                $chargeInfo['amount'] = 14000;
                break;
        }
        $countAll = Db::table('Edcon_True_Participant')->count();
        if ($countAll > 600) {
            $error = false;
            $errorMsg = 'Tickets sold out, thank you for your support!';
        }
        if ($error) {
            try {
                $charge = \OmiseCharge::create($chargeInfo);
                $res = Db::table('Edcon_True_Participant')->insertGetId($insert);
                if ($res) {
                    $info = [
                        'id' => $res,
                        'name' => $insert['name'],
                        'email' => $insert['email'],
                        'type' => $insert['type'],
                    ];
                    $enInfo = [];
                    $enInfo['id'] = $info['id'];
                    $enInfo['sign'] = sha1(md5(json_encode($info, 256)));
                    $qrCode = new QrCode(json_encode($enInfo, 256));
                    $qrCode->setWriterByName('png');
                    $qrCode->setSize(200);
                    $qrCodeSavePath = '../../upload/image/' . date('Ymd') . '/';
                    if (!file_exists($qrCodeSavePath)) {
                        mkdir($qrCodeSavePath, 0777, true);
                    }
                    $qrCodeFn = md5($qrCode->writeString()) . '.png';
                    $qrAccessPath = '/upload/image/' . date('Ymd') . '/' . $qrCodeFn;
                    file_put_contents($qrCodeSavePath . $qrCodeFn, $qrCode->writeString());

                    $sendParam = [
                        'address' => $insert['email'],
                        'username' => $insert['name'],
                        'subject' => 'Purchase success.',
                        'body' => 'We are looking forward to seeing you! <br>Your EDCON Team.',
                        'altBody' => 'We are looking forward to seeing you! Your EDCON Team.'
                    ];
                    $url = 'https://check.junezhu.top/phpmail/sendmail.php?' . http_build_query($sendParam);
                    file_get_contents($url);
                    $update = [
                        'id' => $res,
                        'qrcode' => $qrAccessPath,
                        'sign' => $enInfo['sign']
                    ];
                    Db::table('Edcon_True_Participant')->update($update);
                    return [
                        'status' => 0,
                        'message' => '注册成功'
                    ];
                } else {
                    return [
                        'status' => 2,
                        'message' => '注册失败'
                    ];
                }
            } catch (\OmiseException $e) {
                return [
                    'status' => 1,
                    'message' => $e->getMessage()
                ];
            }
        } else {
            return [
                'status' => 2,
                'message' => $errorMsg,
            ];
        }
    }

    public function phpinfo()
    {
        phpinfo();
    }

    public function getSoltInfo()
    {
        $res = [];
        $early = Db::table('Edcon_True_Participant')->where(['type' => 0])->count();
        $standardAndDeveloper = Db::table('Edcon_True_Participant')->where(['type' => 1])->whereOr(['type' => 2])->count();
        $student = Db::table('Edcon_True_Participant')->where(['type' => 3])->count();
        if ($early > 100) {
            $res['early_solt_out'] = 1;
        } else {
            $res['early_solt_out'] = 0;
        }
        if ($standardAndDeveloper > 450) {
            $res['standardAndDeveloper_solt_out'] = 1;
        } else {
            $res['standardAndDeveloper_solt_out'] = 0;
        }
        if ($student > 50) {
            $res['student_solt_out'] = 1;
        } else {
            $res['student_solt_out'] = 0;
        }
        return $res;
    }
}
