<?php
$title = 'Page create';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">Page create</h1>
        <form method="POST" action="<?= APP_BASE_PATH ?>/pages/store">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Role</label>
                <?php foreach ($roles as $role): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="role[]" id="role" value="<?php echo $role['id']; ?>">
                        <label class="form-check-label" for="role"><?php echo $role['name'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Create page</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>
