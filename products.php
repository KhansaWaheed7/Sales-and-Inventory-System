<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: 30px;
    }

    .card-header {
        background: linear-gradient(45deg, #6366f1, #8b5cf6);
        color: white;
        padding: 20px;
    }

    .card-title {
        margin: 0;
        font-weight: bold;
        font-size: 1.5rem;
    }

    .card-tools .btn {
        font-size: 0.85rem;
        background-color: #fff;
        color: #4f46e5;
        border: 2px solid #fff;
        transition: 0.3s ease;
    }

    .card-tools .btn:hover {
        background-color: #4f46e5;
        color: white;
    }

    table {
        font-size: 0.95rem;
    }

    th, td {
        vertical-align: middle !important;
        padding: 10px !important;
    }

    thead {
        background-color: #f3f4f6;
    }

    tbody tr:hover {
        background-color: #f0f9ff;
    }

    .dropdown-menu {
        font-size: 0.9rem;
    }

    .btn-primary.dropdown-toggle {
        background-color: #6366f1;
        border-color: #6366f1;
    }

    .btn-primary.dropdown-toggle:hover {
        background-color: #4f46e5;
    }
</style>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">📦 Product List</h3>
        <div class="card-tools">
            <button class="btn btn-light btn-sm py-1 px-3 rounded-pill" type="button" id="create_new">+ Add New</button>
        </div>
    </div>
    <div class="card-body bg-white">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Unit</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql = "SELECT * FROM `product_list` ORDER BY `name` ASC";
                $qry = $conn->query($sql);
                $i = 1;
                while($row = $qry->fetchArray()):
                ?>
                <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td><?php echo $row['product_code'] ?></td>
                    <td><?php echo $row['unit'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td class="text-end">Rs. <?php echo number_format($row['price'],2) ?></td>
                    <td class="text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle rounded-pill" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item edit_data" data-id='<?php echo $row['product_id'] ?>' href="#">Edit</a></li>
                                <li><a class="dropdown-item delete_data" data-id='<?php echo $row['product_id'] ?>' data-name='<?php echo $row['name'] ?>' href="#">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if(!$qry->fetchArray()): ?>
                    <tr>
                        <td class="text-center" colspan="7">No data to display.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function(){
        $('#create_new').click(function(){
            uni_modal('Add New product',"manage_products.php")
        })
        $('.edit_data').click(function(){
            uni_modal('Edit product',"manage_products.php?id="+$(this).attr('data-id'))
        })
        $('.delete_data').click(function(){
            _conf("Are you sure to delete <b>"+$(this).attr('data-name')+"</b> from list?",'delete_data',[$(this).attr('data-id')])
        })

        $('table').dataTable({
            columnDefs: [
                { orderable: false, targets:6 }
            ]
        })
    })

    function delete_data($id){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:'Actions.php?a=delete_product',
            method:'POST',
            data:{id:$id},
            dataType:'JSON',
            error:err=>{
                console.log(err)
                alert("An error occurred.")
                $('#confirm_modal button').attr('disabled',false)
            },
            success:function(resp){
                if(resp.status == 'success'){
                    location.reload()
                }else{
                    alert("An error occurred.")
                    $('#confirm_modal button').attr('disabled',false)
                }
            }
        })
    }
</script>
