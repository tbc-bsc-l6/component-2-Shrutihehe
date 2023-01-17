<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function getTestQuestions(Request $request, $subject_id)
    {

        //has user registered for this exam
        $student_already_registered = DB::table('students')->where('user_id', Auth::user()->id)->where('subject_id', $subject_id)->exists();
        //if the user has not registered
        
        if (!$student_already_registered) {
            return \redirect()->route('dashboard')->with('registerFirst', 'Please regsiter for exam');

            //user hasalready regsitered 
        } else {
            //check if user has already taken the exam
            $has_taken_exam = DB::table('results')->where('user_id', Auth::user()->id)->where('subject_id',$subject_id)->exists();
            
            if ($has_taken_exam) {
                return \redirect()->route('main')->with('hasTakenExam', 'You have alrwady given the test');
            } else {
              $questions = DB::table('tests')->where('subject_id',$subject_id)->get();
              return view('test', [
                'questions' => $questions,
                'subject_id' =>$subject_id
            ]);
              
            }
        }
    }

    public function registerExam(Request $request, $subject_id)
    {
        //check if user already registered
        $student_already_register = DB::table('students')->where('user_id', Auth::user()->id)->where('subject_id', $subject_id)->exists();
        if ($student_already_register) {

            return \redirect()->route('dashboard')->with('alreadyRegisteredForExam', 'You have already regsitered for exam');
        } else {
            DB::table('students')->insert([
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'subject_id' => $subject_id


            ]);
            return \redirect()->route('dashboard')->with('registeredForExam', 'You have successfully regsitered for exam');
        }
    }

    public function submitExam(Request $request)
    {
        //request conatins answer

        $answers = $request->all();
        //dd($answers); 

        //to calculate points 
        $points = 0;
        $percentage = 0;
        $totalQuestion = 2;




        foreach ($answers as $questionId => $userAnswer) { //loop array

            if (is_numeric($questionId)) {
                $questionInfo = DB::table('tests')->where('id', $questionId)->get();
                //$questionInfo = about the question where id = question id 

                $correctAnswer = $questionInfo[0]->correct_answer; // checks the data answer

                if ($correctAnswer == $userAnswer) {
                    //give user a point. won't be using else because if the answer is incorrect this function will never be executed
                    $points++;
                }
            }
        }
        //calculate score 
        $percentage = ($points / $totalQuestion) * 100;
        //dd($percentage);
        $id = Auth::user()->id;
        //insert score in the results table 
        DB::table('results')->insert([
            'user_id' => $id,
            'score' => $percentage,
            'subject_id' => $request->input('subject_id')
        ]);
        // return to main page
        return redirect()->route('main')->with('examSubmitted', 'Your exam has been submitted successfully.');
    }
}
