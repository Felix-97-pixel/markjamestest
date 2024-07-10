<!DOCTYPE html>
<html>
<head>
    <title>External API Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Data from External API</h2>
    @if(!empty($data))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['code'] }}</td>
                        <td>
                            <button class="btn btn-primary edit-btn" data-toggle="modal" data-target="#editModal" 
                            data-id="{{ $item['id'] }}" 
                            data-code="{{ $item['code'] }}" 
                            data-amount="{{ $item['amount'] }}" 
                            data-date="{{ $item['date'] }}" 
                            data-name="{{ $item['name'] }}">Editar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No data available.</p>
    @endif
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit-form" action="{{ route('externalapi.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="item-id" class="col-form-label">Id:</label>
                        <input type="text" class="form-control" id="item-id" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="item-code" class="col-form-label">Code:</label>
                        <input type="text" class="form-control" id="item-code" name="code" readonly>
                    </div>
                    <div class="form-group">
                        <label for="item-amount" class="col-form-label">Amount:</label>
                        <input type="text" class="form-control" id="item-amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label for="item-date" class="col-form-label">Date:</label>
                        <input type="date" class="form-control" id="item-date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="item-github" class="col-form-label">Github:</label>
                        <input type="text" class="form-control" id="item-github" name="github">
                    </div>
                    <div class="form-group">
                        <label for="item-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="item-name" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){
            var id = $(this).data('id');
            var code = $(this).data('code');
            var amount = $(this).data('amount');
            var date = $(this).data('date');
            var name = $(this).data('name');
            var github = 'https://github.com/Felix-97-pixel/markjamestest'; // Puedes ajustar esto si tienes un valor predeterminado

            $('#item-id').val(id);
            $('#item-code').val(code);
            $('#item-amount').val(amount);
            $('#item-date').val(date);
            $('#item-name').val(name);
            $('#item-github').val(github);
        });
    });
</script>
</body>
</html>