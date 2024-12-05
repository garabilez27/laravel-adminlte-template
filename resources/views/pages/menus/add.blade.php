@extends('layouts.app')

@section('contents')
<form action="" method="post">
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
                    <label for="prefix">Prefix <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Prefix" autocomplete="no">
                </div>
                <div class="form-group mb-2">
                    <label for="detail">Detail <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="detail" name="detail" placeholder="Detail" autocomplete="no">
                </div>
                <div class="form-group mb-2">
                    <label for="reference">Reference <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="reference" name="reference" placeholder="Reference" autocomplete="no">
                </div>
                <div class="form-group mb-2">
                    <label for="icon">Icon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" autocomplete="no">
                </div>
                <div class="form-group mb-2">
                    <label for="sequence">Sequence</label>
                    <input type="text" class="form-control" id="sequence" name="sequence" placeholder="Sequence" autocomplete="no">
                </div>
                <div class="form-group mb-2">
                    <label for="branched">Branched <span class="text-danger">*</span></label>
                    <select name="branched" id="branched" class="form-control">
                        <option value="1">Yes</option>
                        <option value="1">No</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Save</button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
