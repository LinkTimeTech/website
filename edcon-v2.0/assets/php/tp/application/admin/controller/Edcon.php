<?php

namespace app\admin\controller;

use think\Db;
use Endroid\QrCode\QrCode;
use think\Controller;

class Edcon extends Controller
{

    public function _initialize()
    {
        config('default_return_type', 'json');
        define('PAGE_LIMIT', 20);
        $username = session('username');
        $id = session('id');
        if (empty($username) || empty($id)) {
            // echo json_encode([
            // 'status' => 127,
            // 'message' => '未登陆'
            // ],256);
            // exit;
        }
        $where = [
            'username' => $username,
            'id' => $id
        ];
        $exists = Db::table('Edcon_Administrators')->where($where)->find();
        if ($exists) {
            return;
        }
        $module = strtolower($this->request->module());
        $controller = strtolower($this->request->controller());
        $action = strtolower($this->request->action());
        $route = $module . '/' . $controller . '/' . $action;
        $allowList = [
            'admin/edcon/login',
            'admin/edcon/getloginstatus'
        ];
        if (in_array($route, $allowList)) {
            return;
        }
        // echo json_encode([
        // 'status' => 127,
        // 'message' => '未登陆'
        // ],256);
        // exit;
    }
	
    public function index()
    {

    }

    public function registrationStatistics() // 五张表count
    {
        $registration = [];
        $where = [
            'del' => 0
        ];
        $registration[] = [
            'name' => 'speaker',
            'value' => Db::table('Edcon_Speaker')->where($where)->count()
        ];

        $registration[] = [
            'name' => 'sponsor',
            'value' => Db::table('Edcon_Sponsor')->where($where)->count()
        ];

        $registration[] = [
            'name' => 'media',
            'value' => Db::table('Edcon_Media')->where($where)->count()
        ];

        $registration[] = [
            'name' => 'superdemo',
            'value' => Db::table('Edcon_Superdemo')->where($where)->count()
        ];

        $registration[] = [
            'name' => 'community',
            'value' => Db::table('Edcon_Community')->where($where)->count()
        ];
        $total = 0;
        foreach ($registration as $reg) {
            $total += $reg['value'];
        }
        return [
            'status' => 0,
            'message' => 'success',
            'data' => [
                'registration' => $registration,
                'total' => $total
            ]
        ];
    }

    public function ticketStatistics()  //五种type count
    {
        $ticket = [];//0:早鸟 1:标准 2:开发者 3:学生 4:免费

        $ticket[] = [
            'name' => 'early',
            'value' => Db::table('Edcon_True_Participant')->where(['type' => 0, 'del' => 0])->count()
        ];
        $ticket[] = [
            'name' => 'standard',
            'value' => Db::table('Edcon_True_Participant')->where(['type' => 1, 'del' => 0])->count()
        ];
        $ticket[] = [
            'name' => 'developer',
            'value' => Db::table('Edcon_True_Participant')->where(['type' => 2, 'del' => 0])->count()
        ];
        $ticket[] = [
            'name' => 'student',
            'value' => Db::table('Edcon_True_Participant')->where(['type' => 3, 'del' => 0])->count()
        ];
        $ticket[] = [
            'name' => 'free',
            'value' => Db::table('Edcon_True_Participant')->where(['type' => 4, 'del' => 0])->count()
        ];
        $total = 0;
        foreach ($ticket as $t) {
            $total += $t['value'];
        }
        return [
            'status' => 0,
            'message' => 'success',
            'data' => [
                'ticket' => $ticket,
                'total' => $total
            ]
        ];
    }

