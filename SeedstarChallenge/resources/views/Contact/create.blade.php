@extends('app')

@section('content')
    <h2>Create Contact</h2>

    {!! Form::model(new SeedStar\Model, ['route' => ['projects.store']]) !!}
    @include('projects/partials/_form', ['submit_text' => 'Create Contact'])
    {!! Form::close() !!}
@endsection