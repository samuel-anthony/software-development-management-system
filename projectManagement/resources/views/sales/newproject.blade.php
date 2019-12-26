@extends('layouts.customlayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card py-3 px-4">
                <div class="card-header text-center">
                    <h3 class="font-weight-bold">Create New Project</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker3" class="form-control" name="" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>End Date</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="datepicker4" class="form-control" name="" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Client</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control custom-select" for="" name="">
                                    <option value="1">Satu</option>
                                    <option value="2">Dua</option>
                                    <option value="3">Tiga</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>E-mail</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" id="" class="form-control" name="" value="">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-2">
                                <label>Assignee</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control custom-select" for="" name="">
                                    <option value="1">Satu</option>
                                    <option value="2">Dua</option>
                                    <option value="3">Tiga</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
