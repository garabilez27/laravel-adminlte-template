@extends('layouts.app')

@section('contents')
<form action="{{ route('mn.update') }}" method="post">
    @csrf
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        Edit
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group mb-2">
                        <label for="prefix">Prefix <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prefix') is-invalid @enderror" id="prefix" name="prefix" value="{{ old('prefix') ?? $records->mn_prefix }}" placeholder="Prefix" autocomplete="no">
                        @error('prefix')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="detail">Detail <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" value="{{ old('detail') ?? $records->mn_detail }}" placeholder="Detail" autocomplete="no">
                        @error('detail')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="reference">Reference <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reference') is-invalid @enderror" id="reference" name="reference" value="{{ old('reference') ?? $records->mn_reference }}" placeholder="Reference" autocomplete="no">
                        @error('reference')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="icon">Icon <span class="text-danger">*</span> <a href="https://fontawesome.com/v5/search" class="text-sm" target="_blank">[ font-awesome ]</a></label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon') ?? $records->mn_icon }}" placeholder="Icon" autocomplete="no">
                        @error('icon')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="sequence">Sequence</label>
                        <input type="text" class="form-control @error('sequence') is-invalid @enderror" id="sequence" name="sequence" value="{{ old('sequence') ?? $records->mn_sequence }}" placeholder="Sequence" autocomplete="no">
                        @error('sequence')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="branched">Branched</label>
                        <select name="branched" id="branched @error('branched') is-invalid @enderror" value="{{ old('branched') ?? $records->mn_branched }}" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('branched')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('mn.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" name="id" value="{{ md5($records->mn_id) }}" class="btn btn-success float-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
