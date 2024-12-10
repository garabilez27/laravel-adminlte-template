@extends('layouts.app')

@section('contents')
<form action="{{ route('rl.menus') }}" method="post">
@csrf
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="card-title">
                    <i class="fa fa-list"></i>
                    Menus
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Menus</th>
                            <th>Sub Menus</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records['menus'] as $menu)
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="menus[]" class="custom-control-input" id="{{ md5($menu->mn_id) }}" value="{{ md5($menu->mn_id) }}" {{ in_array(md5($menu->mn_id), $records['role_menus']) ? 'checked' : '' }}>
                                            <label for="{{ md5($menu->mn_id) }}" class="custom-control-label" style="font-weight: 400">{{ $menu->mn_detail }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach ($menu->subs as $sub)
                                        @if ($sub->sbmn_menu)
                                        <div class="form-group m-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="subs[]" class="custom-control-input" id="{{ md5($sub->sbmn_id) }}" value="{{ md5($sub->sbmn_id).'|'.md5($menu->mn_id) }}" {{ in_array(md5($sub->sbmn_id), $records['role_menus']) ? 'checked' : '' }}>
                                                <label for="{{ md5($sub->sbmn_id) }}" class="custom-control-label" style="font-weight: 400">{{ $sub->sbmn_detail }}</label>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($menu->subs as $sub)
                                        @if (!$sub->sbmn_menu)
                                        <div class="form-group m-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="subs[]" class="custom-control-input" id="{{ md5($sub->sbmn_id) }}" value="{{ md5($sub->sbmn_id).'|'.md5($menu->mn_id) }}" {{ in_array(md5($sub->sbmn_id), $records['role_menus']) ? 'checked' : '' }}>
                                                <label for="{{ md5($sub->sbmn_id) }}" class="custom-control-label" style="font-weight: 400">{{ $sub->sbmn_detail }}</label>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex">
                <button type="submit" class="btn btn-success ml-auto mr-auto" value="{{ $records['id'] }}" name="id">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
