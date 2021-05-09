<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentReceived extends Mailable
{
  use Queueable, SerializesModels;

  private $comment;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct(Comment $comment)
  {
    $this->comment = $comment;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('emails.comment-received')->with([
      'comment' => $this->comment->content,
      'team' => $this->comment->team->name,
      'user' => $this->comment->user->name
    ]);
  }
}