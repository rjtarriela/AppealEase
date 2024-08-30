<button class="btn btn-outline-success edit-btn" data-case_requirement="{{ $case->case_requirement }}" data-id="{{ $case->id }}" data-case_type="{{ $case->case_type }}" data-bs-toggle="modal" data-bs-target="#editJudgeTableModal">
    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill="#00B300"
            d="M14.828 2.828a3 3 0 0 1 4.243 4.243L8.243 18.828a1 1 0 0 1-.474.263l-5 1a1 1 0 0 1-1.213-1.213l1-5a1 0 0 1 .263-.474l10.828-10.828zM4.828 18.828L14 9.656l-2-2L2.828 16.828a1 0 0 0-.263.474l-1 5 5-1a1 1 0 0 0 .474-.263zM20 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
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
                
                        @if($case->case_type === 'civil')
                            @foreach ($civilRequirements as $civilRequirement)
                                <div class="form-check" style="display: flex; justify-content: center">
                                    <input class="form-check-input mr-1" type="checkbox" id="checkCivil{{ $loop->index }}"
                                        name="case_requirement[]" value="{{ $civilRequirement->requirement_name }}">
                                    <label class="form-check-label"
                                        for="checkCivil{{ $loop->index }}">{{ $civilRequirement->requirement_name }}</label>
                                </div>
                            @endforeach

                        @elseif($case->case_type === 'criminal')
                            @foreach ($criminalRequirements as $criminalRequirement)
                                <div class="form-check" style="display: flex; justify-content: center">
                                    <input class="form-check-input" type="checkbox" id="checkCriminal{{ $loop->index }}"
                                        name="case_requirement[]" value="{{ $criminalRequirement->requirement_name }}">
                                    <label class="form-check-label"
                                        for="checkCriminal{{ $loop->index }}">{{ $criminalRequirement->requirement_name }}</label>
                                </div>
                            @endforeach

                        @elseif($case->case_type === 'special')
                            @foreach ($specialRequirements as $specialRequirement)
                                <div class="form-check" style="display: flex; justify-content: center">
                                    <input class="form-check-input" type="checkbox" id="checkSpecial{{ $loop->index }}"
                                        name="case_requirement[]" value="{{ $specialRequirement->requirement_name }}">
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
