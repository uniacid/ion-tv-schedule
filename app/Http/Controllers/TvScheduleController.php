<?php

namespace App\Http\Controllers;

use \Httpful\Request as HttpfulRequest;

class TvScheduleController extends Controller
{
    public $todaysDate;
    public $nextWeek;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // set dates
        $this->todaysDate = date('Y-m-d');
        $this->nextWeek = date('Y-m-d');
    }

    public function index($date = null) 
    {
        if (is_null($date)) {
            $date = $this->todaysDate;
        }

        $uri = "https://dev-api.iontelevision.com/1.0/schedule/?date=".$this->todaysDate;
        
        $response = HttpfulRequest::get($uri)->send();
 
        return $response;
    }
}
