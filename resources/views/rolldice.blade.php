@extends('layouts.master')
@section('content')
<h1>Dice roll : <?php echo $number; ?>!</h1>
<h3>You guessed : <?php echo $guess; ?>!</h3>
<div>
    <?php if ($guess == $number) { ?>
        <?php echo "You win" ?>
    <?php } else { ?>
        <?php echo "Try again." ?>
    <?php } ?>
</div >
@stop