    public function earlyTickeyList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $totalPage = ceil(Db::table('Edcon_True_Participant')->where(['type' => 0, 'del' => 0])->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 0, 'del' => 0])->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];

    }

    public function studentTickeyList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $totalPage = ceil(Db::table('Edcon_True_Participant')->where(['type' => 3, 'del' => 0])->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 3, 'del' => 0])->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function standardTickeyList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $totalPage = ceil(Db::table('Edcon_True_Participant')->where(['type' => 1, 'del' => 0])->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 1, 'del' => 0])->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function developerTickeyList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $totalPage = ceil(Db::table('Edcon_True_Participant')->where(['type' => 2, 'del' => 0])->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 2, 'del' => 0])->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function freeTickeyList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $totalPage = ceil(Db::table('Edcon_True_Participant')->where(['type' => 4, 'del' => 0])->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 4, 'del' => 0])->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function speakerList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $where = [
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Speaker')->where($where)->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Speaker')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function sponsorList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $where = [
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Sponsor')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Sponsor')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function mediaList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $where = [
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Media')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Media')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function superdemoList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $where = [
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Superdemo')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Superdemo')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function communityList()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }
        $where = [
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Community')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Community')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function getLoginStatus()
    {
        $username = session('username');
        $id = session('id');
        if (empty($username) || empty($id)) {
            return [
                'status' => 127,
                'message' => 'no login'
            ];
        }
        $where = [
            'username' => $username,
            'id' => $id
        ];
        $exists = Db::table('Edcon_Administrators')->where($where)->find();

        if ($exists) {
            return [
                'status' => 0,
                'message' => 'logged'
            ];
        } else {
            return [
                'status' => 127,
                'message' => 'no login'
            ];
        }
    }

    public function pass()
    {
        ignore_user_abort(true);
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => '1',
                'message' => '缺少参数id'
            ];
        }
        try {
            // SET SESSION wait_timeout = 28800;
            Db::execute('SET SESSION wait_timeout = 28800;');
            $pass = Db::table('Edcon_True_Participant')->where(['id' => $param['id']])->find();
            $ticketImage = paintTicket($pass['qrcode'], $pass['ticket_no'], $pass['name']);
            sendTicketMail($pass['email'], $ticketImage, $pass['type']);
            Db::table('Edcon_True_Participant')->
            where(['id' => $param['id']])->
            update(['pass' => 1, 'send' => 1]);
            $res = [
                'status' => 0,
                'message' => 'success'
            ];

        } catch (\Exception $e) {
            $update = [
                'send' => 2,
                'send_mail_error_message' => $e->getMessage(),
                'resend_count' => ++$pass['resend_count']
            ];
            Db::table('Edcon_True_Participant')->
            where(['id' => $param['id']])->
            update($update);
            $res = [
                'status' => 1,
                'message' => 'send mail fail'
            ];
        }
        return $res;
    }

    public function reject()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => '1',
                'message' => '缺少参数id'
            ];
        }
        try {
            $rej = Db::table('Edcon_True_Participant')->where(['id' => $param['id']])->find();
            sendRejectMail($rej['email']);
            $charge = \OmiseCharge::retrieve($rej['char_id']);
            switch ($rej['type']) {
                case '2':
                    $ammount = ['amount' => 350];
                    break;
                case '3':
                    $ammount = ['amount' => 140];
                    break;
            }
            $refund = $charge->refunds()->create($ammount);
            Db::table('Edcon_True_Participant')->
            where(['id' => $param['id']])->
            update(['pass' => 2, 'send' => 1]);
            $res = [
                'status' => 0,
                'message' => 'success',
            ];
        } catch (\Exception $e) {
            $res = [
                'status' => 1,
                'message' => 'send mail fail'
            ];
        }
        return $res;
    }

    public function editTicket()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => '1',
                'message' => '缺少参数id'
            ];
        }
        Db::table('Edcon_True_Participant')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    // public function deleteParticipant()
    // {
    // $param = $this->request-param();
    // Db::table('Edcon_True_Participant')->where(['id' => $param['id']])->delete();
    // return [
    // 'status' => 0,
    // 'message' => 'success'
    // ];
    // }

    public function paint()
    {
        $parts = Db::table('Edcon_True_Participant')->
        where(['type' => 0])->
        whereOr(['type' => 1])->
        select();
        $i = 0;
        foreach ($parts as $p) {
            try {
                $ticket = paintTicket($p['qrcode'], $p['ticket_no'], $p['name']);
                Db::table('Edcon_True_Participant')->
                update(['id' => $p['id'], 'ticket_image' => $ticket, 'ticket_status' => 1]);
            } catch (\Exception $e) {
                $i++;
            }
        }
        return [
            'status' => 0,
            'message' => $i,
            'date' => date('Y-m-d H:i:s')
        ];
    }

    public function sendmail()
    {
        $where = [
            'ticket_status' => 1,
            'send' => ['IN', '0,2'],
            'type' => ['IN', '0,1'],
            'sending' => 0
        ];
        Db::execute('SET SESSION wait_timeout = 28800;');
        $i = 0;
        $j = 0;
        $sends = Db::table('Edcon_True_Participant')->where($where)->select();
        foreach ($sends as $s) {
            try {
                Db::table('Edcon_True_Participant')->update(['sending' => 1, 'id' => $s['id']]);
                sendTicketMail($s['email'], $s['ticket_image'], $s['type']);
                Db::table('Edcon_True_Participant')->update(['send' => 1, 'id' => $s['id']]);
                $j++;
            } catch (\Exception $e) {
                $update = [
                    'send' => 2,
                    'id' => $s['id'],
                    'send_mail_error_message' => $e->getMessage(),
                    'resend_count' => ++$s['resend_count'],
                    'sending' => 0
                ];
                Db::table('Edcon_True_Participant')->update($update);
                $i++;
            }
        }
        return [
            'status' => 0,
            'message' => $i,
            'count' => $j,
            'date' => date('Y-m-d H:i:s')
        ];
    }

    public function addFreeTicket()
    {
        $param = $this->request->param();
        $no = file_get_contents('../lib/ticket_no.log');
        $insert = [
            'name' => $param['name'],
            'email' => $param['email'],
            'type' => 4,
            'country' => $param['country'],
            'position' => $param['position'],
            'phone' => $param['phone'],
            'ticket_no' => $no,
            'company' => $param['company'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 1) {
                return [
                    'status' => 1,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        $id = Db::table('Edcon_True_Participant')->insertGetId($insert);
        $data = Db::table('Edcon_True_Participant')->find($id);
        $no++;
        file_put_contents('../lib/ticket_no.log', $no);
        $info = [
            'id' => $id,
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
        $update = [
            'id' => $id,
            'qrcode' => $qrAccessPath,
            'sign' => $enInfo['sign'],
        ];
        Db::table('Edcon_True_Participant')->update($update);
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function ticketSearch()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (!isset($param['keyword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        if (!isset($param['type'])) {
            return [
                'status' => '1',
                'message' => '缺少参数type'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;

        $where = [
            'name|country|email|phone|school|company|time|position|ticket_no' => ['LIKE', "%{$param['keyword']}%"], 'type' => $param['type'], 'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_True_Participant')->where($where)->count() / PAGE_LIMIT);
        $data = Db::table('Edcon_True_Participant')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'totalPage' => $totalPage
        ];
    }

    public function speakerSearch()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (!isset($param['keyword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "%{$param['keyword']}%"],
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Speaker')->where($where)->count() / PAGE_LIMIT);
        $data = Db::table('Edcon_Speaker')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'totalPage' => $totalPage
        ];
    }

    public function sponsorSearch()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (!isset($param['keyword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "%{$param['keyword']}%"],
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Sponsor')->where($where)->count() / PAGE_LIMIT);
        $data = Db::table('Edcon_Sponsor')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'totalPage' => $totalPage
        ];
    }

    public function mediaSearch()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (!isset($param['keyword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "%{$param['keyword']}%"],
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Media')->where($where)->count() / PAGE_LIMIT);
        $data = Db::table('Edcon_Media')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'totalPage' => $totalPage
        ];
    }

    public function communitySearch()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (!isset($param['keyword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "%{$param['keyword']}%"],
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Community')->where($where)->count() / PAGE_LIMIT);
        $data = Db::table('Edcon_Community')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'totalPage' => $totalPage
        ];
    }

    public function superdemoSearch()
    {
        $param = $this->request->param();
        if (!isset($param['page'])) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (!isset($param['keyword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "%{$param['keyword']}%"],
            'del' => 0
        ];
        $totalPage = ceil(Db::table('Edcon_Superdemo')->where($where)->count() / PAGE_LIMIT);
        $data = Db::table('Edcon_Superdemo')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'totalPage' => $totalPage
        ];
    }

    public function login()
    {
        $param = $this->request->param();
        if (!isset($param['username'])) {
            return [
                'status' => '1',
                'message' => '缺少参数username'
            ];
        }

        if (!isset($param['password'])) {
            return [
                'status' => '1',
                'message' => '缺少参数password'
            ];
        }
        $where = [
            'username' => $param['username'],
            'password' => md5($param['password'])
        ];
        $exists = Db::table('Edcon_Administrators')->where($where)->find();
        if ($exists) {
            session('username', $exists['username']);
            session('id', $exists['id']);
            return [
                'status' => 0,
                'message' => 'success'
            ];
        } else {
            return [
                'status' => 1,
                'message' => '用户名或密码错误'
            ];
        }
    }

    public function logout()
    {
        session(null);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function password()
    {
        $param = $this->request->param();
        if (!isset($param['oldPassword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        if (!isset($param['newPassword'])) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $where = [
            'username' => session('username'),
            'password' => md5($param['oldPassword'])
        ];
        $exists = Db::table('Edcon_Administrators')->where()->find();
        if ($exists) {
            $newPassword = md5($param['newPassword']);
            Db::table('Edcon_Administrators')->
            where(['id' => $exists['id']])->
            update(['password' => $newPassword]);
        } else {
            return [
                'status' => 1,
                'message' => '旧密码错误'
            ];
        }

    }

    public function addCommunity()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note'],
            'size' => $param['size'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        $id = Db::table('Edcon_Community')->insertGetId($insert);
        $data = Db::table('Edcon_Community')->find($id);
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function addMedia()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note'],
            'media' => $param['media'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        $id = Db::table('Edcon_Media')->insertGetId($insert);
        $data = Db::table('Edcon_Media')->find($id);
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function addSpeaker()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'position' => $param['position'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        $id = Db::table('Edcon_Speaker')->insertGetId($insert);
        $data = Db::table('Edcon_Speaker')->find($id);
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function addSponsor()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        $id = Db::table('Edcon_Sponsor')->insertGetId($insert);
        $data = Db::table('Edcon_Sponsor')->find($id);
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }


    public function addSuperdemo()
    {
        $param = $this->request->param();
        $insert = [
            'name' => $param['name'],
            'country' => $param['country'],
            'company' => $param['company'],
            'email' => $param['email'],
            'phone' => $param['phone'],
            'note' => $param['note'],
            'time' => date('Y-m-d H:i:s')
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        $id = Db::table('Edcon_Superdemo')->insertGetId($insert);
        $data = Db::table('Edcon_Superdemo')->find($id);
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function deleteCommunity()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $update = [
            'del' => 1
        ];
        Db::table('Edcon_Community')->where($where)->update($update);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function deleteMedia()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $update = [
            'del' => 1
        ];
        Db::table('Edcon_Media')->where($where)->update($update);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function deleteSpeaker()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $update = [
            'del' => 1
        ];
        Db::table('Edcon_Speaker')->where($where)->update($update);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function deleteSponsor()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $update = [
            'del' => 1
        ];
        Db::table('Edcon_Sponsor')->where($where)->update($update);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function deleteSuperdemo()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $update = [
            'del' => 1
        ];
        Db::table('Edcon_Superdemo')->where($where)->update($update);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function editCommunity()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        Db::table('Edcon_Community')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function editMedia()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        Db::table('Edcon_Media')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function editSpeaker()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        Db::table('Edcon_Speaker')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function editSponsor()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        Db::table('Edcon_Sponsor')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function editSuperdemo()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        Db::table('Edcon_Superdemo')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function getTicket()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $data = Db::table('Edcon_True_Participant')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function getCommunity()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $data = Db::table('Edcon_Community')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function getMedia()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $data = Db::table('Edcon_Media')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function getSpeaker()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $data = Db::table('Edcon_Speaker')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function getSponsor()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $data = Db::table('Edcon_Sponsor')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function getSuperdemo()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $data = Db::table('Edcon_Superdemo')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function deleteTicket()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => 0,
                'message' => '缺少参数id'
            ];
        }
        $where = [
            'id' => $param['id']
        ];
        $update = [
            'del' => 1
        ];
        Db::table('Edcon_True_Participant')->where($where)->update($update);
        return [
            'status' => 0,
            'message' => 'success',
        ];
    }

    public function mailList()//0 :pass 1:reject 2:免费送
    {
        $data = Db::table('Edcon_Mail_template')->select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function editMail()
    {
        $param = $this->request->param();
        if (!isset($param['type'])) {
            return [
                'status' => 0,
                'message' => '缺少参数type'
            ];
        }
        $where = [
            'type' => $param['type']
        ];
        Db::table('Edcon_Mail_template')->where($where)->update($param);
        return [
            'status' => 0,
            'message' => 'success',
        ];
    }

    public function getMail()
    {
        $param = $this->request->param();
        if (!isset($param['type'])) {
            return [
                'status' => 0,
                'message' => '缺少参数type'
            ];
        }
        $where = [
            'type' => $param['type']
        ];
        $data = Db::table('Edcon_Mail_template')->where($where)->find();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }
}