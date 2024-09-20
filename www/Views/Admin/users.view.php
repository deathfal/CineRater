<h1><?= $title ?></h1>

<a href="#" class="btn btn-primary" id="openModal" data-bs-toggle="modal" data-bs-target="#addUserModal">Add New
    <?= $entityName ?></a>

<div class="crud-table">
    <table class="crud-table__table">
        <thead>
            <tr>
                <?php foreach ($columns as $column): ?>
                    <th><?= $column ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $index => $user): ?>
                <tr>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= ucfirst($user->getRole()) ?></td>
                    <td class="actions">
                        <a href="#" class="btn edit-btn" data-id="<?= $user->getId() ?>"
                            data-email="<?= $user->getEmail() ?>" data-role="<?= $user->getRole() ?>">Edit</a>
                        <a href="#" class="btn delete-btn" data-id="<?= $user->getId() ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Modal Overlay Create user -->
<div class="modal-overlay" id="modalOverlay">
    <div class="modal" id="addUserModal">
        <div class="modal-header">
            <h5 class="modal-title">Add New <?= $entityName ?></h5>
            <button type="button" class="modal-close" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="addUserForm">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="role">Role</label>
                            <select id="role" name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="unverified">Unverified</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal-overlay" id="editUserModalOverlay">
    <div class="modal" id="editUserModal">
        <div class="modal-header">
            <h5 class="modal-title">Edit User</h5>
            <button type="button" class="modal-close" id="closeEditModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="editUserForm">
                <input type="hidden" id="editUserId" name="id">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="editEmail">Email</label>
                            <input type="email" id="editEmail" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="editRole">Role</label>
                            <select id="editRole" name="role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="unverified">unverified</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>