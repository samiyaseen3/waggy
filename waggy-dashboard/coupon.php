<?php
include("includes/header.php");
require_once 'model/Coupon.php';

$couponModel = new Coupon();
$coupons = $couponModel->getAllCoupons();
$couponData = null;
if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];
    $couponData = $couponModel->getCouponById($editId); // Make sure to create this method
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Coupon dashboard</h1>

    <div class="row">
        <div>
            <button type="button" style="background:#000;" class="button1" onclick="openAddModal()">
                <span class="button__text">Add Coupon</span>
                <span class="button__icon" style="background:#000;"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"
                        stroke="currentColor" height="24" fill="none" class="svg">
                        <line y2="19" y1="5" x2="12" x1="12"></line>
                        <line y2="12" y1="12" x2="19" x1="5"></line>
                    </svg></span>
            </button>
        </div>
        <div class="pt-5 pb-3" style="margin-right:300px">
            <h2>Coupon Table</h2>
            <table class="responsive-table">
                <thead>
                    <tr>
                        <th>Coupon Id</th>
                        <th>Coupon Discount</th>
                        <th>Deadline</th>
                        <th>Validity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($coupons as $coupon): ?>
                    <tr>
                        <td><?= htmlspecialchars($coupon['coupon_id']); ?></td>
                        <td><?= htmlspecialchars($coupon['coupon_discount']); ?></td>
                        <td><?= htmlspecialchars($coupon['coupon_expiry_date']); ?></td>
                        <td><?= htmlspecialchars($coupon['coupon_status']); ?></td>
                        <td data-label="Actions">
                            <div class="action-buttons">
                                <button class="edit-btn" onclick="openEditModal(this)">Edit</button>
                                <form method="POST" action="process_coupon.php" style="display:inline;">
                                    <input type="hidden" name="action" value="delete_coupon">
                                    <input type="hidden" name="coupon_id"
                                        value="<?= htmlspecialchars($coupon['coupon_id']); ?>">
                                    <button class="delete-btn" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this coupon?');">Delete</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Modal, Edit Modal, Footer, and Scripts here -->
</div> <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper --
    <!-- Edit Modal -->
<div id="editModal" class="modal" style="display: none; justify-content: center; align-items: center; height: 100vh;">
    <div class="modal-content" style="width: 50%; text-align: center;">
        <button class="close-btn" style="background:#db4f4f;" onclick="closeEditModal()">X</button>
        <h2>Edit Coupon</h2>
        <form id="editForm" action="process_coupon.php" method="POST">
            <input type="hidden" name="action" value="edit_coupon">
            <input type="hidden" id="editCouponId" name="coupon_id" required>
            <div class="form-group">
                <label for="editDiscount">Coupon Discount:</label>
                <input type="text" id="editDiscount" name="coupon_discount" required><br><br>
            </div>
            <div class="form-group">
                <label for="editExpiryDate">Deadline:</label>
                <input type="date" id="editExpiryDate" name="coupon_expiry_date" required> <br><br>
            </div>
            <div class="form-group">
                <label for="editStatus">Validity:</label>
                <select id="editStatus" name="coupon_status">
                    <option value="Valid">Valid</option>
                    <option value="Invalid">Invalid</option>
                </select><br><br>
            </div>
            <button class="save-btn" type="submit"
                style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save</button>
        </form>
    </div>
</div>



<!-- Add Modal -->
<div id="addModal" class="modal" style="display: none; justify-content: center; align-items: center; height: 100vh;">
    <div class="modal-content" style="width: 50%; text-align: center;">
        <button class="close-btn" style="background:#db4f4f;" onclick="closeAddModal()">X</button>
        <h2>Add Coupon</h2>
        <form id="addForm" action="process_coupon.php" method="POST">
            <input type="hidden" name="action" value="add_coupon">
            <div class="form-group">
                <label for="coupon_discount">Coupon Discount:</label>
                <input type="text" id="coupon_discount" name="coupon_discount" required><!-- Changed here -->
            </div>
            <div class="form-group">
                <label for="coupon_expiry_date">Deadline:</label>
                <input type="date" id="coupon_expiry_date" name="coupon_expiry_date" required><!-- Changed here -->
            </div>
            <div class="form-group">
                <label for="coupon_status">Validity:</label>
                <select id="coupon_status" name="coupon_status" required>
                    <!-- Changed here -->
                    <option value="Valid">Valid</option>
                    <option value="Invalid">Invalid</option>
                </select>
            </div>
            <button class="save-btn" type="submit"
                style="background-color: #000; color: white; padding: 10px; border: none; cursor: pointer; width: 100px; margin-top: 20px;">Save
            </button>
        </form>

    </div>
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->






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


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/modal.js"></script>
<script>
function openEditModal(button) {
    const row = button.closest('tr');
    const id = row.cells[0].innerText; // Assuming coupon_id is in the first column
    const discount = row.cells[1].innerText;
    const expiryDate = row.cells[2].innerText;
    const status = row.cells[3].innerText;

    document.getElementById('editCouponId').value = id;
    document.getElementById('editDiscount').value = discount;
    document.getElementById('editExpiryDate').value = expiryDate;
    document.getElementById('editStatus').value = status;

    document.getElementById('editModal').style.display = 'flex';
}
</script>



</body>

</html>