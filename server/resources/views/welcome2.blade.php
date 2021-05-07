<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">





    <meta name="client/config/environment" content="%7B%22modulePrefix%22%3A%22client%22%2C%22environment%22%3A%22development%22%2C%22rootURL%22%3A%22/%22%2C%22locationType%22%3A%22auto%22%2C%22EmberENV%22%3A%7B%22FEATURES%22%3A%7B%7D%2C%22EXTEND_PROTOTYPES%22%3A%7B%22Date%22%3Afalse%7D%7D%2C%22APP%22%3A%7B%22name%22%3A%22client%22%2C%22version%22%3A%220.0.0+6e75d09c%22%7D%2C%22ember-cli-mirage%22%3A%7B%22usingProxy%22%3Afalse%2C%22useDefaultPassthroughs%22%3Atrue%7D%2C%22exportApplicationGlobal%22%3Atrue%7D" />
    <script src="/ember-cli-live-reload.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>


    <link integrity="" rel="stylesheet" href="/app/assets/vendor.css">
    <link integrity="" rel="stylesheet" href="/app/assets/client.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">








    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

</div>


<script src="/app/assets/vendor.js"></script>
<script src="/app/assets/client.js"></script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">שתף משימות</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <span id="form_result"></span>
            <form method="post" id="sample_form" class="form-horizontal">
                @csrf
                    <input type="hidden" name="task_id_hidden" id="task_id_hidden" value=""/>
                    <div>
                        @foreach(\App\Models\User::get() as $user)
                            <div class="form-group form-check  form-control-lg">
                                <input type="checkbox" name="chks[]" class="form-check-input check_user" data-id="{{ $user->id }}" id="user_{{ $user->id }}">
                                <input name="user_checkbox" class="form-control form-control-sm" value="{{ $user->value ?? null }}" {{ $user->value ? null : 'disabled' }} data-id="{{ $user->id }}" name="user_{{ $user->id }}" type="text"  placeholder="{{ $user->name }}">

                            </div>
                        @endforeach
                    </div>

                        <div class="modal-footer">
                            <div class="form-group" align="center">
                                <input type="hidden" name="action" id="action" value="Add" />
                                <input type="hidden" name="hidden_id" id="hidden_id" />
                                <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Add" />
                            </div>

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
          });
          $('#sample_form').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if($('#action').val() == 'Add')
            {
                action_url =  '' ;//"{{ route('users.store') }}";
            }

            var chks = $('input:checkbox[name="chks[]"]:checked').map(function(){return $(this).attr('id');}).get();

            $.ajax({
                url: action_url,
                type:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                       data : chks,
                       task_id:$( this ).serializeArray()
                        },
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
                    if(data.data.length)
                    {
                        debugger;
                        $('#exampleModal').hide().fadeOut('slow');
                        html1 = '<div class="alert alert-success">' + data.success + '</div>';
                        location.reload();
                    }
                    $('#form_result').html(html1);
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html> -->



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Client</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


<meta name="client/config/environment" content="%7B%22modulePrefix%22%3A%22client%22%2C%22environment%22%3A%22development%22%2C%22rootURL%22%3A%22/%22%2C%22locationType%22%3A%22auto%22%2C%22EmberENV%22%3A%7B%22FEATURES%22%3A%7B%7D%2C%22EXTEND_PROTOTYPES%22%3A%7B%22Date%22%3Afalse%7D%7D%2C%22APP%22%3A%7B%22name%22%3A%22client%22%2C%22version%22%3A%220.0.0+6e75d09c%22%7D%2C%22ember-cli-mirage%22%3A%7B%22usingProxy%22%3Afalse%2C%22useDefaultPassthroughs%22%3Atrue%7D%2C%22exportApplicationGlobal%22%3Atrue%7D" />
<script src="/ember-cli-live-reload.js" type="text/javascript"></script>

    <link integrity="" rel="stylesheet" href="/app/assets/vendor.css">
    <link integrity="" rel="stylesheet" href="/app/assets/client.css">


  </head>
  <body>


    <script src="/app/assets/vendor.js"></script>
    <script src="/app/assets/client.js"></script>


  </body>
</html>
