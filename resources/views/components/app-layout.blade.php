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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
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
        // let toggle = document.querySelector('.toggle');
        // let navigation = document.querySelector('.sidebar');
        // let brandtext = document.querySelector('.sidebar-brand-text');
        // let content = document.querySelector('#content');
        let icon = document.querySelectorAll('.iconitem');
        // let fauser = document.querySelector('.fa-user');
        // let greetings = document.querySelector('.greetings');

        // toggle.onclick = function() {
        //     brandtext.classList.toggle('hide');
        //     toggle.classList.toggle('active')
        //     navigation.classList.toggle('close');
        //     content.classList.toggle('span');
        //     greetings.classList.toggle('hide');
        //     fauser.classList.toggle('hide');
        //     for (let index = 0; index < icon.length; index++) {
        //         icon[index].classList.toggle('hide');

        //     }
        // }

        document.addEventListener("DOMContentLoaded", function(event) {

            const showNavbar = (toggleId, navId, headerId, contentId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    headerpd = document.getElementById(headerId),
                    contentspan = document.querySelector('#content')

                // Validate that all variables exist
                if (toggle && nav && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('expand')
                        headerpd.classList.toggle('body-pd')
                        contentspan.classList.toggle('span')

                        for (let index = 0; index < icon.length; index++) {
                            icon[index].classList.toggle('hide');

                        }
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'header')

        });
    </script>
</body>

</html>
