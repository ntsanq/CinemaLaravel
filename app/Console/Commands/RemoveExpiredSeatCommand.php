<?php

namespace App\Console\Commands;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveExpiredSeatCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired tickets';

    /**
     * @return void
     */
    public function handle()
    {
        $tickets = Ticket::query()->where('status', TicketStatus::UnPaid)
            ->get();

        $count = 0;
        foreach ($tickets as $ticket) {
            $now = Carbon::now();
            if (!$now->between($ticket->created_at, $ticket->created_at->addMinutes(5))) {
                $ticket->delete();
                $this->line("Deleted ticket " . $ticket->id);
                $count++;
            };
        }

        $this->info("Deleted " . $count . " expired tickets");
    }

}
