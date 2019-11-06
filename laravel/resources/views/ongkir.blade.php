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
                <form action="{{URL::to('/cekOngkos')}}" method="POST">
                    @csrf()
                    <h1>Halaman Ongkir</h1>
                    <h5>Dari :</h5>
                    <select name="provinsi_asal" class="provinsi form-control" onchange="province(this)">
                    <option selected disabled>-pilih-</option>
                        @foreach($ongkir AS $k => $v)
                    <option value="{{$v['province_id']}}">{{$v['province']}}</option>
                        @endforeach
                    </select>
                    <br>
                    <select name="kota_asal" class="kota form-control">
                        <option selected disabled>-pilih-</option>
                    </select>
                    <br>
                    <h5>Ke :</h5>
                    <select name="provinsi_tujuan" class="Toprovinsi form-control" onchange="Toprovince(this)">
                    <option selected disabled>-pilih-</option>
                        @foreach($ongkir AS $k => $v)
                    <option value="{{$v['province_id']}}">{{$v['province']}}</option>
                        @endforeach
                    </select>
                    <br>
                    <select name="kota_tujuan" class="Tokota form-control">
                        <option selected disabled>-pilih-</option>
                    </select>
                    <br>
                    <input type="number" class="form-control" name="berat" placeholder="masukan berat" min="100">
                    <br>
                    <select name="kurir" class="kurir form-control">
                        <option value="jne">JNE</option>
                        <option value="tiki">Tiki</option>
                        <option value="pos">Pos</option>
                    </select>
                    <br>
                    <button class="btn btn-primary btn-block">Cek</button>
                </form>
                
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