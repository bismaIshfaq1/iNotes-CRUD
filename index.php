<?php
include 'partials/db_connect.php';
include 'partials/header.php';
?>

<div class="container my-4">
    <h2>Add Notes</h2>
    <form action="create_note.php" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Note Description</label>
            <textarea class="form-control" id="desc" name="desc" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
</div>

<div class="container my-4">
    <h2>All Notes</h2>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">S.no</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $sql = "SELECT * FROM notess";
    $result = mysqli_query($conn, $sql);
    $sno = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $sno++;
        echo "<tr>
            <td>$sno</td>
            <td>{$row['title']}</td>
            <td>{$row['des']}</td>
            <td>
                <a href='#' 
                   class='btn btn-primary btn-sm edit' 
                   data-id='{$row['id']}' 
                   data-title='{$row['title']}' 
                   data-desc='{$row['des']}' 
                   data-bs-toggle='modal' 
                   data-bs-target='#editModal'>
                   Edit
                </a>
                <form action='delete_note.php' method='post' style='display:inline-block;'>
                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                </form>
            </td>
        </tr>";
    }
    ?>
</tbody>

    </table>
</div>
<script>
document.querySelectorAll('.edit').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');
        const desc = this.getAttribute('data-desc');

        // Populate modal fields
        document.getElementById('noteId').value = id;
        document.getElementById('titleEdit').value = title;
        document.getElementById('descEdit').value = desc;
    });
});
</script>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit this Note</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="edit_note.php" method="post">
                    <input type="hidden" id="noteId" name="noteId"> 
                    <div class="mb-3 my-3">
                        <label for="title" class="form-label">Note Title</label>
                        <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="desc">Note Description</label>
                        <textarea class="form-control" placeholder="Leave a comment here" id="descEdit" name="descEdit"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<?php include 'partials/footer.php'; ?>
