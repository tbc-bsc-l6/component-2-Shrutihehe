<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    public function getTestQuestions(){
     $questions = DB::table('tests')->get();
     return view ('test',['questions'=>$questions]);
    }
    public function submitExam(Request $request){
   //request conatins answer

   $answers =$request->all();
   //dd($answers); 

   //to calculate points 
   $points = 0;
   $percentage = 0;
   $totalQuestion = 2;


   foreach($answers as $questionId => $userAnswer){ //loop array

    if (is_numeric($questionId)){
        $questionInfo = DB:: table('tests')->where('id',$questionId)-> get();
        //$questionInfo = about the question where id = question id 
    
        $correctAnswer = $questionInfo[0]->correct_answer; // checks the data answer
    
        if ($correctAnswer == $userAnswer){
            //give user a point. won't be using else because if the answer is incorrect this function will never be executed
            $points++;
    
    }
    }
   }
    //calculate score 
    $percentage = ($points/$totalQuestion)*100;
    //dd($percentage);

    //insert score in the results table 
    DB::table('results')->insert([
        'user_id'=>1,
        'score'=>$percentage

    ]);
    // return to main page
    return redirect()->route('main')->with('examSubmitted','Your exam has been submitted successfully.');


    }

}
