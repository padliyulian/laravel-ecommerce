<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailOrderReceivedJob implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $order;
	protected $user;

	/**
	 * Create a new job instance.
	 *
	 * @param Order $order order object
	 * @param User  $user  user auth
	 *
	 * @return void
	 */
	public function __construct($order, $user)
	{
		$this->order = $order;
		$this->user = $user;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$orderReceivedEmail = new \App\Mail\OrderReceivedMail($this->order);
		\Mail::to($this->user->email)->send($orderReceivedEmail);
        \Log::info('SendMailOrderReceivedJob success run');
	}
}
