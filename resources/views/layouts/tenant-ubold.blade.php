<!DOCTYPE html>
<html lang="id" 
    data-skin="default"
    data-bs-theme="light"
    data-menu-color="light"
    data-topbar-color="dark"
    data-layout-position="fixed"
    data-sidenav-size="default">

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Panel Penyewa' }} | Kosan DiriQ by Najla</title>
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Sistem Manajemen Kosan DiriQ by Najla" name="description" />
    <meta content="Kosan DiriQ" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- App favicon -->
    <link href="/images/favicon.ico" rel="shortcut icon" />

    @include('layouts.partials.head-css')
    @livewireStyles
</head>

<body>
    <div class="wrapper">

        @include('layouts.partials.sidenav-tenant')

        @include('layouts.partials.topbar-tenant')

        <div class="content-page">
            <div class="content">

                <div class="container-fluid">
                    {{ $slot }}
                </div>

            </div>

            @include('layouts.partials.footer')

        </div>

    </div>

    @include('layouts.partials.footer-scripts')
</body>

</html>
