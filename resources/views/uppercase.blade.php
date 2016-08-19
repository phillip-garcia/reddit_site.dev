@extends('layouts.master')
@section('content')
        <h1>Your word is: {{ $word }}!</h1>
        <h1>Let's scream it now, {{ strtoupper($word) }}!</h1>
    @stop