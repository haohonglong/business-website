<?php
namespace app\command;

use app\api\model\Article;
use app\api\model\Question;
use app\api\model\User;
use app\api\model\UserSession;
use think\Cache;
use think\console\Command;
use think\console\Input;
use think\console\Output;

use think\Db;

class Publish extends Command
{
	
    protected function configure()
    {
        $this->setName('publish')->setDescription('Publish the time interval content');
    }

    protected function execute(Input $input, Output $output)
    {
        $currentTime = date('Y-m-d H:i');
        //视频图文
        $resource = Article::where([
            'status' => 2,
            'publish_time' => ['<=', $currentTime]
        ])->limit(100)->field('id,status,publish_time,update_time')->select();

        foreach ($resource as $val) {
            Article::where([
                'id' => $val['id']
            ])->update([
                'status' => 1,
                'publish_time' => '',
                'update_time' => date('Y-m-d H:i:s')
            ]);
        }
        $output->writeln("Article Publish Done.");

        //问答
        $question = Question::where([
            'status' => 2,
            'publish_time' => ['<=', $currentTime]
        ])->limit(100)->field('id,status,publish_time,update_time')->select();

        foreach ($question as $val) {
            Question::where([
                'id' => $val['id']
            ])->update([
                'status' => 1,
                'publish_time' => '',
                'update_time' => date('Y-m-d H:i:s')
            ]);
        }
        $output->writeln("Question Publish Done.");
	}

}