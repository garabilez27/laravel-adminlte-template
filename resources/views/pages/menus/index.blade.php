@extends('layouts.app')

@section('contents')
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
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></a>
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
