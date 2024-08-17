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
                                <option value="special">SPECIAL</option>
                                <!-- Add other user types as needed -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="case_court" class="form-label">Case Court:</label>
                            <input type="text" class="form-control" id="case_court" placeholder="Enter Case Court"
                                name="case_court" required>
                        </div>
                        <div class="mb-3">
                            <label for="case_judge" class="form-label">Case Judge:</label>
                            <input type="text" class="form-control" id="case_judge" placeholder="Enter Case Judge"
                                name="case_judge" required>
                        </div>
                        <template x-if="caseType === 'civil'">
                            <div class="mb-3">
                                <label for="requirements" class="form-label">Case Requirements:</label>

                                @foreach ($civilRequirements as $civilRequirement)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check{{ $loop->index }}"
                                            name="case_requirement[]" value="{{ $civilRequirement->requirement_name }}">
                                        <label class="form-check-label"
                                            for="check{{ $loop->index }}">{{ $civilRequirement->requirement_name }}</label>
                                    </div>
                                @endforeach

                            </div>
                        </template>

                        <template x-if="caseType === 'criminal'">
                            <div class="mb-3">
                                <label for="requirements" class="form-label">Case Requirements:</label>

                                @foreach ($criminalRequirements as $criminalRequirement)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check{{ $loop->index }}"
                                            name="case_requirement[]" value="{{ $criminalRequirement->requirement_name }}">
                                        <label class="form-check-label"
                                            for="check{{ $loop->index }}">{{ $criminalRequirement->requirement_name }}</label>
                                    </div>
                                @endforeach

                            </div>
                        </template>

                        <template x-if="caseType === 'special'">
                            <div class="mb-3">
                                <label for="requirements" class="form-label">Case Requirements:</label>

                                @foreach ($specialRequirements as $specialRequirement)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="check{{ $loop->index }}"
                                            name="case_requirement[]" value="{{ $specialRequirement->requirement_name }}">
                                        <label class="form-check-label"
                                            for="check{{ $loop->index }}">{{ $specialRequirement->requirement_name }}</label>
                                    </div>
                                @endforeach

                            </div>
                        </template>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
