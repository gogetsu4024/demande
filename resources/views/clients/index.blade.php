@extends('layouts.app')
@section('css-includes')
    <link rel="stylesheet" href="assets/node_modules/dropify/dist/css/dropify.min.css">
    <link href="css/style.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Listes des clients</h4>
                </div>
                <div class="card-body">
                        <div class="form-body">
                            <h3 class="card-title">Tableau de gestion</h3>
                            <hr>
                            <div class="card-body">
                                <h4 class="card-title">Data Export</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>picture</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            <th>Tel</th>
                                            <th>Pays</th>
                                            <th>Etat</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>picture</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            <th>Tel</th>
                                            <th>Pays</th>
                                            <th>Etat</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @if(count($clients)!=0)
                                            @foreach($clients as $row)
                                                <tr>
                                                    <td><img src="{{$row->picture_Path}}" alt="user" width="40" class="img-circle"></td>
                                                    <td>{{$row->nom}}</td>
                                                    <td>{{$row->email}}</td>
                                                    <td>{{$row->Tel}}</td>
                                                    <td>{{$row->addresse->pays}}</td>
                                                    <td>{{$row->addresse->etat}}</td>
                                                    <td>
                                                        <button  class="btn btn-danger" data-toggle="tooltip" data-original-title="Edit"  aria-describedby="tooltip908296"  aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </button>
                                                        <form action="{{ route('clients.destroy', $row->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button  class="btn btn-info " data-toggle="tooltip" data-original-title="Delete"  aria-describedby="tooltip908296" aria-expanded="false">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js-includes')
    <script src="/assets/node_modules/datatables/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    </script>

@endsection