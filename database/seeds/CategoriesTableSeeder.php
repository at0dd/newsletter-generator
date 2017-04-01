<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = new Category();
        $general->category = "General Annoucements";
        $general->slug = "general";
        $general->save();

        $club = new Category();
        $club->category = "Club Annoucements";
        $club->slug = "club";
        $club->save();

        $other = new Category();
        $other->category = "Other Annoucements";
        $other->slug = "other";
        $other->save();

        $job = new Category();
        $job->category = "Job Opportunities";
        $job->slug = "job";
        $job->save();
    }
}
