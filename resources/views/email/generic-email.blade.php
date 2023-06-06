@extends('layouts.email')

@section('email-content')
    {!! str_replace(['[invitationLink]'], [$data['invitationLink']], $template->message) !!}
@endsection
