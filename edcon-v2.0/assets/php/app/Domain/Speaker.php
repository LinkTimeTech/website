<?php
/**
 * Created by PhpStorm.
 * User: ZaneYule
 * Date: 2017/11/13
 * Time: 上午11:00
 */

namespace App\Domain;

use App\Model\Speaker as ModelSpeaker;

class Speaker
{

    public function insert($newData)
    {
        $newData['post_date'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

        $model = new ModelSpeaker();
        return $model->insert($newData);
    }

    public function update($id, $newData)
    {
        $model = new ModelSpeaker();
        return $model->update($id, $newData);
    }

    public function get($id)
    {
        $model = new ModelSpeaker();
        return $model->get($id);
    }

    public function delete($id)
    {
        $model = new ModelSpeaker();
        return $model->delete($id);
    }

    public function getList($page, $perpage)
    {
        $rs = array('items' => array(), 'total' => 0);

        $model = new ModelSpeaker();
        $items = $model->getListItems($page, $perpage);

        $rs['items'] = $items;

        return $rs;
    }
}
