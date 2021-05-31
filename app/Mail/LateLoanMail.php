<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LateLoanMail extends Mailable
{
  use Queueable, SerializesModels;

  private $book_name;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($book_name)
  {
    $this->book_name = $book_name;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this
      ->subject('تأخر إرجاع الكتاب - ' . $this->book_name)
      ->view('emails.late-loan', [
        'book_name' => $this->book_name
      ]);
  }
}
