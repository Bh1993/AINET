<div>
    <a class="btn btn-primary" href="users-add.php">Add user</a>
    <div class="pull-right">  
       <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Order By
                <span class="caret">
            </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#">Email</a></li>
            <li><a href="#">Fullname</a></li>
            <li><a href="#">Regist Date</a></li>
            <li><a href="#">Type</a></li>
        </ul>
        </div>
       
    </div>
</div>

<?php if (count($users)) {
    ?>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>
            <th>Registered At</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) {
    ?>
        <tr>
            <td><a href="partials-admin_list.view.php?user_id=<?= (int) $user->user_id ?>"><?= escape($user->email) ?></a></td>
            <td><?= escape($user->fullname) ?></td>
            <td><?= escape($user->registered_at) ?></td>
            <td><?= $user->typeToStr() ?></td>

            <td>
                <a
                    href="users-edit.php?user_id=<?= (int) $user->user_id ?>"
                    class="btn btn-xs btn-primary">Edit</a>

                <form action="users-delete.php" method="post" class="inline">
                    <input type="hidden"
                        name="user_id"
                        value="<?= (int) $user->user_id ?>">
                    <button
                        type="submit"
                        class="btn btn-xs btn-danger">Delete</button>
                </form>

            </td>
        </tr>
    <?php

}
    ?>
    </table>
    <div>
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>

<?php

} else {
    ?>
    <h2>No users found</h2>
<?php

} ?>
