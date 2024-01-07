<?php
$title = 'Role edit';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">Role edit</h1>
        <form method="post" action="index.php?page=roles&action=update">
            <input type="hidden" name="id" value="<?php echo $role['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?php echo $role['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $role['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update role</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>
