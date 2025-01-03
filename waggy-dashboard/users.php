<?php
session_start();
include "includes/header.php";
require_once 'model/User.php'; 
$user = new User();
$users = $user->getAllUsers();
$isSuperAdmin = $_SESSION['user_role'] === 'Superadmin';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
    html {
        overflow: scroll !important;
    
    }
    .table_pro_item
    {
        overflow-x: auto;
    }
    label{
        margin-left:10px;
        margin-right:10px;
    }
    </style>
   
</head>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800" style="color:#858796;">Users dashboard</h1>


        <div class="row">

            <div class="table_pro_item">
            <div class="pt-5 pb-3">
                <h2>Users Table</h2>
                <!-- Pagination Section -->
               
                <table class="responsive-table " id="myTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Birth Date</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                        <tr>
                            <td data-label="User ID"><?php echo $u['user_id']; ?></td>
                            <td data-label="First Name"><?php echo $u['user_first_name']; ?></td>
                            <td data-label="Last Name"><?php echo $u['user_last_name']; ?></td>
                            <td data-label="Email"><?php echo $u['user_email']; ?></td>
                            <td data-label="Gender"><?php echo $u['user_gender']; ?></td>
                            <td data-label="Birth Date"><?php echo $u['user_birth_of_date']; ?></td>
                            <td data-label="Phone Number"><?php echo $u['user_phone_number']; ?></td>
                            <td data-label="Address"><?php echo $u['user_address_line_one']; ?></td>
                            <td data-label="State"><?php echo $u['user_state']; ?></td>
                            <td data-label="Role"><?php echo $u['user_role']; ?></td>
                            <td data-label="Actions">
                                <div class="action-buttons">
                                    <button class="edit-btn"
                                        onclick="openEditModal(this, <?php echo $u['user_id']; ?>)">Edit</button>
                                    <form method="POST" action="process_user.php" style="display: inline;">
                                        <input type="hidden" name="deleteUserId" value="<?php echo $u['user_id']; ?>">
                                        <button class="delete-btn" type="button"
                                            onclick="confirmDelete(this)">Delete</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- /.container-fluid -->

        <!-- Edit Modal -->
        <!-- Edit Modal -->

        <div class="modal" id="editModal"
            style="display: none; justify-content: center; align-items: center; height: 100vh;">
            <div class="modal-content" style="width: 50%; text-align: center;">
                <button class="close-btn delete-btn" style="background:#db4f4f;" onclick="closeEditModal()">X</button>
                <h3>Edit User</h3>
                <form id="editForm" method="POST" action="process_user.php">
                    <input type="hidden" id="editUserId" name="editUserId">
                    <input type="hidden" id="role" name="role">

                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="editFirstName">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="editLastName">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="editEmail">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select id="gender" name="editGender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birthDate">Birth Date:</label>
                        <input type="date" id="birthDate" name="editBirthDate" max="<?= date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" id="phone" name="editPhone">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="editAddress">
                    </div>
                    <div class="form-group">
                        <label for="editState">State:</label>
                        <select id="editState" name="editState" required>
                            <option value="Active">Active</option>
                            <option value="Deactivate">Deactivate</option>
                        </select>
                    </div>

                    <?php if ($isSuperAdmin): // Check if logged-in user is Super Admin ?>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="editRole">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <?php endif; ?>

                    <button type="submit" class="edit-btn"
                        style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save</button>
                </form>
            </div>
        </div>



        <!-- Add User Modal -->
        





        <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php
// Display SweetAlert if there is a message in the session
if (isset($_SESSION['sweetalert'])): ?>
    <script>
    Swal.fire({
        icon: '<?= $_SESSION['sweetalert']['type']; ?>',
        title: '<?= $_SESSION['sweetalert']['type'] === 'success' ? 'Success' : 'Error'; ?>',
        text: '<?= $_SESSION['sweetalert']['message']; ?>',
        confirmButtonColor: '#000',
        iconColor: '<?= $_SESSION['sweetalert']['type'] === 'success' ? 'green' : 'red'; ?>'
    });
    </script>
    <?php
    unset($_SESSION['sweetalert']);
endif;
?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/modal.js"></script>
    <script>
    function confirmDelete(button) {
        const form = button.closest('form'); 
        const userId = form.querySelector('input[name="deleteUserId"]').value;

        Swal.fire({
            title: 'Are you sure?',
            text: "This coupon will be marked as deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#db4f4f',
            cancelButtonColor: '#000',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); 
            }
        });
    }

    function openAddModal() {
        document.getElementById("addModal").style.display = "flex";
    }

    function closeAddModal() {
        document.getElementById("addModal").style.display = "none";
    }

    function openEditModal(button, userId) {
    
    const row = button.closest('tr'); 
   

    document.getElementById('editUserId').value = userId;
    document.getElementById('firstName').value = row.cells[1].innerText; 
    document.getElementById('lastName').value = row.cells[2].innerText; 
    document.getElementById('email').value = row.cells[3].innerText; 
    document.getElementById('gender').value = row.cells[4].innerText.toLowerCase();
    document.getElementById('birthDate').value = row.cells[5].innerText; 
    document.getElementById('phone').value = row.cells[6].innerText; 
    document.getElementById('address').value = row.cells[7].innerText; 
    document.getElementById('editState').value = row.cells[8].innerText; 

    
    document.getElementById('role').value = row.cells[9].innerText; 

    
    document.getElementById('editModal').style.display = 'flex';
}






    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }
    </script>
      <!-- Bootstrap core JavaScript-->
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
      
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

       <!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
    let table = new DataTable('#myTable', {
// options
});
</script>

</body>

</html>