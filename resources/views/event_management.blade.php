@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-10">
            <button type="button" class="btn btn-primary mb-3 create-event">Add Event</button>

            <div class="card">
                <div class="card-header">{{ __('Event List') }}</div>
                <div class="card-body">
                    <table id="eventlist" class="table table-bordered data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Dates</th>
                                <th>Occurrence</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    $('.create-event').on('click', function() {
        var page_url = app_url+'/'+'add-event';
        //alert(page_url)
        window.location.href = page_url;
    });

    $(document).ready(function() {
        $('#eventlist').DataTable( {
            serverSide: true,
            ordering: false,
            searching: false,
            ajax: "{{ route('events.index') }}",
            scrollY: 200,
            scroller: {
                loadingIndicator: true
            },
            columns: [
                {data: 'title', name: 'title'},
                {
                    data: 'start_date',
                    name: 'start_date',
                    "render": function ( data, type, row, meta ) {
                        return data+' to '+row.end_date;
                      }
                },
                {data: 'occurence', name: 'occurence'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        } );
    } );
@endsection
