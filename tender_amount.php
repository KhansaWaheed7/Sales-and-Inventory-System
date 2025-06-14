<style>
    #uni_modal .modal-footer {
        display: none !important;
    }
    #change.border-danger {
        border: 2px solid red;
    }
</style>

<div class="container-fluid">
    <!-- Payable Amount Display -->
    <div class="form-group">
        <label class="fs-4">Payable Amount</label>
        <input type="text" class="form-control form-control-lg text-end fs-4" 
               id="gTotal" 
               value="<?php echo number_format($_GET['total'], 2) ?>" 
               readonly>
    </div>

    <!-- Tendered Amount Input -->
    <div class="form-group mt-2">
        <label class="fs-4">Tendered Amount</label>
        <input type="text" class="form-control form-control-lg text-end fs-4" 
               id="tender" 
               value="0">
    </div>

    <!-- Change Display -->
    <div class="form-group mt-2">
        <label class="fs-4">Change</label>
        <input type="text" class="form-control form-control-lg text-end fs-4" 
               id="change" 
               value="0" 
               readonly>
    </div>

    <!-- Action Buttons -->
    <div class="col-12">
        <div class="row justify-content-end mt-3">
            <button class="btn btn-sm rounded-0 btn-primary me-2 col-auto" 
                    type="button" 
                    id="submit_sales">Save</button>
            <button class="btn btn-sm rounded-0 btn-dark col-auto me-3" 
                    type="button" 
                    data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
$(function () {
    // Focus and select tender input on modal open
    $('#uni_modal').on('shown.bs.modal', function () {
        $('#tender').focus();
        $('#tender').select();
    });

    // Update change amount on tender input
    $('#tender').on('input', function () {
        var tender = parseFloat($(this).val());
        var total = parseFloat("<?php echo $_GET['total'] ?>");
        var change = tender - total;

        if (isNaN(change)) change = 0;

        $('#change').val(change.toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        }));

        // Pass values to hidden form inputs
        $('[name="amount_change"]').val(change.toFixed(2));
        $('[name="amount_tendered"]').val(tender.toFixed(2));
    });

    // Save on button click
    $('#submit_sales').click(function () {
        save_transaction();
    });

    // Save on Enter key press
    $('#tender').on('keydown', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            save_transaction();
        }
    });
});

// Transaction save logic
function save_transaction() {
    var change = parseFloat($('#change').val().replace(/,/g, ''));

    $('#change').removeClass('border-danger');

    if (change < 0) {
        $('#change').addClass('border-danger');
    } else {
        $('#uni_modal').modal('hide');
        $('#pos-form').submit(); // Ensure this form exists in main page
    }
}
</script>
