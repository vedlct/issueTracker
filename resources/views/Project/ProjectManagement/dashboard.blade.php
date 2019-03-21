<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<!-- Item Details Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">

    <div class="row" style="margin: 0 auto; width:100%;">

        <div class="m-3">
            <div class="card" style="width: 20rem;">
                <div class="card-header text-white bg-dark">
                    Pending
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio <span class="badge badge-pill badge-info">Rumi</span>  <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros <span class="badge badge-pill badge-info">Farzad</span> <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>
                </ul>
                <button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>
            </div>
        </div>

        <div class="m-3">
            <div class="card" style="width: 20rem;">
                <div class="card-header text-white bg-dark">
                    Doing
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros</li>
                </ul>
                <button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>
            </div>
        </div>

        <div class="m-3">
            <div class="card" style="width: 20rem;">
                <div class="card-header text-white bg-dark">
                    Done
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio <span class="badge badge-pill badge-info">Rumi</span>  <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros <span class="badge badge-pill badge-info">Farzad</span> <span class="float-right text-white badge badge-dark" style="margin-top: 4px;">12:7:99</span> </li>
                </ul>
                <button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>
            </div>
        </div>

        <div class="m-3">
            <div class="card" style="width: 20rem;">
                <div class="card-header text-white bg-dark">
                    Testing
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros</li>
                </ul>
                <button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>
            </div>
        </div>

        <div class="m-3">
            <div class="card" style="width: 20rem;">
                <div class="card-header text-white bg-dark">
                    Test Done
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Cras justo odio</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Dapibus ac facilisis in</li>
                    <li class="list-group-item list-group-item-action" onclick="openItem()">Vestibulum at eros</li>
                </ul>
                <button class="btn btn-sm btn-success m-3" onclick="addItem()">Add</button>
            </div>
        </div>

    </div>

</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>

    function openItem(){
        $('#exampleModal').modal('show');
    }

    function addItem(){
        $('#exampleModal2').modal('show');
    }

</script>
</body>
</html>