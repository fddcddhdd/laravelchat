@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-text-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">チャット・ルーム名：{{$room->name}}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{-- チャット履歴 --}}
                        <div id="message_list">
                            @foreach($messages as $message)

                                <p class="message_box">
                                    {{--{{$message->created_at->format('Y/m/d H:i:s')}}--}}
                                    <b>{{$message->user->name}}</b>
                                    {{$message->text}}
                                </p>
                                <hr>
                            @endforeach
                        </div>

                        {{-- 発言欄 --}}
                        <form method="POST" action="{{ route('message.store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10">

                                    <input type="hidden" name="room_id" value="{{$room->id}}">
                                    <input id="text" type="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" name="text" value="{{ old('text') }}" required autofocus>

                                    @if ($errors->has('text'))
                                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('text') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        投稿
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: 'ap3',
            forceTLS: true,
            // デフォルトだと、ドメイン名/pusher/authなので、laravelの認証パスに変更
            authEndpoint: 'broadcasting/auth',
            // csrfトークンがないと認証エラーになる。
            auth: {
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                }
            }
        });
        var channel = pusher.subscribe('my-channel');
        //var channel = pusher.subscribe('private-App.User.{{ Auth::id() }}');

        channel.bind('my-event{{$room->id}}', function(data) {
            // alert(JSON.stringify(data));

            // divの子要素の最後に追加
            $('#message_list').append('<p><b>'+ data.user_name +'</b> '+ data.message_text +'</p><hr>');

        });


    </script>
@endsection