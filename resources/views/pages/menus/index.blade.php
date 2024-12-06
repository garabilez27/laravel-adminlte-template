@extends('layouts.app')

@section('contents')
<form action="">
<div class="row mb-3">
    <div class="col-12 d-flex">
        <a href="{{ route('mn.add') }}" class="btn btn-success">
            <i class="fa fa-plus"></i>
            Add
        </a>
        <div class="ml-auto">
            <div class="input-group">
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-fw"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="card-title">
                    <i class="fa fa-list"></i>
                    List
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Prefix</th>
                            <th>Detail</th>
                            <th>Reference</th>
                            <th>Icon</th>
                            <th>Branched</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $n = 1; @endphp
                        @foreach ($records as $menu)
                            <tr>
                                <th>{{ $n++ }}</th>
                                <td>{{ $menu->mn_prefix }}</td>
                                <td>{{ $menu->mn_detail }}</td>
                                <td>{{ $menu->mn_reference }}</td>
                                <td>{{ $menu->mn_icon }}</td>
                                <td>
                                    @if ($menu->mn_branched)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('mn.edit', md5($menu->mn_id)) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="{{ route('mn.delete', md5($menu->mn_id)) }}" class="btn btn-danger btn-sm confirm-delete"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
