<ul class="nav nav-tabs justify-content-around" role="tablist">
    <li class="nav-item flex-grow-1 text-center">
        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Civil Cases</a>
    </li>
    <li class="nav-item flex-grow-1 text-center">
        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Criminal Cases</a>
    </li>
    <li class="nav-item flex-grow-1 text-center">
        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Special Cases</a>
    </li>
</ul>
<!-- Tab panes -->
{{-- Civil --}}
<div class="tab-content">
    <div class="tab-pane active" id="tabs-1" role="tabpanel">
        <div class="card mb-4">
            <div class="card-body">
                <table id="civilTable" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Requirements ID Number</th>
                            <th>Requirements Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($civilRequirements->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No records of civil requirements</td>
                            </tr>
                        @else
                            @foreach ($civilRequirements as $civilRequirement)
                                <tr class="text-center">
                                    <td class="align-content-center">{{ $civilRequirement->id }}</td>
                                    <td class="align-content-center">{{ $civilRequirement->requirement_name }}</td>
                                    <td class="align-content-center">{{ $civilRequirement->description }}</td>
                                    <td class="align-content-center">
                                        <!-- Action buttons -->
                                        {{-- edit --}}
                                        <button class="btn btn-outline-success edit-btn"
                                            data-id="{{ $civilRequirement->id }}"
                                            data-requirement_name="{{ $civilRequirement->requirement_name }}"
                                            data-description="{{ $civilRequirement->description }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#00B300"
                                                    d="M14.828 2.828a3 3 0 0 1 4.243 4.243L8.243 18.828a1 1 0 0 1-.474.263l-5 1a1 1 0 0 1-1.213-1.213l1-5a1 1 0 0 1 .263-.474l10.828-10.828zM4.828 18.828L14 9.656l-2-2L2.828 16.828a1 1 0 0 0-.263.474l-1 5 5-1a1 1 0 0 0 .474-.263zM20 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </button>
                                        {{-- delete --}}
                                        <form action="{{ url('/requirement-details/' . $civilRequirement->id) }}" method="POST"
                                            style="display:inline;">
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
    </div>
    <div class="tab-pane" id="tabs-2" role="tabpanel">
        <div class="card mb-4">
            <div class="card-body">
                <table id="criminalTable" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Requirements ID Number</th>
                            <th>Requirements Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($criminalRequirements->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No records of criminal requirements</td>
                            </tr>
                        @else
                            @foreach ($criminalRequirements as $criminalRequirement)
                                <tr class="text-center">
                                    <td class="align-content-center">{{ $criminalRequirement->id }}</td>
                                    <td class="align-content-center">{{ $criminalRequirement->requirement_name }}</td>
                                    <td class="align-content-center">{{ $criminalRequirement->description }}</td>
                                    <td class="align-content-center">
                                        <!-- Action buttons -->
                                        {{-- edit --}}
                                        <button class="btn btn-outline-success edit-btn"
                                            data-id="{{ $criminalRequirement->id }}"
                                            data-requirement_name="{{ $criminalRequirement->requirement_name }}"
                                            data-description="{{ $criminalRequirement->description }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#00B300"
                                                    d="M14.828 2.828a3 3 0 0 1 4.243 4.243L8.243 18.828a1 1 0 0 1-.474.263l-5 1a1 1 0 0 1-1.213-1.213l1-5a1 1 0 0 1 .263-.474l10.828-10.828zM4.828 18.828L14 9.656l-2-2L2.828 16.828a1 1 0 0 0-.263.474l-1 5 5-1a1 1 0 0 0 .474-.263zM20 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </button>
                                        {{-- delete --}}
                                        <form action="{{ url('/requirement-details/' . $criminalRequirement->id) }}" method="POST"
                                            style="display:inline;">
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
    </div>
    <div class="tab-pane" id="tabs-3" role="tabpanel">
        <div class="card mb-4">
            <div class="card-body">
                <table id="specialTable" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Requirements ID Number</th>
                            <th>Requirements Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($specialRequirements->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No records of special requirements</td>
                            </tr>
                        @else
                            @foreach ($specialRequirements as $specialRequirement)
                                <tr class="text-center">
                                    <td class="align-content-center">{{ $specialRequirement->id }}</td>
                                    <td class="align-content-center">{{ $specialRequirement->requirement_name }}</td>
                                    <td class="align-content-center">{{ $specialRequirement->description }}</td>
                                    <td class="align-content-center">
                                        <!-- Action buttons -->
                                        {{-- edit --}}
                                        <button class="btn btn-outline-success edit-btn"
                                            data-id="{{ $specialRequirement->id }}"
                                            data-requirement_name="{{ $specialRequirement->requirement_name }}"
                                            data-description="{{ $specialRequirement->description }}">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill="#00B300"
                                                    d="M14.828 2.828a3 3 0 0 1 4.243 4.243L8.243 18.828a1 1 0 0 1-.474.263l-5 1a1 1 0 0 1-1.213-1.213l1-5a1 1 0 0 1 .263-.474l10.828-10.828zM4.828 18.828L14 9.656l-2-2L2.828 16.828a1 1 0 0 0-.263.474l-1 5 5-1a1 1 0 0 0 .474-.263zM20 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg>
                                        </button>
                                        {{-- delete --}}
                                        <form action="{{ url('/requirement-details/' . $specialRequirement->id) }}" method="POST"
                                            style="display:inline;">
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
    </div>
</div>
