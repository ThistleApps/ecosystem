<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ResetMerchantPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        try
//        {
            $this->broker()->sendResetLink(
                ['email' => $this->email]
            );

            Log::info('Reset Password Email sent to This'.$this->email);
//        }catch (\Exception $exception)
//        {
//            Log::error('Reset Password Email sent to This '.$this->email.' is failed. Reason: '. $exception->getMessage());
//        }


    }

    public function broker()
    {
        return Password::broker();
    }
}
