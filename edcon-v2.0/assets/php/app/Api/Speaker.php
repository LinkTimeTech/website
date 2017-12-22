<?php
/**
 * Created by PhpStorm.
 * User: ZaneYule
 * Date: 2017/11/13
 * Time: 上午11:03
 */

namespace App\Api;

use PhalApi\Api;
use App\Domain\Speaker as DomainSpeaker;

class Speaker extends Api
{

    public function getRules()
    {
        return array(
            'insert' => array(
                'name' => array('name' => 'name', 'require' => true, 'min' => 1, 'max' => '100', 'desc' => '姓名'),
                'country' => array('name' => 'country', 'require' => true, 'min' => 1, 'max' => '100', 'desc' => '国家'),
                'company' => array('name' => 'company', 'require' => true, 'min' => 1, 'max' => '100', 'desc' => '公司'),
                'position' => array('name' => 'position', 'require' => true, 'min' => 1, 'max' => '100', 'desc' => '职位'),
                'email' => array('name' => 'email', 'require' => true, 'min' => 1, 'max' => '100', 'desc' => '邮箱'),
                'phone' => array('name' => 'phone', 'require' => true, 'min' => 1, 'max' => '100', 'desc' => '电话'),
                'note' => array('name' => 'note', 'require' => true, 'min' => 1, 'max' => '200', 'desc' => '备注'),
            ),
        );
    }

    /**
     * 插入数据
     * @desc 向数据库插入一条纪录数据
     * @return int id 新增的ID
     */
    public function insert()
    {
        $rs = array();

        $newData = array(
            'name' => $this->name,
            'country' => $this->country,
            'company' => $this->company,
            'position' => $this->position,
            'email' => $this->email,
            'phone' => $this->phone,
            'note' => $this->note,
        );

        $domain = new DomainSpeaker();
        $id = $domain->insert($newData);

        $rs['id'] = $id;
        return $rs;
    }

    /**
     * 更新数据
     * @desc 根据ID更新数据库中的一条纪录数据
     * @return int code 更新的结果，1表示成功，0表示无更新，false表示失败
     */
    public function update()
    {
        $rs = array();

        $newData = array(
            'name' => $this->name,
            'country' => $this->country,
            'company' => $this->company,
            'position' => $this->position,
            'email' => $this->email,
            'phone' => $this->phone,
            'note' => $this->note,
        );

        $domain = new DomainSpeaker();
        $code = $domain->update($this->id, $newData);

        $rs['code'] = $code;
        return $rs;
    }

    /**
     * 获取数据
     * @desc 根据ID获取数据库中的一条纪录数据
     * @return int      id          主键ID
     * @return string   name        姓名
     * @return string   country     国家
     * @return string   company     公司
     * @return string   position    职位
     * @return string   email       邮箱
     * @return string   phone       电话
     * @return string   note        备注
     * @return string   post_date   发布日期
     */
    public function get()
    {
        $domain = new DomainSpeaker();
        $data = $domain->get($this->id);

        return $data;
    }

    /**
     * 删除数据
     * @desc 根据ID删除数据库中的一条纪录数据
     * @return int code 删除的结果，1表示成功，0表示失败
     */
    public function delete()
    {
        $rs = array();

        $domain = new DomainSpeaker();
        $code = $domain->delete($this->id);

        $rs['code'] = $code;
        return $rs;
    }

    /**
     * 获取分页列表数据
     * @desc 根据状态筛选列表数据，支持分页
     * @return array    items   列表数据
     * @return int      total   总数量
     * @return int      page    当前第几页
     * @return int      perpage 每页数量
     */
    public function getList()
    {
        $rs = array();

        $domain = new DomainSpeaker();
        $list = $domain->getList($this->page, $this->perpage);

        $rs['items'] = $list['items'];
        $rs['total'] = $list['total'];
        $rs['page'] = $this->page;
        $rs['perpage'] = $this->perpage;

        return $rs;
    }
}
