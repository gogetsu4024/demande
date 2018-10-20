@extends('layouts.app')
@section('css-includes')

@endsection
@section('content')
    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; margin-top: 5%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Content is Responsive</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Listes des projets</h4>
                </div>
                <div class="card-body">
                        <div class="form-body">
                            <h3 class="card-title">Tableau de gestion</h3>
                            <hr>
                            <div class="card-body">
                                <h4 class="card-title">Data Export</h4>
                                <div class="row">
                                <div class="col-10">  <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6></div>
                                <div class="col-2"><a href="{{route('projets.create')}}" type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a></div>
                                </div>
                                    <div class="table-responsive">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>nom</th>
                                            <th>Description</th>
                                            <th>Nom client</th>
                                            <th>Tel client</th>
                                            <th>action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>nom</th>
                                            <th>Description</th>
                                            <th>Nom client</th>
                                            <th>Tel client</th>
                                            <th>action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @if(count($projets)!=0)
                                            @foreach($projets as $row)
                                                <tr>
                                                    <td>{{$row->nom}}</td>
                                                    <td>{!! $row->description !!}</td>
                                                    <td>{{$row->client->nom}}
                                                        <span data-toggle="modal" data-target="#responsive-modal">
                                                        <button  class="btn btn-dark btn-circle " data-toggle="tooltip"  data-original-title="Client info"  aria-describedby="tooltip908296" aria-expanded="false">
                                                            <i class="ti-bolt"></i>
                                                        </button>
                                                            </span>
                                                    </td>
                                                    <td>{{$row->client->Tel}}</td>
                                                    <td>
                                                        <div class="row">
                                                        <a href="{{ route('projets.edit', $row->id) }}"  class="btn btn-danger" data-toggle="tooltip" data-original-title="Edit"  aria-describedby="tooltip908296"  aria-expanded="false">
                                                            <i class="ti-settings"></i>
                                                        </a>
                                                        <form action="{{ route('projets.destroy', $row->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button  class="btn btn-info " data-toggle="tooltip" data-original-title="Delete"  aria-describedby="tooltip908296" aria-expanded="false">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </form>
                                                        </div>
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