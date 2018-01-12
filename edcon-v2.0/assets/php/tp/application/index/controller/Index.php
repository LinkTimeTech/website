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
        $uppath = '../../' . $savePath;
        if (!file_exists($uppath)) {
            mkdir($uppath, 0777, true);
        }
        if (!$file->checkSize(5242880)) {
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
        $errorMsg = '';
        $error = true;
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'position' => $param['position'] ?? ' ',
            'company' => $param['company'],
            // 'title' => $param['title'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'type' => $param['type'],
            'cardNumber' => $param['cardNumber'],
            'nameOnCard' => $param['nameOnCard'],
            'expiryMonth' => $param['expiryMonth'],
            'expiryYear' => $param['expiryYear'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $i) {
            if (strlen($i) <= 0) {
                $error = false;
                $errorMsg = 'Please complete the information before submit.';
                break;
            }
        }
        $chargeInfo = [
            'currency' => 'usd',
            'card' => $param['token'],
            'description' => 'EDCON charge info.',
        ];

        switch ($param['type']) {
            case '0': //早鸟
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 0, 'send' => 1])->
                count();
                if ($count > 100) {
                    $error = false;
                    $errorMsg = 'Early bird tickets sold out, please try other tickets, thanks!';
                    break;
                }
                $chargeInfo['amount'] = 560;
                break;
            case '1': //标准
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 1, 'send' => 1])->
                whereOr(['type' => 2, 'send' => 1])->
                count();
                if ($count > 350) {
                    $error = false;
                    $errorMsg = 'Standard tickets sold out, please try other tickets, thanks!';
                    break;
                }
                $chargeInfo['amount'] = 700;
                break;
            case '2': //开发者
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 1, 'send' => 1])->
                whereOr(['type' => 2, 'send' => 1])->
                count();
                if ($count > 350) {
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
                $chargeInfo['amount'] = 350;
                break;
            case '3': //学生
                $count = Db::table('Edcon_True_Participant')->
                where(['type' => 3, 'send' => 1])->
                count();
                if ($count > 50) {
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
                $chargeInfo['amount'] = 140;
                break;
        }
        $countAll = Db::table('Edcon_True_Participant')->
        where(['send' => 1, 'type' => ['<>', 4]])->
        count();
        if ($countAll > 500) {
            $error = false;
            $errorMsg = 'Tickets sold out, thank you for your support!';
        }
        if ($error) {
            try {
                $charge = \OmiseCharge::create($chargeInfo);
                $charId = $charge->offsetGet('id');
                file_put_contents('../../tmp33', var_export($charge, true));
                $charStatus = $charge->offsetGet('status');
                if ($charStatus == 'failed') {
                    return [
                        'status' => 1,
                        'message' => 'charge failed'
                    ];
                }
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
                    $qrCode->setSize(227);
                    $qrCodeSavePath = '../../upload/image/' . date('Ymd') . '/';
                    if (!file_exists($qrCodeSavePath)) {
                        mkdir($qrCodeSavePath, 0777, true);
                    }
                    $qrCodeFn = md5($qrCode->writeString()) . '.png';
                    $qrAccessPath = '/upload/image/' . date('Ymd') . '/' . $qrCodeFn;
                    file_put_contents($qrCodeSavePath . $qrCodeFn, $qrCode->writeString());

                    // $sendParam = [
                    // 'address' => $insert['email'],
                    // 'username' => $insert['name'],
                    // 'subject' => 'Purchase success.',
                    // 'body' => 'We are looking forward to seeing you! <br>Your EDCON Team.',
                    // 'altBody' => 'We are looking forward to seeing you! Your EDCON Team.'
                    // ];
                    // $url = 'https://check.junezhu.top/phpmail/sendmail.php?' . http_build_query($sendParam);
                    // file_get_contents($url);
                    $no = file_get_contents('../lib/ticket_no.log');
                    $update = [
                        'id' => $res,
                        'qrcode' => $qrAccessPath,
                        'sign' => $enInfo['sign'],
                        'ticket_no' => $no,
                        'char_id' => $charId
                    ];
                    Db::table('Edcon_True_Participant')->update($update);
                    $no++;
                    file_put_contents('../lib/ticket_no.log', $no);
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
        if ($standardAndDeveloper > 350) {
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

    public function media()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'media' => $param['media'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note']
        ];
        foreach ($insert as $i) {
            if (empty($i)) {
                return [
                    'status' => 1,
                    'message' => 'fail'
                ];
            }
        }
        Db::table('Edcon_Media')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function community()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'size' => $param['size'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note']
        ];
        foreach ($insert as $i) {
            if (empty($i)) {
                return [
                    'status' => 1,
                    'message' => 'fail'
                ];
            }
        }
        Db::table('Edcon_Community')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function speaker()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'position' => $param['position'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note']
        ];
        foreach ($insert as $i) {
            if (empty($i)) {
                return [
                    'status' => 1,
                    'message' => 'fail'
                ];
            }
        }
        Db::table('Edcon_Speaker')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function sponsor()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note']
        ];
        foreach ($insert as $i) {
            if (empty($i)) {
                return [
                    'status' => 1,
                    'message' => 'fail'
                ];
            }
        }
        Db::table('Edcon_Sponsor')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function superdemo()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note']
        ];
        foreach ($insert as $i) {
            if (empty($i)) {
                return [
                    'status' => 1,
                    'message' => 'fail'
                ];
            }
        }
        Db::table('Edcon_Superdemo')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function paintTicket()
    {
        $qrPath = '../../upload/image/20171229/8c367019301c376b03667e0211c64429.png';
        $no = 7878787;
        $name = 'JOHNAdminDOE JOHN Admin DOE';
        echo paintTicket($qrPath, $no, $name);
    }
}
