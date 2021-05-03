<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--=================================================================================--}}
    <meta name="client/config/environment" content="%7B%22modulePrefix%22%3A%22client%22%2C%22environment%22%3A%22development%22%2C%22rootURL%22%3A%22/%22%2C%22locationType%22%3A%22auto%22%2C%22EmberENV%22%3A%7B%22FEATURES%22%3A%7B%7D%2C%22EXTEND_PROTOTYPES%22%3A%7B%22Date%22%3Afalse%7D%7D%2C%22APP%22%3A%7B%22name%22%3A%22client%22%2C%22version%22%3A%220.0.0+6e75d09c%22%7D%2C%22ember-cli-mirage%22%3A%7B%22usingProxy%22%3Afalse%2C%22useDefaultPassthroughs%22%3Atrue%7D%2C%22exportApplicationGlobal%22%3Atrue%7D" />
    <script src="/ember-cli-live-reload.js" type="text/javascript"></script>

    <link integrity="" rel="stylesheet" href="/app/assets/vendor.css">
    <link integrity="" rel="stylesheet" href="/app/assets/client.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">




    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
{{--=================================================================================--}}

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">




<div class="flex flex-col">
    @if(Route::has('login'))
        <div class="absolute top-0 right-0 mt-4 mr-4 space-x-4 sm:mt-6 sm:mr-6 sm:space-x-6">
            @auth
                <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Home') }}</a>
            @else
                <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div style="display: none;" class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full">
            <div>
                <h1  style="display: none;" class="mb-6 text-gray-600 text-center font-light tracking-wider text-4xl sm:mb-8 sm:text-6xl">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <ul   class="flex flex-col space-y-2 sm:flex-row sm:flex-wrap sm:space-x-8 sm:space-y-0">
                    <li>
                        <a href="https://laravel.com/docs" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Documentation">Documentation</a>
                    </li>
                    <li>
                        <a href="https://laracasts.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Laracasts">Laracasts</a>
                    </li>
                    <li>
                        <a href="https://laravel-news.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="News">News</a>
                    </li>
                    <li>
                        <a href="https://nova.laravel.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Nova">Nova</a>
                    </li>
                    <li>
                        <a href="https://forge.laravel.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Forge">Forge</a>
                    </li>
                    <li>
                        <a href="https://vapor.laravel.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Vapor">Vapor</a>
                    </li>
                    <li>
                        <a href="https://github.com/laravel/laravel" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="GitHub">GitHub</a>
                    </li>
                    <li>
                        <a href="https://tailwindcss.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Tailwind Css">Tailwind CSS</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="/app/assets/vendor.js"></script>
<script src="/app/assets/client.js"></script>



<!------------ Start Modal------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">שתף משימות</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{--{{ $users = view('users.index', compact('user'))->render();  }}--}}
            {{--            <form action="{{ route('users.update','update_tasks') }}" method="POST">--}}

{{--            <form  id="sample_form" action="{{ route('users.store') }}" method="POST" >--}}
            <div class="modal-body">
                <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal">
                @csrf

                    <input type="hidden" name="task_id_hidden" id="task_id_hidden" />
                    <div>
                        @foreach(\App\Models\User::get() as $user)
                            <div class="form-group form-check  form-control-lg">
                                <input type="checkbox" class="form-check-input" data-id="{{ $user->id }}" id="{{ $user->id }}">
                                {{--                                <input class="form-control form-control-sm" type="text" data-id="{{ $user->id }}" id="{{ $user->id }}" value="{{ $user->name }}"  >--}}
                                <input name="user_checkbox" class="form-control form-control-sm" value="{{ $user->value ?? null }}" {{ $user->value ? null : 'disabled' }} data-id="{{ $user->id }}" name="users[{{ $user->id }}]" type="text"  placeholder="{{ $user->name }}">

                            </div>
                        @endforeach
                    </div>

                        <div class="modal-footer">
{{--                            <button type="submit" class="btn btn-primary" id="action_button"  value="Add">Submit</button>--}}
                            <input type="submit" name="action_button" id="action_button" class="btn tn-primary" value="Add" />
                        </div>

                    </form>
                </div>





        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click', '.share_user_task', function(){
            debugger;
            var share_user_task_id = $(this).attr("id");
            share_user_task_id = share_user_task_id.split("_");
            document.getElementById('task_id_hidden').value = share_user_task_id[2];

        //  alert(share_user_task_id[2]);
        //$('#row'+button_id+'').remove();

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url = "{{ route('users.store') }}";
            }

            {{--if($('#action').val() == 'Edit')--}}
            {{--{--}}
            {{--    action_url = "{{ route('sample.update') }}";--}}
            {{--}--}}

            $.ajax({
                url: action_url,
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    if(data.errors)
                    {
                        html = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        $('#user_table').DataTable().ajax.reload();
                    }
                    $('#form_result').html(html);
                }
            });
        });
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $(".print-success-msg").css('display','none');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
    });
</script>















<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
