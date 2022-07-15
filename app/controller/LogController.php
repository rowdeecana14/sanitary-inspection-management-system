<?php

namespace App\Controller;
use App\Model\LogModel;
use App\Helper\Helper;

class LogController extends BaseController {

    public function all() {
        
        $model = new LogModel;
        $logs = $model->logs();
        $result = [];

        foreach($logs as $index => $log) {
            $url =  Helper::imageUrl($log['image']);
            $health_official = $log['h_first_name'] . ' '.$log['h_middle_name'][0].'. '.$log['h_last_name'];

            $action  = '';

            if(in_array($log['action_id'], [6, 7])) {
                $action = ucwords($log['action']).' '.substr(strtolower($log['module']), 0, -1);
            }
            else {
                $action = ucwords($log['action']).' '.substr(strtolower($log['module']), 0, -1).' record, id: '.$log['record_id'];
            }
            
            array_push($result, [
                'index' => $index + 1,
                'image' =>  '
                    <div class="avatar ">
                    <img src="'.$url.'" alt="'.$health_official.'" class="avatar-img rounded-circle">
                    </div>',
                'name' => $health_official,
                'role' => $log['position'],
                'module' => ucwords($log['module']),
                'action' => $action,
                'datetime' =>  date('M d, Y h:i A', strtotime($log['datetime'])),
            ]);
        }

        return [
            "success" => true,
            "message" => "success",
            "data" => [
                'logs' => $result,
                'year' => date('Y')
            ]
        ];
    }
}
?>