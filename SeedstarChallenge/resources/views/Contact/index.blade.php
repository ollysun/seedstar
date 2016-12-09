@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <h1>Welcome to SeedStar Challenge</h1>
                        <p>
                            {!! link_to_route('contact.list', 'list of contact') !!} |
                            {!! link_to_route('contact.tasks.create', 'Create Task', $project->slug) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection