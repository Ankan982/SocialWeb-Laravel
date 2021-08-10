<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\WordOfDay;

class WordOfTheDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'word:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users with a word and its meaning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $words = [
            'APJ Abdul Kalam ' => 'A dream is not that which you see while sleeping, it is something that does not let you sleep',
            'Nelson Mandela' => 'It always seems impossible until it is done.',
            'Helen Keller' => 'Keep your face to the sunshine and you cannot see a shadow.',
            'Swami Vivekananda' => 'Arise,awake and donot stop until the goal is reached.'
        ];
         
        // Finding a random word
        $key = array_rand($words);
        $value = $words[$key];
         
        $users = User::all();
    
        foreach ($users as $user) {
            
        $email_data = [
            'subject' => 'Thought of The Day ❤',
            'thought' => $value,
            'speaker' => $key,
            'name' => $user->name
        ];
            Mail::to($user->email)->send(new WordOFDay($email_data));

        }
         
        $this->info('Word of the Day sent to All Users');
    }
}
