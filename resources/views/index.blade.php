@extends('layouts.app')

@section('text')
    <div class="container">
        <div class="row justify-text-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">タイムライン</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('message.store') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-10">
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
                        @foreach($messages as $message)
                            <hr>
                            <div>
                                <p>
                                    {{$message->message_user->name}}
                                    {{$message->created_at->format('Y/m/d H:i:s')}}
                                </p>
                                {{$message->text}}
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('6ae8f5d6ef11e04ab407', {
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
        //var channel = pusher.subscribe('private-my-channel');
        var channel = pusher.subscribe('private-App.User.{{ Auth::id() }}');

        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
@endsection