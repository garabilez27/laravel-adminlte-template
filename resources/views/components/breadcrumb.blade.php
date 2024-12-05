<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $user->menus[$s_menu]['detail'] }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    @if (empty($s_submenu))
                    <li class="breadcrumb-item active">{{ $user->menus[$s_menu]['detail'] }}</li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ route($user->menus[$s_menu]['reference']) }}">{{ $user->menus[$s_menu]['detail'] }}</a></li>
                    <li class="breadcrumb-item active">{{ $user->menus[$s_menu]['detail'][$s_submenu]['detail'] }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
