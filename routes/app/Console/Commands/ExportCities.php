<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;

class ExportCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:city {--country=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export country list to json';

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
        $this->info('Start export');

        $countryCode = $this->option('country');

        $cities = City::where('country_code', 'LIKE', $countryCode)
            ->orderBy('name', 'asc')
            ->get();

        $filename = public_path(strtolower($countryCode).'.json');
        $file = fopen($filename, 'w+');
        $data = [];

        foreach ($cities as $city) {
            $data[] = [
                'n' => $city->name,
                'lt' => $city->latitude,
                'lg' => $city->longitude,
            ];
            $this->info('Exporting city : ' . $city->name);
        }

        fputs($file, json_encode($data));

        fclose($file);

        $this->info('Export done!');

        return 0;
    }
}
