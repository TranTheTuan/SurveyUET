<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Charts\FusionChart;
use App\Charts\HighChart;
use App\Charts\SurveyChart;
use App\Option;
use App\Question;
use App\Survey;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    protected $survey, $user, $question, $option, $answer;

    public function __construct(Survey $survey, User $user, Question $question, Option $option, Answer $answer)
    {
        $this->survey = $survey;
        $this->user = $user;
        $this->question = $question;
        $this->option = $option;
        $this->answer = $answer;
    }

    public function home()
    {
        $surveys = $this->survey->all();
        return view('survey.surveys-list', ['surveys' => $surveys]);
    }

    public function create()
    {
        return view('survey.new');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $this->survey->create($data);

        return redirect()->route('home');
    }

    public function edit(Survey $survey)
    {
        return view('survey.edit', ['survey' => $survey]);
    }

    public function update(Request $request, Survey $survey)
    {
        dd($request->all());
        $data = $request->all();
        $survey->update($data);
        return redirect()->route('home');
    }

    public function delete(Survey $survey)
    {
        Survey::destroy($survey->id);

        return redirect()->route('home');
    }

    public function show(Survey $survey)
    {
        return view('survey.detail', ['survey' => $survey]);
    }

    public function addQuestion(Request $request, Survey $survey)
    {
        $options = $request->choice;
        $question_data = array();
        $question_data['label'] = $request->label;
        $question_data['type'] = $request->type;
        $question_data['survey_id'] = $survey->id;

        $new_question = $this->question->insertQuestionToDB($question_data);

        if ($request->type != "3") {
            $answer_data = array();
            $answer_data['question_id'] = $new_question->id;
            foreach ($options as $option) {
                $answer_data['choice'] = $option;
                $this->option->create($answer_data);
            }
        }
        return redirect()->route('show', $survey->id);
    }

    public function takeSurvey(Survey $survey)
    {
        return view('survey.take-survey', ['survey' => $survey]);
    }

    public function postAnswers(Request $request, Survey $survey)
    {
        $uid = Auth::id();
        foreach ($survey->questions as $question) {
            $qid = $question->id;
            if ($question->type == 1) {
                foreach ($request->$qid as $check) {
                    $this->answer->create(['user_id' => $uid, 'question_id' => $qid, 'option_id' => $check]);
                }
            } elseif ($question->type == 2) {
                $this->answer->create(['user_id' => $uid, 'question_id' => $qid, 'option_id' => $request->$qid]);
            } else {
                $this->answer->create(['user_id' => $uid, 'question_id' => $qid, 'text' => $request->$qid]);
            }
        }
        return redirect()->route('home');
    }

    public function statistic(Survey $survey)
    {
        $charts = collect();
        foreach ($survey->questions as $index => $question) {
            if ($question->type != 3){
                $dataset = collect();
                $labels = collect();
                $chart = new HighChart();
                foreach ($question->options as $option) {
                    $count = $option->answers->count();
                    $label = $option->choice;
                    $dataset->push($count);
                    $labels->push($label);
                }
                $chart->labels($labels);
                $chart->dataset('Questions #'.($index+1).': '.$question->label, 'line', $dataset);
                $charts->push($chart);
            }
        }
        return view('survey.statistic', ['survey' => $survey, 'charts' => $charts]);
    }
}
