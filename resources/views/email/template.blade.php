@extends('layouts.email')

@section('email-content')
    {!! str_replace(
        ['[fistName]', '[lastName]', '[email]'],
        [$user->first_name, $user->last_name, $user->email],
        $template->message,
    ) !!}
@endsection
