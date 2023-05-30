<?php

namespace App\Commands;

use App\XmlData;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProcessXMLDataCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'xml:process {file}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Process the XML file and store data in the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check if the XML file exists
        if (!File::exists($this->argument('file'))) {
            $this->error('The XML file does not exist.');
            return;
        }

        try {
            $xml = simplexml_load_file($this->argument('file'));
        } catch (\Exception $e) {
            $this->error('Failed to load the XML file.');
            Log::error($e->getMessage());
            return;
        }

        $this->info('Processing the XML file...');

        $items = $xml->xpath("//catalog/item");

        // Get the total number of items
        $totalItems = count($items);

        // Create a new ConsoleOutput instance
        $output = new ConsoleOutput();

        // Create a new ProgressBar instance
        $progressBar = new ProgressBar($output, $totalItems);

        // Set the format and options for the progress bar
        $progressBar->setFormat('debug');
        $progressBar->setRedrawFrequency(1); // Update the progress bar every 1 item

        // Start the progress bar
        $progressBar->start();

        foreach ($items as $item) {
            try {
                // Check if the record already exists based on the entity_id if not Add to DB
                $record = XmlData::firstOrCreate([
                    'entity_id' => $item->entity_id,
                ], [
                    'category_name' => $item->CategoryName,
                    'sku' => $item->sku,
                    'name' => $item->name,
                    'description' => $item->description,
                    'shortdesc' => $item->shortdesc,
                    'price' => $item->price,
                    'link' => $item->link,
                    'image' => $item->image,
                    'brand' => $item->brand,
                    'rating' => $item->Rating,
                    'caffeine_type' => $item->CaffeineType,
                    'count' => $item->Count,
                    'flavored' => $item->Flavored,
                    'seasonal' => $item->Seasonal,
                    'instock' => $item->Instock,
                    'facebook' => $item->Facebook,
                    'IsKCup' => $item->IsKCup,
                ]);

                // Advance the progress bar by 1
                $progressBar->advance();
            } catch (\Exception $e) {
                Log::error($e->getMessage());

                $this->newLine();
                // Display an error message for the specific item
                $this->error("Error occurred while processing item: {$item->entity_id}");
            }
        }

        // Complete the progress bar
        $progressBar->finish();
        $this->newLine();
        $this->info('XML data has been successfully processed and stored in the database.');
    }
}
