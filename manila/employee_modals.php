<!-- ADD EMPLOYEE MODAL -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add Employee — Manila Branch</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <form method="POST" enctype="multipart/form-data" action="add_employee.php">
        <div class="modal-body bg-white text-dark">
          <div class="container-fluid">
            <div class="row">

              <!-- Profile Picture -->
              <div class="col-md-4 text-center">
                <img id="add_preview"
                     src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                     class="rounded-circle border border-3 mb-3"
                     style="width:160px;height:160px;object-fit:cover;">
                <input type="file" name="image" class="form-control mt-2" accept="image/*" onchange="addPreview(event)">
              </div>

              <!-- Form Fields -->
              <div class="col-md-8">

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Employee ID</label>
                  <input type="text" name="employee_id" class="form-control" placeholder="Enter Employee ID" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Full Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Full Name" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Job Position</label>
                  <input type="text" name="job_position" class="form-control" placeholder="Enter Job Position" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Work Schedule</label>
                  <input type="text" name="work_schedule" class="form-control" placeholder="e.g. 9am - 6pm" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Age</label>
                  <input type="number" name="age" class="form-control" placeholder="Enter Age" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Contact No.</label>
                  <input type="text" name="contact_no" class="form-control" placeholder="Enter Contact Number" required>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Branch</label>
                  <select name="secondary_branch" class="form-select" required>
                    <option value="Blumentritt">Blumentritt</option>
                    <option value="Recto">Recto</option>
                    <option value="Quiapo">Quiapo</option>
                    <option value="San Juan">San Juan</option>
                    <option value="Galas">Galas</option>
                    <option value="Dela Fuente">Dela Fuente</option>
                    <option value="Paco">Paco</option>
                    <option value="Pritil">Pritil</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-semibold text-dark">Status</label>
                  <select name="status" class="form-select" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer bg-white">
          <button type="submit" name="add_employee" class="btn btn-primary px-4">Add</button>
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Image Preview Script -->
<script>
function addPreview(event) {
  const reader = new FileReader();
  reader.onload = function() {
    document.getElementById('add_preview').src = reader.result;
  };
  reader.readAsDataURL(event.target.files[0]);
}
</script>




<!-- EDIT EMPLOYEE MODAL -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Edit Employee — Manila Branch</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form method="POST" enctype="multipart/form-data" action="update_employee.php">
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">

          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4 text-center">
                <img id="edit_preview"
                     src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                     class="rounded-circle border border-3 mb-3"
                     style="width:160px;height:160px;object-fit:cover;">
                <input type="file" name="image" class="form-control" accept="image/*" onchange="editPreview(event)">
              </div>

              <div class="col-md-8">
                <label class="text-dark fw-semibold">Employee ID</label>
                <input type="text" name="employee_id" id="edit_employee_id" class="form-control mb-2" required>

                <label class="text-dark fw-semibold">Full Name</label>
                <input type="text" name="name" id="edit_name" class="form-control mb-2" required>

                <label class="text-dark fw-semibold">Job Position</label>
                <input type="text" name="job_position" id="edit_job" class="form-control mb-2" required>

                <label class="text-dark fw-semibold">Work Schedule</label>
                <input type="text" name="work_schedule" id="edit_schedule" class="form-control mb-2" required>

                <label class="text-dark fw-semibold">Age</label>
                <input type="number" name="age" id="edit_age" class="form-control mb-2" required>

                <label class="text-dark fw-semibold">Contact No.</label>
                <input type="text" name="contact_no" id="edit_contact" class="form-control mb-2" required>

                <label class="text-dark fw-semibold">Branch</label>
                <select name="secondary_branch" id="edit_branch" class="form-select mb-2" required>
                  <option value="Blumentritt">Blumentritt</option>
                  <option value="Recto">Recto</option>
                  <option value="Quiapo">Quiapo</option>
                  <option value="San Juan">San Juan</option>
                  <option value="Galas">Galas</option>
                  <option value="Dela Fuente">Dela Fuente</option>
                  <option value="Paco">Paco</option>
                  <option value="Pritil">Pritil</option>
                </select>

                <label class="text-dark fw-semibold">Status</label>
                <select name="status" id="edit_status" class="form-select" required>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="update_employee" class="btn btn-primary px-4">Update</button>
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
