<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{

    public $provider1;
    public $provider2;
    public $nowDateTime;

    public function __construct()
    {
        $this->provider1 = "http://www.mocky.io/v2/5d47f24c330000623fa3ebfa";
        $this->provider2 = "http://www.mocky.io/v2/5d47f235330000623fa3ebf7";
        $this->nowDateTime = date('Y-m-d H:i:s');
    }

    public function todo()
    {
        $provider1 = $this->getTodoList($this->provider1);
        $provider2 = $this->getTodoList($this->provider2);
        $this->eachToInsert($this->convertArray($provider1));
        $this->eachToInsert($this->convertArray($provider2));
    }

    private function convertArray($data)
    {
        if ($data) {
            return (array)$data;
        }
    }

    private function eachToInsert($data)
    {
        if ($data) {
            foreach ($data as $key1 => $value) {
                if (isset($value['zorluk'])) {
                    $this->insertTodo($value['id'], $value['zorluk'], $value['sure']);
                } else {
                    foreach ($value as $key2 => $val) {
                        $this->insertTodo($key2, $val['level'], $val['estimated_duration']);
                    }
                }
            }
        }
    }


    private function getTodoList($url)
    {
        if (!empty($url)) {
            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_URL, $url);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            $todoList = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            return json_decode($todoList, true);
        }
    }

    private function insertTodo($todoName, $level, $hour)
    {
        if (!empty($todoName) and !empty($level) and !empty($hour)) {
            $todoId = DB::table('todo')->insertGetId([
                'todo_name' => $todoName,
                'level' => $level,
                'hour' => $hour,
                'created_at' => $this->nowDateTime
            ]);
            if ($todoId) {
                $this->insertTodoUser($todoId, $level);
            }
        }
    }

    private function insertTodoUser($todoId, $level)
    {
        foreach ($this->getLevelUserId($level) as $value) {
            DB::table('user_todo')->insert([
                'user_id' => $value->id,
                'todo_id' => $todoId,
                'created_at' => $this->nowDateTime
            ]);
        }
    }

    private function getLevelUserId($level)
    {
        if ($level) {
            $data = DB::table('users')->where(['level' => $level])->get();
            return $data;
        }
    }

}
