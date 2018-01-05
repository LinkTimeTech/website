<?php

namespace app\admin\controller;

use think\Db;
use think\Controller;

class Edcon extends Controller
{

    public function _initialize()
    {
        config('default_return_type', 'json');
        define('PAGE_LIMIT', 20);
    }

    public function index()
    {

    }

    public function registrationStatistics() // 五张表count
    {
        $registration = [];
        $registration[] = [
            'name' => 'speaker',
            'value' => Db::table('Edcon_Speaker')->count()
        ];

        $registration[] = [
            'name' => 'sponsor',
            'value' => Db::table('Edcon_Sponsor')->count()
        ];

        $registration[] = [
            'name' => 'media',
            'value' => Db::table('Edcon_Media')->count()
        ];

        $registration[] = [
            'name' => 'superdemo',
            'value' => Db::table('Edcon_Superdemo')->count()
        ];

        $registration[] = [
            'name' => 'community',
            'value' => Db::table('Edcon_Community')->count()
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
            'value' => Db::table('Edcon_Ticket')->where(['type' => 0])->count()
        ];

        $ticket[] = [
            'name' => 'standard',
            'value' => Db::table('Edcon_Ticket')->where(['type' => 1])->count()
        ];
        $ticket[] = [
            'name' => 'developer',
            'value' => Db::table('Edcon_Ticket')->where(['type' => 2])->count()
        ];
        $ticket[] = [
            'name' => 'student',
            'value' => Db::table('Edcon_Ticket')->where(['type' => 3])->count()
        ];
        $ticket[] = [
            'name' => 'free',
            'value' => Db::table('Edcon_Ticket')->where(['type' => 4])->count()
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
        $totalPage = ceil(Db::table('Edcon_True_Participant')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 0])->
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
        $totalPage = ceil(Db::table('Edcon_True_Participant')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 1])->
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
        $totalPage = ceil(Db::table('Edcon_True_Participant')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 2])->
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
        $totalPage = ceil(Db::table('Edcon_True_Participant')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 3])->
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
        $totalPage = ceil(Db::table('Edcon_True_Participant')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_True_Participant')->
        where(['type' => 4])->
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
        $totalPage = ceil(Db::table('Edcon_Speaker')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Speaker')->
        limit($start, PAGE_LIMIT)->
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
        $totalPage = ceil(Db::table('Edcon_Sponsor')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Sponsor')->
        limit($start, PAGE_LIMIT)->
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
        $totalPage = ceil(Db::table('Edcon_Media')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Media')->
        limit($start, PAGE_LIMIT)->
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
        $totalPage = ceil(Db::table('Edcon_Superdemo')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Superdemo')->
        limit($start, PAGE_LIMIT)->
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
        $totalPage = ceil(Db::table('Edcon_Community')->count() / PAGE_LIMIT);
        $param['page'] = intval($param['page']);
        $start = $param['page'] * PAGE_LIMIT;
        $data = Db::table('Edcon_Community')->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data,
            'total_page' => $totalPage
        ];
    }

    public function pass()
    {
        $param = $this->request->param();
        if (!isset($param['id'])) {
            return [
                'status' => '1',
                'message' => '缺少参数id'
            ];
        }
        try {
            $pass = Db::table('Edcon_True_Participant')->where(['id' => $param['id']])->find();
            $ticketImage = paintTicket($pass['qrocde'], $pass['ticket_no'], $pass['name']);
            sendTicketMail($pass['email'], $ticketImage, $pass['type']);
            Db::table('Edcon_True_Participant')->
            where(['id' => $param['id']])->
            update(['pass' => 1, 'send' => 1]);
            $res = [
                'status' => 0,
                'message' => 'success'
            ];

        } catch (\Exception $e) {
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
            $charge = OmiseCharge::retrieve($rej['char_id']);
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
                'send mail fail'
            ];
        }
        return $res;
    }

    public function editParticipantInfo()
    {
        $param = $this->request - param();
        Db::table('Edcon_True_Participant')->update($param);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function deleteParticipant()
    {
        $param = $this->request - param();
        Db::table('Edcon_True_Participant')->where(['id' => $param['id']])->delete();
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

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
            'send' => 0
        ];
        $i = 0;
        $sends = Db::table('Edcon_True_Participant')->where($where)->select();
        foreach ($sends as $s) {
            try {
                sendTicketMail($s['email'], $s['ticket_image']);
                Db::table('Edcon_True_Participant')->update(['send' => 1]);
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
            'company' => $param['company'],
            'phone' => $param['phone'],
            'ticket_no' => $no
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 1) {
                return [
                    'status' => 1,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        Db::table('Edcon_True_Participant')->data($insert)->insert();
        $no++;
        file_put_contents('../lib/ticket_no.log', $no);
        return [
            'status' => 0,
            'message' => 'success'
        ];
    }

    public function ticketSearch()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        if (strlen($param['type']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数type'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|title|email|phone|school|company|time|position|ticket_no' => ['LIKE', "'%{$param['keyword']}%'", 'type' => $param['type']]
        ];
        $data = Db::table('Edcon_True_Participant')->
        limit($start, PAGE_LIMIT)->
        where($where)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function speakerSearch()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "'%{$param['keyword']}%'"]
        ];
        $data = Db::table('Edcon_Speaker')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function sponsorSearch()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "'%{$param['keyword']}%'"]
        ];
        $data = Db::table('Edcon_Sponsor')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function mediaSearch()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "'%{$param['keyword']}%'"]
        ];
        $data = Db::table('Edcon_Media')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function communitySearch()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "'%{$param['keyword']}%'"]
        ];
        $data = Db::table('Edcon_Community')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function superdemoSearch()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'name|country|company|email|phone|note|time' => ['LIKE', "'%{$param['keyword']}%'"]
        ];
        $data = Db::table('Edcon_Superdemo')->
        where($where)->
        limit($start, PAGE_LIMIT)->
        select();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }

    public function login()
    {
        $param = $this->request->param();
        if (strlen($param['page']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数page'
            ];
        }

        if (strlen($param['keyword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        $start = $param['page'] * PAGE_LIMIT;
        $where = [
            'username' => $param['username'],
            'password' => md5($param['password'])
        ];
        $exists = Db::table('Edcon_Administrators')->where()->find();
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
        if (strlen($param['oldPassword']) < 0) {
            return [
                'status' => '1',
                'message' => '缺少参数keyword'
            ];
        }
        if (strlen($param['newPassword']) < 0) {
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
            'size' => $param['size']
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        Db::table('Edcon_Community')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
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
            'media' => $param['media']
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        Db::table('Edcon_Media')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
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
            'note' => $param['note']
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        Db::table('Edcon_Speaker')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
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
            'note' => $param['note']
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        Db::table('Edcon_Sponsor')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
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
            'note' => $param['note']
        ];
        foreach ($insert as $k => $i) {
            if (strlen($i) < 0) {
                return [
                    'status' => 0,
                    'message' => "缺少参数{$k}"
                ];
            }
        }
        Db::table('Edcon_Superdemo')->data($insert)->insert();
        return [
            'status' => 0,
            'message' => 'success'
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
        Db::table('Edcon_Community')->where($where)->delete();
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
        Db::table('Edcon_Media')->where($where)->delete();
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
        Db::table('Edcon_Speaker')->where($where)->delete();
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
        Db::table('Edcon_Sponsor')->where($where)->delete();
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
        Db::table('Edcon_Superdemo')->where($where)->delete();
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
        Db::table('Edcon_True_Participant')->where($where)->delete();
        return [
            'status' => 0,
            'message' => 'success',
            'data' => $data
        ];
    }
}