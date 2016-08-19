<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sayhello/{name}', function($name)
{
    if ($name == "Chris") {
        return Redirect::to('/');
    }

    $data = array('name' => $name);
    return view('my-first-view', $data);
});
Route::get('/uppercase/{word?}', function($word = 'WORD')
{
    $caps = strtoupper($word);
    return "This: $caps, is uppercased";
});
Route::get('/increment/{number?}', function($number = 'number')
{
    $number = $number + 1;
    return "This: $number, has been incremented from your input.";
});
Route::get('/add/{number1}/{number2}', function($number1, $number2)
{
    $sum = $number1 + $number2;
    return "The sum of $number1 and $number2 is $sum";
});
Route::get('/rolldice/{guess?}', function ($guess)
    {
        $data = ['number' => rand(1, 6),
     			'guess' => $guess
         	];
 	    return view('roll-dice', $data);
});