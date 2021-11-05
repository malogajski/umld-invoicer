<?php

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>THAHAB</title>
    <style>
        body {
            background: rgba(0, 0, 0, 0.9);
        }

        form {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -100px;
            margin-left: -250px;
            width: 500px;
            height: 200px;
            border: 4px dashed #fff;
        }

        form p {
            width: 100%;
            height: 100%;
            text-align: center;
            line-height: 170px;
            color: #ffffff;
            font-family: Arial;
        }

        form input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
        }

        form button {
            margin: 0;
            color: #fff;
            background: #16a085;
            border: none;
            width: 508px;
            height: 35px;
            margin-top: -20px;
            margin-left: -4px;
            border-radius: 4px;
            border-bottom: 4px solid #117A60;
            transition: all .2s ease;
            outline: none;
        }

        form button:hover {
            background: #149174;
            color: #0C5645;
        }

        form button:active {
            border: 0;
        }

    </style>
</head>
<body>

<form method='post' action='{{ route('test-index') }}' enctype='multipart/form-data'>
    @csrf
    <input type="file" name='file' id="file"><br/>
    <p>Drag your files here or click in this area.</p>
    <button type="submit" name="unzip">Upload</button>
</form>

</body>
</html>


<script>
    $(document).ready(function () {
        $('form input').change(function () {
            $('form p').text(this.files.length + " file(s) selected");
        });
    });
</script>
