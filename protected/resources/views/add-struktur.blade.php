@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')


    <div class="col-md-12 ">
        <div class="panel panel-success">
            <div class="panel-heading">Add New Organizational Structure</div>
                <div class="panel-body">
                
                    <form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('StrukturOrganisasiController@store') }}">
                    {{ csrf_field() }}
                
                        <div class="form-group">
                            <label for="divisi" class="col-md-4 control-label">Divition</label>                                     
                            <div class="col-md-6">
                                <select name="id_divisi" >
                                    <option value="">..</option>
                                    @foreach($divisi as $div)
                                    <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit" class="col-md-4 control-label">Unit</label>                                     
                            <div class="col-md-6">
                                <select name="id_unit" >
                                    <option value="">..</option>
                                    @foreach($unit as $unt)
                                    <option value="{{$unt->id_unit}}">{{$unt->nama_unit}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department" class="col-md-4 control-label">Department</label>                                     
                            <div class="col-md-6">
                                <select name="id_department" >
                                    <option value="">..</option>
                                    @foreach($department as $dept)
                                    <option value="{{$dept->id_department}}">{{$dept->nama_departmen}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="section" class="col-md-4 control-label">Section</label>                                     
                            <div class="col-md-6">
                                <select name="id_section">
                                    <option value="">..</option>
                                    @foreach($section as $sect)
                                    <option value="{{$sect->id_section}}">{{$sect->nama_section}}</option>
                                    @endforeach
                                </select><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Add Org. Structure
                                </button>
                            </div>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection