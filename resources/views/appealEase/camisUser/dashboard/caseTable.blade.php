<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        Existing Case
    </div>
    <div class="card-body">
        <table id="caseTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>Case Number</th>
                    <th>Case Type</th>
                    <th>Case Court</th>
                    <th>Case Judge</th>
                    <th>Case Requirements</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($cases->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No records of cases</td>
                    </tr>
                @else
                    @foreach ($cases as $case)
                        <tr class="text-center">
                            <td class="align-content-center">{{ $case->case_number }}</td>
                            {{-- <td class="align-content-center">{{ $case->case_type }}</td> --}}
                            {{-- first letter capital --}}
                            <td class="align-content-center">{{ ucfirst($case->case_type) }}</td>
                            <td class="align-content-center">{{ $case->case_court }}</td>
                            <td class="align-content-center">{{ $case->case_judge }}</td>
                            <td class="align-content-center">
                                @php
                                    $requirements = json_decode($case->case_requirement, true);
                                @endphp
                                @if (!empty($requirements))
                                        @foreach ($requirements as $requirement)
                                            <p style="margin-top: 16px">{{ $requirement }}</p>
                                        @endforeach
                                @else
                                    No requirements
                                @endif
                            </td>
                            <td class="align-content-center">
                                <!-- Action buttons -->
                                {{-- Send Button - No function yet --}}
                                <button class="btn btn-outline-success edit-btn" data-id="{{ $case->id }}"
                                    data-division="{{ $case->division }}" data-name="{{ $case->name }}"
                                    data-email="{{ $case->email }}" data-contact="{{ $case->contact_number }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 100 100">
                                        <path d="M20 20 L80 50 L20 80 Z" fill="none" stroke="green" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                                      </svg>
                                </button>
                                <form action="{{ url('/dashboard/camis/' . $case->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill="#FF0000"
                                                d="M9 3V4H4V6H20V4H15V3H9zM7 6V20C7 21.1046 7.89543 22 9 22H15C16.1046 22 17 21.1046 17 20V6H7zM9 8H11V19H9V8zM13 8H15V19H13V8z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
