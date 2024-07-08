<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('contentheader')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">@yield('contentheaderactivelink')</li>
                        <li class="breadcrumb-item active">@yield('contentheaderactive')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            @yield('content')
        </div>
    </div>

</div>
