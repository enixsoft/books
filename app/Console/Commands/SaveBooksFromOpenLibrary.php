<?php
namespace App\Console\Commands;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use App\Models\Book;

/**
 * SaveBooksFromOpenLibrary
 */
class SaveBooksFromOpenLibrary extends Command
{
    const BASE_API_URL = 'https://openlibrary.org/';
    const API_ENDPOINT = 'search.json';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:save-books-from-open-library {--genre=null}{--limit=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves and saves books from openlibrary API';
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(!$this->option('genre') || !$this->option('limit'))
        {
            $this->error("Required parameters genre or limit are missing.");
            return;
        }
       
        $client = new Client([
            'timeout' => 5.0
        ]);

        $count = 0;

        try {
            $response = $client->request('GET', static::BASE_API_URL . '/' . static::API_ENDPOINT . '?subject=' . $this->option('genre') . '&limit=' . $this->option('limit'));
            $json = json_decode((string)$response->getBody(), true);
            
            // dd($json['docs'][0]);

            if(isset($json['docs']) && count($json['docs']) > 0)
            {
                foreach($json['docs'] as $doc) 
                {                    
                    if(Book::where('api_id', $doc['cover_edition_key'])->exists())
                    {
                        continue;
                    }
                    
                    Book::create([
                        'api_id' => $doc['cover_edition_key'],
                        'title' => $doc['title'],
                        'isbn' => $doc['isbn'][0],
                        'genre' => $this->option('genre'),
                        'abstract' => $doc['first_sentence'][0],
                        'author_name' => $doc['author_name'][0],
                        'length' => random_int(25, 1000),
                        'published_at' => Date::parse($doc['publish_date'][0])
                    ]);

                    $count++;
                }
            } 
            else 
            {
                $this->info('No books found for your chosen genre. Try again.');
                return;
            }           

        } catch (Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return;
        }

        $this->info("Command completed, added $count books.");
    }
}