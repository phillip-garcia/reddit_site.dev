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
Route::get('/sayhello/{name?}', function ($name = 'Class')
{
    return 'Hello ' . $name . '!';
});
Route::get('/uppercase/{word?}', function ($word = 'help')
{
    $data = ['word' => $word];
    return view('uppercase', $data);
});
Route::get('/math/{number?}', function ($number = '1')
{
    $data = ['number' => $number];
    return view('math', $data);
});
Route::get('/add/{number1?}/{number2?}', function ($number1, $number2)
{
    return $number1 + $number2;
});
Route::get('/rolldice/{guess}', function ($guess)
{
    $data = ['number' => rand(1, 6),
        'guess' => $guess
    ];
    return view('rolldice', $data);

});