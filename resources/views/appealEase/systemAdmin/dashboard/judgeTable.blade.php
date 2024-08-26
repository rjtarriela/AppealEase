<div class="card mb-4">
    <div class="card-header" style="display: flex; align-items: center;">
        <svg class="svg-inline--fa fa-table me-1" width="16" height="16" aria-hidden="true" focusable="false"
            data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            data-fa-i2svg="">
            <path fill="currentColor"
                d="M64 256V160H224v96H64zm0 64H224v96H64V320zm224 96V320H448v96H288zM448 256H288V160H448v96zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z">
            </path>
        </svg>
        Existing Judges
    </div>
    <div class="card-body">
        <table id="judgesTable" class="table">
            <thead>
                <tr class="text-center">
                    <th>ID Number</th>
                    <th>Division</th>
                    <th>Judge Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Criminal Case Solved</th>
                    <th>Civil Case Solved</th>
                    <th>Special Case Solved</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($judges->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">No records of judges</td>
                    </tr>
                @else
                    @foreach ($judges as $judge)
                        <tr class="text-center">
                            <td class="align-content-center">{{ $judge->id }}</td>
                            <td class="align-content-center">{{ $judge->division }}</td>
                            <td class="align-content-center">{{ $judge->name }}</td>
                            <td class="align-content-center">{{ $judge->email }}</td>
                            <td class="align-content-center">{{ $judge->contact_number }}</td>
                            <td class="align-content-center">{{ $judge->criminal_cases_solved }}</td>
                            <td class="align-content-center">{{ $judge->civil_cases_solved }}</td>
                            <td class="align-content-center">{{ $judge->special_cases_solved }}</td>
                            <td class="align-content-center">
                                <!-- Action buttons -->
                                {{-- add controller --}}
                                    <div class="btn-group">
                                        <button class="btn btn-outline-success edit-btn" data-id="{{ $judge->id }}"
                                            data-division="{{ $judge->division }}" data-name="{{ $judge->name }}"
                                            data-email="{{ $judge->email }}"
                                            data-contact="{{ $judge->contact_number }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#00B300"
                                                    d="M14.828 2.828a3 3 0 0 1 4.243 4.243L8.243 18.828a1 1 0 0 1-.474.263l-5 1a1 1 0 0 1-1.213-1.213l1-5a1 1 0 0 1 .263-.474l10.828-10.828zM4.828 18.828L14 9.656l-2-2L2.828 16.828a1 1 0 0 0-.263.474l-1 5 5-1a1 1 0 0 0 .474-.263zM20 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </button>

                                        @include('appealEase.systemAdmin.dashboard.viewButton')
                                        
                                        <form action="{{ url('/dashboard/' . $judge->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" style=" border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill="#721c24"
                                                        d="M9 3V4H4V6H20V4H15V3H9zM7 6V20C7 21.1046 7.89543 22 9 22H15C16.1046 22 17 21.1046 17 20V6H7zM9 8H11V19H9V8zM13 8H15V19H13V8z" />
                                                </svg>
                                            </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
