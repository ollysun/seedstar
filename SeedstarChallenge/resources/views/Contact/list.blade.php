@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> List of contact </div>
                    <div class="panel-body">

                        <div class="input-group custom-search-form pull-right">

                            <p>{{ link_to_route('users.create', 'Add new user') }}</p>

                            @if($contacts->count())
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>DateCreated</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{$contact->name}}</td>
                                            <td>{{$contact->email}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
