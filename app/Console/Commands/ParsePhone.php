<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ParsePhone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:phone {phone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Phone';

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
        $input = $this->argument('phone');
        $parsed = parse_phone($input);
        dump([
            'phone' => $input,
            'parsed' => $parsed,
        ]);

        return 0;
    }
}
