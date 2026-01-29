<?php

namespace App\Logging;

// use Illuminate\Log\Logger;
use DB;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class MySQLLoggingHandler extends AbstractProcessingHandler
{
    protected function write($record): void
    {
        $data = array(
            'message'       => $record['message'],
            'context'       => json_encode($record['context']),
            'level'         => $record['level'],
            'level_name'    => $record['level_name'],
            'channel'       => $record['channel'],
            'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'extra'         => json_encode($record['extra']),
            'formatted'     => $record['formatted'],
            'remote_addr'   => @$_SERVER['REMOTE_ADDR'],
            'user_agent'    => @$_SERVER['HTTP_USER_AGENT'],
            'created_at'    => date("Y-m-d H:i:s"),
        );

        // if($record['level_name'] == 'ERROR' && config('app.env') != 'local') {
        //     $subject = "500 error - ".request()->url();
        //     $content = $record['message'];
        //     notifyAdmin($subject, $content);
        // }

        DB::table('logs')->insert($data);
    }
}
