<?php

namespace App\Console\Commands;

use App\Models\Managers\MessengerManager;
use App\Models\User;
use Illuminate\Console\Command;

class messageTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:test {--token=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Message Test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $token = $this->option('token');
        $user = User::where('id', '=', 16)->first();
        $conversation = MessengerManager::myMessagesByToken($token, 0, 100);
        $headers = ['id', 'token', 'user_id', 'client_id', 'sender', 'content'];
        $rows = [];
        foreach($conversation as $msg) {
            $rows[] = [
                'id' => $msg->id,
                'token' => $msg->token,
                'user_id' => $msg->user_id,
                'client_id' => $msg->client_id,
                'sender' => $msg->sender,
                'content' => $msg->content,
            ];
        }
        $this->table($headers, $rows);

        return 0;
    }
}
