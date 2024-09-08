<button class="btn btn-outline-primary edit-btn" data-case_requirement="{{ $case->case_requirement }}"
    data-id="{{ $case->id }}" data-case_type="{{ $case->case_type }}" data-bs-toggle="modal"
    data-bs-target="#editJudgeTableModal">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15" fill="blue">
        <path
            d="M3 21v-3.75L14.81 5.44a1.5 1.5 0 0 1 2.12 0l2.83 2.83a1.5 1.5 0 0 1 0 2.12L8 20.25H3zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.64 1.64 3.75 3.75 1.64-1.64z" />
    </svg>
</button>


{{-- EDIT MODAL FROM THE TABLE --}}
<div class="modal fade" id="editJudgeTableModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel">Edit Requirements</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                <form id="editForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-3">
                        <label for="requirements" class="form-label">Case Requirements:</label>

                        @if ($case->case_type === 'civil')
                            @foreach ($civilRequirements as $civilRequirement)
                                <div class="form-check" style="display: flex; justify-content: center">
                                    <input class="form-check-input mr-1" type="checkbox"
                                        id="checkCivil{{ $loop->index }}" name="case_requirement[]"
                                        value="{{ $civilRequirement->requirement_name }}">
                                    <label class="form-check-label"
                                        for="checkCivil{{ $loop->index }}">{{ $civilRequirement->requirement_name }}</label>
                                </div>
                            @endforeach
                        @elseif($case->case_type === 'criminal')
                            @foreach ($criminalRequirements as $criminalRequirement)
                                <div class="form-check" style="display: flex; justify-content: center">
                                    <input class="form-check-input" type="checkbox"
                                        id="checkCriminal{{ $loop->index }}" name="case_requirement[]"
                                        value="{{ $criminalRequirement->requirement_name }}">
                                    <label class="form-check-label"
                                        for="checkCriminal{{ $loop->index }}">{{ $criminalRequirement->requirement_name }}</label>
                                </div>
                            @endforeach
                        @elseif($case->case_type === 'special')
                            @foreach ($specialRequirements as $specialRequirement)
                                <div class="form-check" style="display: flex; justify-content: center">
                                    <input class="form-check-input" type="checkbox"
                                        id="checkSpecial{{ $loop->index }}" name="case_requirement[]"
                                        value="{{ $specialRequirement->requirement_name }}">
                                    <label class="form-check-label"
                                        for="checkSpecial{{ $loop->index }}">{{ $specialRequirement->requirement_name }}</label>
                                </div>
                            @endforeach

                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
