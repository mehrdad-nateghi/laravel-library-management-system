<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailReportBestLibrarian extends Mailable
{
	use Queueable,SerializesModels;

	protected $details;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($details)
	{
		$this->details = $details;
	}

	/**
	 * Get the message envelope.
	 *
	 * @return \Illuminate\Mail\Mailables\Envelope
	 */
	public function envelope()
	{
		return new Envelope(
			subject: 'Report Best Librarian of month',
		);
	}

	/**
	 * Get the message content definition.
	 *
	 * @return \Illuminate\Mail\Mailables\Content
	 */
	public function content()
	{
		return new Content(
			view: 'emails.report-best-librarian',
			with: [
				'full_name' => $this->details['full_name'],
				'total'     => $this->details['total'],
			],
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array
	 */
	public function attachments()
	{
		return [];
	}
}
