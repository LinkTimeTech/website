<?php
/**
 * Created by PhpStorm.
 * User: ZaneYule
 * Date: 2017/11/13
 * Time: 上午11:00
 */

namespace App\Domain;

use App\Model\Participant as ModelParticipant;

class Participant
{

    public function insert($newData)
    {
        $newData['post_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

        $model = new ModelParticipant();
        return $model->insert($newData);
    }

    public function update($id, $newData)
    {
        $model = new ModelParticipant();
        return $model->update($id, $newData);
    }

    public function get($id)
    {
        $model = new ModelParticipant();
        return $model->get($id);
    }

    public function delete($id)
    {
        $model = new ModelParticipant();
        return $model->delete($id);
    }

    public function getList($page, $perpage)
    {
        $rs = array('items' => array(), 'total' => 0);

        $model = new ModelParticipant();
        $items = $model->getListItems($page, $perpage);

        $rs['items'] = $items;

        return $rs;
    }
}
