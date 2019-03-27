@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-text-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">チャット・ルーム一覧</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('room.store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('text'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        作成
                                    </button>
                                </div>
                            </div>
                        </form>

                        @foreach($rooms as $room)
                            <hr>
                            <p class="message_box">

                                <a href="{{url('room/'.$room->id)}}">{{$room->name}}({{ $room->messages()->count()}})</a>

                                {{$room->created_at->format('Y/m/d H:i:s')}}
                                ({{$room->user->name}})
                            </p>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection