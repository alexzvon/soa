<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                @isset($temps)
                    <ol>
                    @foreach ($temps as $temp)
                        <li>{{ $temp[0] }} -- {{ $temp[1] }}</li>
                    @endforeach
                    </ol>
                @endisset

                @isset($error)
                    <h3 style="color:red">{{ $error }}</h3>
                @endisset

                <div class="card-body">
                    <form method="POST" action="{{ route('getbydate') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Дата') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-submit">
                                    {{ __('Отправить') }}
                                </button>
                            </div>
                        </div>

                        <div>
                            <span class="invalid-feedback" role="alert">
                                 <strong id="meserr"></strong>
                            </span>
                        </div>

                        <div>
                            <span class="invalid-feedback" role="alert">
                                 <strong id="message">Температура {<span id="mes"></span>} градусов.</strong>
                            </span>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        window.onload = function() {
            $('#message').hide();
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".btn-submit").click(function(e){
            e.preventDefault();
            var date = $("input[name=date]").val();
            $('#meserr').html('');
            $('#mes').html('');
            $('#message').hide();

            $.ajax({
                type:'POST',
                url:'{{ route('getbydate') }}',
                data:{date:date},
                success:function(data){
                    console.log(data);
                    $('#mes').html(data.success);
                    $('#message').show();
                },
                error: function (response) {
                    var r = jQuery.parseJSON(response.responseText);
                    $('#meserr').html(r.errors.date[0]);
                }
            });
        });

    </script>
</html>
