<?php

class TasksController extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('Task');
    }

}