@extends('layouts.app')

@section('contents')
<div class="row">
    @foreach ($user->menus[$s_menu]['sub'] as $sb => $sub)
        @if($sub['menu'])
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fa {{ $sub['icon'] }}"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ $sub['detail'] }}</span>
                    <span class="info-box-number"><a href="#">Show More</a></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        @endif
    @endforeach
</div>
@endsection
