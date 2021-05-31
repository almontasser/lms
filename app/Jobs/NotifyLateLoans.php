<?php

namespace App\Jobs;

use App\Mail\LateLoanMail;
use App\Models\BookInstanceMovement;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class NotifyLateLoans implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    $movements = BookInstanceMovement::where('borrow_returned', NULL)->whereDate('borrow_end', '<', Carbon::now())->get();
    foreach ($movements as $movement) {
      try {
        echo "SENDING MAIL\n";
        echo "to " . $movement->user->email . "\n";
        echo "book " . $movement->book_instance->book->title . "\n";
        Mail::to($movement->user)->send(new LateLoanMail($movement->book_instance->book->title));
      } catch (\Throwable $th) {
        echo $th->getMessage();
      }
    }
  }
}
