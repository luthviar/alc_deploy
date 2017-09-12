@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="userstable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Divisi</th>
            <th>Department</th>
            <th>Created At</th>
            <th>Authority</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function() {
        $('#userstable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('personnel.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' }
            ]
        });
    });
</script>
@endpush