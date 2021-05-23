<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Channel::create([
        	'name' => 'Laravel',
        	'slug' => Str::slug('Laravel') 
        ]);

        Channel::create([
        	'name' => 'Vue Js',
        	'slug' => Str::slug('Vue Js') 
        ]);

        Channel::create([
        	'name' => 'Django',
        	'slug' => Str::slug('Django') 
        ]);

        Channel::create([
        	'name' => 'React Js',
        	'slug' => Str::slug('React Js') 
        ]);
    }
}
