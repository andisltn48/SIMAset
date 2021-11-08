<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://kit.fontawesome.com/767ff093f8.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png/x-icon" href="{{ asset('img/logo-itk-text.png') }}">
    <title>SIM-Aset @isset($title)
            - {{ $title }}
        @endisset</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.full.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div id="wrapper">
        @include('layouts/sidebar')
        <div id="content-wrapper">

            <!-- Main Content -->
            <div id="content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <script>
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.sidebar');
        let brandtext = document.querySelector('.sidebar-brand-text');
        let content = document.querySelector('#content');
        let icon = document.querySelectorAll('.iconitem');
        let fauser = document.querySelector('.fa-user');
        toggle.onclick = function() {
            brandtext.classList.toggle('hide');
            toggle.classList.toggle('active')
            navigation.classList.toggle('close');
            content.classList.toggle('span');
            fauser.classList.toggle('hide')
            for (let index = 0; index < icon.length; index++) {

                icon[index].classList.toggle('hide');

            }
        }
    </script>
</body>

</html>
