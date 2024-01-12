<?php
$title = 'Category edit';
ob_start();
?>

<div class="row justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <h1 class="text-center mb-4">Category edit</h1>
        <form method="post" action="<?= APP_BASE_PATH ?>/todo/categories/update">
            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                       value="<?php echo $category['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"
                          required><?php echo $category['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="visible" class="form-label">Visible</label>
                <input type="checkbox" class="form-check-input" id="visible" name="visible"
                    <?php echo $category['visible'] ? 'checked': ''; ?>>
            </div>
            <button type="submit" class="btn btn-primary">Update category</button>
        </form>
    </div>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout.php';
?>
