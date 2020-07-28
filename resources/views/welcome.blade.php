<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Upload your file:
        </div>
        <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="file" type="file">
            <button type="submit">Submit</button>
        </form>
        <div>
            @if(Session::get('count'))
                <div>Saved: {{ Session::get('count.inserted') }} rows</div>
                <div>Not saved: {{ Session::get('count.inputData') - Session::get('count.inserted')}} rows</div>
                <div>
                    Not correct structure {{ Session::get('count.inputData') - Session::get('count.inserted') - Session::get('count.exist') }} rows
                </div>
                <div>
                    Already exist {{ Session::get('count.inputData') - Session::get('count.inserted') - Session::get('count.correctStructure') }} rows
                </div>
            @endif
        </div>
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
</body>
</html>
