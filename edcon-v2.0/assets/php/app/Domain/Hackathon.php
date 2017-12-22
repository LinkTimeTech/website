<?php
/**
 * Created by PhpStorm.
 * User: ZaneYule
 * Date: 2017/11/13
 * Time: 上午11:00
 */

namespace App\Domain;

use App\Model\Hackathon as ModelHackathon;

class Hackathon
{

    public function insert($newData)
    {
        $newData['post_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

        $model = new ModelHackathon();
        return $model->insert($newData);
    }

    public function update($id, $newData)
    {
        $model = new ModelHackathon();
        return $model->update($id, $newData);
    }

    public function get($id)
    {
        $model = new ModelHackathon();
        return $model->get($id);
    }

    public function delete($id)
    {
        $model = new ModelHackathon();
        return $model->delete($id);
    }

    public function getList($page, $perpage)
    {
        $rs = array('items' => array(), 'total' => 0);

        $model = new ModelHackathon();
        $items = $model->getListItems($page, $perpage);

        $rs['items'] = $items;

        return $rs;
    }
}
