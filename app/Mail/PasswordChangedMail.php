<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChangedMail extends Mailable
{
  use Queueable, SerializesModels;

  private $name;
  private $email;
  private $password;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($name, $email, $password)
  {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this
      ->subject('لقد تم تغيير كلمة المرور - Password Changed')
      ->view('emails.password-changed', [
      'name' => $this->name,
      'email' => $this->email,
      'password' => $this->password
    ]);
  }
}
