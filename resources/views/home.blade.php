@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">友達</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($friends as $friend)
                        <li>
                            <a href="message/{{$friend->id}}">{{$friend->name }}</a>
                        </li>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
