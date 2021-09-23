<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            {{-- config('app.name', 'z') --}}             
            @yield('title')
        </title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- FontAwesome icons -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <!-- Bootstrap 5 --> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        @livewireStyles

        @stack('styles')
        
        <style>
            .input-border {
                border: solid 2px #e0ccff;
            }

            .mark {
                display:    none;
                position:   absolute;
                margin-left:-15px;
                color:      red;
            }

            .errorBorder {
                border: solid 2px red;
            }
        </style>
    </head>
    <body style="background-color: rgb(240, 235, 248);">
        {{--dd($errors->all())--}}

        @include('messages')

        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="container">
                    @yield('content')
                </div>
            </main>
        </div>


        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                // Each alert shows and hides one after another delayed by 1 sec
                $.each( $(".alert"), function(index) {
                    var delay = (index+2)*1000
                    $(this).fadeIn(1000).delay( delay ).fadeOut(1000);
                });

                @php
                foreach ($errors->all() as $error){
                    $q = str_replace(["The ", " field is required."], "", $error); 

                    echo "$('#$q').show();";
                }
                @endphp


            }); // End document ready
        </script>

        @livewireScripts

        @stack('scripts')

    </body>
</html>
