<?php

$title = 'Categories list';
ob_start();
?>

    <h1>Categories list</h1>
    <a href="<?= APP_BASE_PATH ?>/todo/categories/create" class="btn btn-outline-success">Create category</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">IsVisuble</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <th scope="row"><?php echo $category['id']; ?></th>
                <td><?php echo $category['title']; ?></td>
<!--                <td>--><?php //echo $category['visible'] == 1 ? 'Yes' : 'No'; ?><!--</td>-->
                <td><?php echo $category['visible']; ?></td>
                <td><?php echo $category['description']; ?></td>
                <td>
                    <a href="<?= APP_BASE_PATH ?>/todo/categories/edit/<?php echo $category['id']; ?>" class="btn btn-outline-primary">Edit</a>
                </td>
                <td>
                    <form method="post"
                          action="<?= APP_BASE_PATH ?>/todo/categories/delete/<?php echo $category['id']; ?>"
                          class="d-inline-block">
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php $content = ob_get_clean();

include 'app/views/layout.php';
?>