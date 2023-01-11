<?php

namespace App\Console\Commands;

use App\Models\Managers\NotificationManager;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class sendemailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendmail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email test';

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
        NotificationManager::sendEmail('donatkamary@gmail.com', 'Test Email', 'Hello world!!!');

        $user = User::where('id', '=', 1)->first();
        $builder = Notification::where('is_active', '=', 1);
        $builder
            ->where(function(Builder $qb) use($user) {
                $qb->where('user_id', '=', (int)$user->id);
                if($user->isAdmin()) {
                    $qb->orWhereNull('user_id');
                }
            })
            ->orderBy('created_at');

        $notifications = $builder->get();

        dd([
            'sql' => $builder->toSql(),
            'notifications' => $notifications,
        ]);

        return 0;
    }
}
