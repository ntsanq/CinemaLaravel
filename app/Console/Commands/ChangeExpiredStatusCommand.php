<?php

namespace App\Console\Commands;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ChangeExpiredStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status tickets that expired';

    /**
     * @return void
     */
    public function handle()
    {
        $tickets = Ticket::query()
            ->join('schedules', 'schedules.id', 'tickets.schedule_id')
            ->select([
                'tickets.*',
                'schedules.end as end'
            ])
            ->where('status', TicketStatus::Paid)
            ->get();

        $count = 0;
        foreach ($tickets as $ticket) {
            $now = Carbon::now();
            $end = Carbon::parse($ticket->end);

            if ($now->greaterThan($end)) {
                $ticket->status = TicketStatus::Expired;
                $ticket->save();
                $this->line("Change status ticket " . $ticket->id);
                $count++;
            };
        }

        $this->info("Finish change " . $count . " tickets");
    }
}
