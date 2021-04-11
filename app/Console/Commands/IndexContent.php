<?php

namespace App\Console\Commands;

use App\Concerns\MultilingualStemmer;
use App\Concerns\NewStemmer;
use Illuminate\Console\Command;
use TeamTNT\TNTSearch\TNTSearch;

class IndexContent extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'index:content';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Index Content';

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
    $tnt = new TNTSearch();

    $tnt->loadConfig(TNTConfig());

    $indexer = $tnt->createIndex('content.index');
    $indexer->query('SELECT concat(\'book_\',id) as id, title, author, publisher, description, subject FROM books;');
    $indexer->run();
    $indexer->query('SELECT concat(\'paper_\',id) as id, title, author, abstract FROM research_papers;');
    $indexer->run();
    $indexer->query('SELECT concat(\'project_\',id) as id, title, authors, abstract, supervisor, sub_supervisor, conclusion FROM projects;');
    $indexer->run();
  }
}
