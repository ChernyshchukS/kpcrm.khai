<?php
$title = 'Role create';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">Role create</h1>
        <form method="POST" action="index.php?page=roles&action=store">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create role</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>
