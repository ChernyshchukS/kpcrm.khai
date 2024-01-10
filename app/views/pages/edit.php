<?php
$title = 'Page edit';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">Page edit</h1>
        <form method="post" action="<?= APP_BASE_PATH ?>/pages/update">
            <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="<?php echo $page['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug"
                       value="<?php echo $page['slug']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Role</label>
                <?php $page_role = explode(",", $page['role']); ?>
                <?php foreach ($roles as $role): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="role[]" id="role" value="<?php echo $role['id']; ?>"
                            <?php echo in_array($role['id'], $page_role) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="role"><?php echo $role['name'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mb-3">
                <label for="updated_at" class="form-label">Updated at</label>
                <input type="text" class="form-control" id="updated_at" name="updated_at"
                       value="<?php echo $page['updated_at']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="created_at" class="form-label">Created at</label>
                <input type="text" class="form-control" id="created_at" name="created_at"
                       value="<?php echo $page['created_at']; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Update page</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>
