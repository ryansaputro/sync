<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{asset('css/css.css')}}" rel="stylesheet">

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
            .col-sm-4{
                flex: 0 0 32.999999% !important;
                max-width: 32.999999% !important;
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
                    <a href="{{URL::to('/ongkir')}}"> Cek Ongkos</a>
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <td>Kurir</td>
                            <td>Layanan</td>
                            <td>Tarif</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cost AS $k => $v)
                            @foreach($v['costs'] AS $kx => $vx)
                                <tr>
                                    <td>
                                        {{$v['code']}}
                                    </td>
                                    <td>
                                        {{$vx['service']}}
                                    </td>
                                    <td>
                                        {{$vx['cost'][0]['value']}}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </body>
</html>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script>
   function province(a){
       var id = $(a).find('option:selected').val();
        $.ajax({
            method: "POST",
            url: "{{URL::to('/ajaxProvince')}}",
            data: { 
                "id": id,
                "_token": "{{ csrf_token() }}"
            }
        }).done(function(e) {
            console.log("selesai");
            console.log(e.city);
            var option = "<option disabled selected>-pilih-</option>"
            $.each(e.city, function(x,y){
                option += '<option value="'+y.city_id+'">'+y.type+" "+y.city_name+'</option>'
            })
            $('.kota').html(option);
        });
   }
       
   function Toprovince(a){
       var id = $(a).find('option:selected').val();
       alert(id);
        $.ajax({
            method: "POST",
            url: "{{URL::to('/ajaxProvince')}}",
            data: { 
                "id": id,
                "_token": "{{ csrf_token() }}"
            }
        }).done(function(e) {
            console.log("selesai");
            console.log(e.city);
            var option = "<option disabled selected>-pilih-</option>"
            $.each(e.city, function(x,y){
                option += '<option value="'+y.city_id+'">'+y.type+" "+y.city_name+'</option>'
            })
            $('.Tokota').html(option);
        });
   }
       

    
    function checkconnection() {
        var status = navigator.onLine;
        if (status) {
        return "online";
        } else {
        return "offline";
        }
    }
</script>