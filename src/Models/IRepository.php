<?php

namespace App\models;

interface IRepository {
    /**
     * @return void
     */
    public function findById(int $id) ;

    /**
     * @return void
     */
    public function findAll();

    /**
     * @return void
     */
    public function add($params);

    /**
     * @return void
     */
    public function delete(int $id);
}
