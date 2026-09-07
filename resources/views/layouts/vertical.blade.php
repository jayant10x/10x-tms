<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @include('layouts.partials/head-css')
</head>

<body>

<div class="wrapper">

    @include("layouts.partials/topbar")
    @include("layouts.partials/main-nav")

    <div class="page-content">

        <div class="container-fluid">

            {{--@include("layouts.partials/page-title",['title' => $title,'subTitle' => $subTitle])--}}
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="mb-0 fw-semibold">{{ $title }}</h4>
                        @yield('module-right-section')
                        {{--<ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $subTitle }}</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>--}}
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        @include("layouts.partials/footer")

        @yield('modal')

    </div>

</div>

@include("layouts.partials/right-sidebar")
@include('layouts.partials.toastify')
@include('layouts.partials/footer-scripts')
@if (session('success'))

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json(session('success')), 'success');
        });
    </script>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json(session('error')), 'error');
        });
    </script>
@endif
</body>

</html>
