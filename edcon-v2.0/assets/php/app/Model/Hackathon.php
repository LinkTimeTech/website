<?php
/**
 * Created by PhpStorm.
 * User: ZaneYule
 * Date: 2017/11/13
 * Time: 上午10:20
 */

namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

/**
 *
 * CREATE TABLE `Edcon_Hackathon` (
 * `id` int(10) NOT NULL AUTO_INCREMENT,
 * `name` varchar(100) DEFAULT NULL,
 * `country` varchar(100) DEFAULT NULL,
 * `company` varchar(100) DEFAULT NULL,
 * `email` varchar(100) DEFAULT NULL,
 * `phone` varchar(100) DEFAULT NULL,
 * `note` varchar(200) DEFAULT NULL,
 * `post_date` datetime DEFAULT NULL,
 * PRIMARY KEY (`id`)
 * ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
 */
class Hackathon extends NotORM
{

    public function getListItems($page, $perpage)
    {
        return $this->getORM()
            ->select('*')
            ->order('post_date DESC')
            ->limit(($page - 1) * $perpage, $perpage)
            ->fetchAll();
    }

    public function getListTotal()
    {
        $total = $this->getORM()
            ->count('id');

        return intval($total);
    }

    protected function getTableName($id)
    {
        return 'Hackathon';
    }
}