<?php

use App\Libraries\Controller;

class IndexController extends Controller
{
    public function __construct()
    {

        $this->taskModel = $this->model('Task');
    }

    public function index()
    {
        $records_per_page = 3;

        $total_results = $this->taskModel->countTasks($records_per_page);
        $total_pages = ceil($total_results / $records_per_page);

        $tasks = $this->taskModel->getPaginateTasks(0, $records_per_page);

        $data = [
            'tasks' => $tasks,
            'page' => 1,
            'total_pages' => $total_pages,
            'sortType' => 'DESC',
            'sortBy' => 'username',
        ];
        $this->view('tasks/index', $data);
    }

    public function paginate($page = 1)
    {
        if (isset($_GET["sortBy"]) && isset($_GET["sortType"])){
            $_GET["sortType"] == "DESC" ? $sortType = "ASC" : $sortType = "DESC";
            $sortBy = $_GET["sortBy"];
        } else {
            $sortBy = 'username';
            $sortType = 'ASC';
        }
        $records_per_page = 3;

        $offset = ($page - 1) * $records_per_page;

        $total_results = $this->taskModel->countTasks($records_per_page);
        $total_pages = ceil($total_results / $records_per_page);

        $tasks = $this->taskModel->getPaginateTasks($offset, $records_per_page, $sortBy, $sortType);

        $data = [
            'tasks' => $tasks,
            'page' => $page,
            'total_pages' => $total_pages,
            'sortType' => $sortType,
            'sortBy' => $sortBy,
        ];
        $this->view('tasks/index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'text' => trim($_POST['text']),
                'status' => trim($_POST['status']),
                'name_err' => '',
                'email_err' => '',
                'text_err' => ''
            ];

            // Validate data
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter your name';
            }
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
            if (empty($data['text'])) {
                $data['text_err'] = 'Please enter task text';
            }

            // Make sure no errors
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['text_err'])) {
                // Validated
                if ($this->taskModel->addTask($data)) {
                    flash('task_message', 'Task Created');
                    redirect('indexcontroller/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('tasks/create', $data);
            }

        } else {
            $data = [
                'name' => '',
                'text' => '',
                'email' => '',
                'changed' => '',
            ];
            $this->view('tasks/create', $data);
        }
    }

    public function edit($id)
    {
        if (isLoggedInAsAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Sanitize POST array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'text' => trim($_POST['text']),
                    'status' => trim($_POST['status']),
                    'text_err' => ''
                ];

                // Validate data
                if (empty($data['text'])) {
                    $data['text_err'] = 'Please enter task text';
                }

                // Make sure no errors
                if (empty($data['text_err'])) {
                    // Validated
                    if ($this->taskModel->updateTask($data)) {
                        flash('task_message', 'Task Edited');
                        redirect('indexcontroller/index');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // Load view with errors
                    $this->view('tasks/create', $data);
                }
            } else {
                $task = $this->taskModel->getTaskForEdit($id);
                if ($task) {
                    $data = [
                        'id' => $id,
                        'text' => $task->text,
                        'status' => $task->status,
                        'text_err' => ''
                    ];
                    //            die(var_dump($tasks));
                    $this->view('tasks/edit', $data);
                } else {
                    redirect('indexcontroller/index');
                }
            }
        } else {
            redirect('userscontroller/signin');
        }

    }

    public function delete($id)
    {
        if (isLoggedInAsAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($task = $this->taskModel->deleteTasks($id)) {

                    redirect('indexcontroller/index');
                } else {
                    die ('Error');
                }
            }
        } else {
            redirect('indexcontroller/index');
        }

    }
}