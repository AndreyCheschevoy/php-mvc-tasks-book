<?php

use App\Libraries\Controller;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('Task');
    }

}