{{-- MODAL FOR ADD BUTTON --}}
<button type="button" class="btn btn-success btn-large" data-bs-toggle="modal" data-bs-target="#caseModal">
    + Add Case
</button>

<!-- The Modal -->
<div class="modal" id="caseModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Case</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div x-data="{ caseType: '' }">
                    <form action="/dashboard/camis/submit" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="case_number" class="form-label">Case Number:</label>
                            <input type="number" class="form-control" id="case_number" placeholder="Enter Case Number"
                                name="case_number" required>
                        </div>
                        <div class="mb-3">
                            <x-label for="case_type" class="form-label">Case Type:</x-label>
                            <select x-model="caseType" id="case_type" name="case_type"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                                required>
                                <option value="" disabled selected>Select Case Type</option>
                                <option value="civil">CIVIL</option>
                                <option value="criminal">CRIMINAL</option>
                                <option value="special">ADMINISTRATIVE</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="case_court" class="form-label">Lower Court:</label>
                            <input type="text" class="form-control" id="case_court" placeholder="Enter Case Court"
                                name="case_court" required>
                        </div>
                        <div class="mb-3">
                            <label for="case_judge" class="form-label">Case Judge:</label>
                            <input type="text" class="form-control" id="case_judge" placeholder="Enter Case Judge"
                                name="case_judge" required>
                        </div>
                        <template x-if="caseType === 'civil'">
                            <div>
                                <div class="mb-3">
                                    <label for="pleading" class="form-label">Pleading:</label>
                                    <input type="file" class="form-control" id="pleading" name="pleading[]" multiple
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="evidences" class="form-label">Evidences:</label>
                                    <input type="file" class="form-control" id="evidences" name="evidences[]"
                                        multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="verification" class="form-label">Verification:</label>
                                    <input type="file" class="form-control" id="verification" name="verification[]"
                                        multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="certificate" class="form-label">Certificate of Non-Forum
                                        Shopping:</label>
                                    <input type="file" class="form-control" id="certificate" name="certificate[]"
                                        multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="judicial_affidavit" class="form-label">Judicial Affidavit:</label>
                                    <input type="file" class="form-control" id="judicial_affidavit" name="judicial_affidavit[]"
                                        multiple required>
                                </div>
                            </div>

                        </template>
                        <template x-if="caseType === 'criminal'">
                            <div>
                                <div class="mb-3">
                                    <label for="evidences" class="form-label">Evidences:</label>
                                    <input type="file" class="form-control" id="evidences" name="evidences[]"
                                        multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="judicial_affidavit" class="form-label">Judicial Affidavit:</label>
                                    <input type="file" class="form-control" id="judicial_affidavit" name="judicial_affidavit[]"
                                        multiple required>
                                </div>
                            </div>

                        </template>
                        <template x-if="caseType === 'special'">
                            <div>
                                <div class="mb-3">
                                    <label for="notice_of_appeal" class="form-label">Notice of Appeal:</label>
                                    <input type="file" class="form-control" id="notice_of_appeal" name="notice_of_appeal[]"
                                        multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="documents" class="form-label">Documents from RTC/MTC:</label>
                                    <input type="file" class="form-control" id="documents" name="documents[]"
                                        multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="memoranda" class="form-label">Memoranda:</label>
                                    <input type="file" class="form-control" id="memoranda" name="memoranda[]"
                                        multiple required>
                                </div>
                            </div>

                        </template>


                        <div class="mb-3">
                            <label for="other_files" class="form-label">Other File/s (Optional):</label>
                            <input type="file" class="form-control" id="other_files" name="other_files[]" multiple>
                        </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="return confirmSubmit()">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
