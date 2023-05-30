<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProcessXMLDataCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testProcessXMLDataCommand()
    {
        $file = 'feed.xml';

        // Run the XML processing command
        $this->artisan('xml:process', ['file' => $file])
            ->expectsOutput('XML data has been successfully processed and stored in the database.');

        $this->assertDatabaseHas('xml_data', ['name' => "Nestle's Rich Hot Chocolate 50 Packets"]);
    }
}
