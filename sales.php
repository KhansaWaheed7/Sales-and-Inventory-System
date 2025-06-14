<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center border-bottom">
        <h4 class="mb-0 fw-semibold text-primary">📊 Sales List</h4>
    </div>
    <div class="card-body bg-light">
        <table class="table table-hover table-bordered bg-white shadow-sm rounded text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th class="p-1">#</th>
                    <th class="p-1">OR Number</th>
                    <th class="p-1">Customer</th>
                    <th class="p-1">Amount</th>
                    <th class="p-1">Discount</th>
                    <th class="p-1">Total</th>
                    <th class="p-1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM `transaction_list` ORDER BY strftime('%s', `date_created`) DESC";
                $qry = $conn->query($sql);
                $i = 1;
                while($row = $qry->fetchArray()):
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td class="text-start px-2"><?php echo $row['or_number'] ?></td>
                    <td class="text-start px-2"><?php echo $row['customer_name'] ?></td>
                    <td class="text-end px-2"><?php echo number_format($row['total_amount'] + $row['discount_amount'], 2) ?></td>
                    <td class="text-end px-2"><?php echo number_format($row['discount_amount'], 2) ?></td>
                    <td class="text-end px-2"><?php echo number_format($row['total_amount'], 2) ?></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle rounded-pill px-3" type="button" id="actionBtn<?php echo $row['transaction_id'] ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionBtn<?php echo $row['transaction_id'] ?>">
                                <li><a class="dropdown-item view_data" data-id="<?php echo $row['transaction_id'] ?>" href="javascript:void(0)">👁️ View</a></li>
                                <li><a class="dropdown-item delete_data text-danger" data-id="<?php echo $row['transaction_id'] ?>" data-name="<?php echo $row['or_number'] ?>" href="javascript:void(0)">🗑️ Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if(!$qry->fetchArray()): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">No data to display.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .table th,
    .table td {
        vertical-align: middle;
    }

    .btn-outline-primary {
        font-weight: 500;
    }

    .dropdown-item:hover {
        background-color: #f0f0f0;
    }

    .table-primary th {
        background-color:  linear-gradient(45deg, #6366f1, #8b5cf6);
    }
</style>

<script>
    $(function () {
        $('.view_data').click(function () {
            uni_modal('Transaction Details', "view_transaction.php?id=" + $(this).attr('data-id'), 'large');
        });

        $('.delete_data').click(function () {
            _conf("Are you sure you want to delete <b>" + $(this).attr('data-name') + "</b> from the list?", 'delete_data', [$(this).attr('data-id')]);
        });

        $('table').DataTable({
            columnDefs: [
                { orderable: false, targets: 6 }
            ],
            responsive: true,
            pageLength: 5
        });
    });

    function delete_data(id) {
        $('#confirm_modal button').attr('disabled', true);
        $.ajax({
            url: 'Actions.php?a=delete_transaction',
            method: 'POST',
            data: { id: id },
            dataType: 'JSON',
            error: err => {
                console.error(err);
                alert("An error occurred.");
                $('#confirm_modal button').attr('disabled', false);
            },
            success: function (resp) {
                if (resp.status === 'success') {
                    location.reload();
                } else {
                    alert("An error occurred.");
                    $('#confirm_modal button').attr('disabled', false);
                }
            }
        });
    }
</script>

