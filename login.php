<?php
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
    header("Location:./");
    exit;
}
require_once('DBConnection.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | Sales and Inventory System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <style>
        
    html, body {
        height: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        margin: 0;
        padding: 0;
    }

    .h-100 {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    h3 {
        color: white;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .card-body {
        background-color: #ffffff;
        padding: 2rem;
    }

    .form-group label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #2575fc;
        box-shadow: 0 0 0 2px rgba(37,117,252,0.2);
    }

    .btn-primary {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        border: none;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
    }

    small {
        display: block;
        margin-bottom: 15px;
        color: #666;
        font-size: 0.9rem;
    }

    .alert {
        font-size: 0.9rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .alert-danger {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #c62828;
    }

    .alert-success {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #2e7d32;
    }
</style>

</head>
<body>
   <div class="h-100 d-flex jsutify-content-center align-items-center">
       <div class='w-100'>
        <h3 class="py-5 text-center">Sales and Inventory System</h3>
        <div class="card my-3 col-md-4 offset-md-4">
            <div class="card-body">
                <form action="" id="login-form">
                    <center><small>Please enter your credentials.</small></center>
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" id="username" autofocus name="username" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control form-control-sm rounded-0" required>
                    </div>
                    <div class="form-group d-flex w-100 justify-content-end">
                        <button class="btn btn-sm btn-primary rounded-0 my-1">Login</button>
                    </div>
                </form>
            </div>
        </div>
       </div>
   </div>
</body>
<script>
    $(function(){
        $('#login-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            _this.find('button').attr('disabled',true)
            _this.find('button[type="submit"]').text('Loging in...')
            $.ajax({
                url:'Actions.php?a=login',
                method:'POST',
                data:$(this).serialize(),
                dataType:'JSON',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        setTimeout(() => {
                            location.replace('./');
                        }, 2000);
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                    _this.find('button').attr('disabled',false)
                    _this.find('button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>
</html>