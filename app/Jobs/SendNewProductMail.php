<?php

namespace App\Jobs;

use App\Mail\EmailMailable;
use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendNewProductMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $product ;
    public function __construct(Product $product)
    {
        $this->product = $product ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();
        if ($users->count() > 0) {
            foreach($users as $key => $value){
                if (!empty($value->email)) {
                    Mail::to($value->email)->send(new \App\Mail\SendNewProductMail($this->product));
                    sleep(5);
                }
            }
        }
    }
}
