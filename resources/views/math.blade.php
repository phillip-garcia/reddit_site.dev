@extends('layouts.master')
@section('content')
    <h1>You gave me, {{ $number }}!</h1>
    @if ($number)
        <h1>This is your number +1, {{ $number+=1 }}</h1>
    @endif
@stop