<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
        <h4 class="mb-0 fw-semibold text-primary">👤 Users List</h4>
        <button class="btn btn-gradient btn-sm px-4 py-1 rounded-pill fw-semibold" type="button" id="create_new">+ Add New</button>
    </div>
    <div class="card-body bg-light">
        <table class="table table-hover table-bordered bg-white shadow-sm rounded text-center align-middle">
            <colgroup>
                <col width="5%">
                <col width="25%">
                <col width="25%">
                <col width="25%">
                <col width="20%">
            </colgroup>
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM `user_list` WHERE user_id != 1 ORDER BY `fullname` ASC";
                $qry = $conn->query($sql);
                $i = 1;
                while($row = $qry->fetchArray()):
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td>
                        <span class="badge rounded-pill bg-<?php echo ($row['type'] == 1)? 'success':'info' ?>">
                            <?php echo ($row['type'] == 1)? 'Administrator':'Cashier' ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-primary rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item edit_data" data-id='<?php echo $row['user_id'] ?>' href="javascript:void(0)">✏️ Edit</a></li>
                                <li><a class="dropdown-item delete_data text-danger" data-id='<?php echo $row['user_id'] ?>' data-name='<?php echo $row['fullname'] ?>' href="javascript:void(0)">🗑️ Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if(!$qry->fetchArray()): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">No data to display.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-gradient {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        color: #fff !important;
        border: none;
        font-weight: 500;
        transition: 0.3s ease-in-out;
    }

    .btn-gradient:hover {
        opacity: 0.9;
        color: #fff !important;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .card-title {
        font-size: 1.25rem;
    }
</style>

<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New User', "manage_user.php")
        });

        $('.edit_data').click(function(){
            uni_modal('Edit User Details', "manage_user.php?id=" + $(this).attr('data-id'))
        });

        $('.delete_data').click(function(){
            _conf("Are you sure you want to delete <b>" + $(this).attr('data-name') + "</b>?", 'delete_data', [$(this).attr('data-id')])
        });

        $('table').DataTable({
            columnDefs: [{ orderable: false, targets: 4 }],
            responsive: true,
            pageLength: 5
        });
    });

    function delete_data(id) {
        $('#confirm_modal button').attr('disabled', true);
        $.ajax({
            url: 'Actions.php?a=delete_user',
            method: 'POST',
            data: { id: id },
            dataType: 'JSON',
            error: err => {
                console.error(err);
                alert("An error occurred.");
                $('#confirm_modal button').attr('disabled', false);
            },
            success: function(resp) {
                if (resp.status == 'success') {
                    location.reload();
                } else {
                    alert("An error occurred.");
                    $('#confirm_modal button').attr('disabled', false);
                }
            }
        });
    }
</script>
