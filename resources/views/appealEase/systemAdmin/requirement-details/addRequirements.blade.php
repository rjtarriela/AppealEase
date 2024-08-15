{{-- MODAL FOR ADD BUTTON --}}

<button type="button" class="btn btn-success btn-large" data-bs-toggle="modal" data-bs-target="#requirementModal">
    + Add Requirement
</button>

<!-- The Modal -->
<div class="modal" id="requirementModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Requirement</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/requirement-details/submit" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="requirement_name" class="form-label">Requirement Name:</label>
                        <input type="text" class="form-control" id="requirement_name"
                            placeholder="Enter Requirement Name" name="requirement_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <input type="text" class="form-control" id="description" placeholder="Enter Description"
                            name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="case_type" class="form-label">Case Type:</label>
                        <select x-model="case_type" id="case_type" name="case_type"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                            required>
                            <option value="" disabled selected>Select Case Type</option>
                            <option value="civil">CIVIL</option>
                            <option value="criminal">CRIMINAL</option>
                            <option value="special">SPECIAL</option>
                            <!-- Add other user types as needed -->
                        </select>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
