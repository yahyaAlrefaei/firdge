<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.partials.head')

<body class="app">


    <div>

        <div class="page-container">
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">
                    @yield("pdf")

                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
