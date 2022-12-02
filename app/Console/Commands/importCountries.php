<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;

define('id', 0);
define('name', 1);
define('ascii_name', 2);
define('alternatenames', 3);
define('latitude', 4);
define('longitude', 5);
define('feature_class', 6);
define('feature_code', 7);
define('country_code', 8);
define('cc2', 9);
define('admin1_code', 10);
define('admin2_code', 11);
define('admin3_code', 12);
define('admin4_code', 13);
define('population', 14);
define('elevation', 15);
define('dem', 16);
define('timezone', 17);
define('modification_date', 18);

class importCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import countries';

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
        $this->info('Import countries');
        $filename = public_path('allCountries.txt');
        $handle = fopen($filename, 'r');
        if(!$handle) {
            $this->error(sprintf('Unable to open file %s', $filename));

            return 1;
        }
        $this->info('File opened!');
        City::truncate();
        $lines = 12349988;
        $progress_bar = $this->output->createProgressBar($lines);
        $count = 0;
        $data = [];
        $progress_bar->start();
        while($row = fgets($handle)) {
            $rowData = explode("\t", $row);

            $alternatenames = (string)$rowData[alternatenames];
            if(strlen($alternatenames) > 10000) {
                $alternatenames = mb_substr($alternatenames, 0, 10000);
            }

            $data[] = [
                'name' => (string)$rowData[name],
                'ascii_name' => (string)$rowData[ascii_name],
                'alternatenames' => $alternatenames,
                'latitude' => (float)$rowData[latitude],
                'longitude' => (float)$rowData[longitude],
                'feature_class' => $rowData[feature_class],
                'feature_code' => $rowData[feature_code],
                'country_code' => $rowData[country_code],
                'cc2' => $rowData[cc2],
                'admin1_code' => $rowData[admin1_code],
                'admin2_code' => $rowData[admin2_code],
                'admin3_code' => $rowData[admin3_code],
                'admin4_code' => $rowData[admin4_code],
                'population' => (int)$rowData[population],
                'elevation' => (int)$rowData[elevation],
                'dem' => $rowData[dem],
                'timezone' => $rowData[timezone],
                'modification_date' => $rowData[modification_date],
            ];

            if(++$count == 2500) {
                // $this->info('Inserting 1000 cities');
                City::insert($data);
                // $this->info('1000 cities added!');

                $data = [];
                $count = 0;
            }

            $progress_bar->advance();
        }

        if($data != []) {
            // $this->info(sprintf('Inserting %d cities', count($data)));
            City::insert($data);
            // $this->info(sprintf('%d cities added!', count($data)));

            $progress_bar->finish();
        }

        $progress_bar->finish();

        $this->info('Import done!');
        fclose($handle);

        return 0;
    }
}
