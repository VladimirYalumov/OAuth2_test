<?php

namespace App\Console\Commands;

use App\Entities\Client;
use App\Repositories\ClientRepository;
use Illuminate\Console\Command;

class CreateClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'client:create {name}';

    /**
     * The drip e-mail service.
     *
     * @var ClientRepository
     */
    protected $clientRepository;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->clientRepository->createClient($this->argument('name'));
        return 0;
    }
}
