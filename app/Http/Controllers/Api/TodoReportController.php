<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TodoReportController extends Controller
{
    public $userData;

    public function __construct()
    {
        $this->userData = $this->getUserData();
    }

    public function todoReport()
    {
      return  $this->arrayToUser($this->userData);
    }

    private function arrayToUser($array)
    {
       if($array){
        $data = array();
        $property_types = array();
        foreach ($array as $value) {
            if (in_array($value->name, $property_types)) {
                continue;
            }
            $property_types[] = $value->name;
            $hour = $this->getHour($array, $value->name);
            $data[] = [
              'name' =>   $value->name,
              'dev_level' => $value->dev_level,
              'hour' => $this->getHour($array, $value->name),
              'week' => $this->weekCalculation($hour)
            ];
        }
        return $data;
       }
    }

    private function weekCalculation($hour){
       if($hour){
        return sprintf("%0.2f", $hour / 45);
       }
    }

    private function getHour($array, $name)
    {
       if(!empty($array) and !empty($name)){
        $jobHour = 0;
        foreach ($array as $value) {
            if ($name == $value->name) {
                $jobHour += $value->hour;
            }
        }
        return $jobHour;
       }
    }

    private function getUserData()
    {
        $usersData = DB::table('users')
            ->join('user_todo', function ($onTodoUser) {
                $onTodoUser->on('users.id', '=', 'user_todo.user_id');
            })
            ->join('todo', function ($onTodo) {
                $onTodo->on('user_todo.todo_id', '=', 'todo.id');
            })
            ->get([
                'users.id as user_id',
                'users.name as name',
                'users.level as dev_level',
                'todo.level as todo_level',
                'todo.hour as hour',
            ]);
        return $usersData;
    }

}
