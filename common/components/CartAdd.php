<?php
/**
 * Created by PhpStorm.
 * User: umka
 * Date: 16.01.16
 * Time: 13:16
 */

namespace common\components;


interface CartAdd
{

    public function getCost();

    public function getId();

    public function getType();

    public function getTitle();



}