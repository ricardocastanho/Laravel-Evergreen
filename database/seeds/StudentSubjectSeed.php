<?php

use Illuminate\Database\Seeder;

class StudentSubjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_subjects')->insert(['av1'=>9.8, 'av2'=>7.4, 'student_id'=>1, 'subject_id'=>1]);
    }
}
