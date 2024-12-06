@extends('layouts.app')

@section('contents')
<form action="{{ route('rl.update') }}" method="post">
    @csrf
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Add New
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="detail">Detail <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" value="{{ old('detail') ?? $records->rl_detail }}" placeholder="Detail" autocomplete="off">
                        @error('detail')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('rl.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="id" value="{{ md5($records->rl_id) }}" class="btn btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
