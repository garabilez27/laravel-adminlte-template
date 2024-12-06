@extends('layouts.app')

@section('contents')
<form action="{{ route('sbmn.create') }}" method="post">
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
                        <label for="group">Group <span class="text-danger">*</span></label>
                        <select name="group" id="group" class="form-control select @error('group') is-invalid @enderror" value="{{ old('group') }}" style="width: 100%">
                            @foreach ($records as $menu)
                                <option value="{{ md5($menu->mn_id) }}">{{ $menu->mn_detail }}</option>
                            @endforeach
                        </select>
                        @error('group')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="detail">Detail <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" value="{{ old('detail') }}" placeholder="Detail" autocomplete="off">
                        @error('detail')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="reference">Reference <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" value="{{ old('reference') }}" placeholder="Reference" autocomplete="off">
                        @error('reference')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="icon">Icon <span class="text-danger">*</span> <a href="https://fontawesome.com/v5/search" class="text-sm" target="_blank">[ font-awesome ]</a></label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') }}" placeholder="fa-circle" autocomplete="off">
                        @error('icon')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="class">Class</label>
                        <input type="text" class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ old('class') }}" placeholder="Class" autocomplete="off">
                        @error('class')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="sequence">Sequence</label>
                        <input type="number" class="form-control @error('sequence') is-invalid @enderror" id="sequence" name="sequence" value="{{ old('sequence') }}" placeholder="Sequence" autocomplete="off">
                        @error('sequence')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="menu">Menu <span class="text-danger">*</span></label>
                        <select name="menu" id="menu @error('menu') is-invalid @enderror" value="{{ old('menu') }}" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('menu')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('sbmn.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
