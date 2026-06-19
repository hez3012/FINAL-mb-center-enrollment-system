@extends('admin.layouts.app')
@section('title', 'Add New Guardian')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Add New Guardian</h5>
    <a href="{{ route('admin.guardians.index') }}" class="btn btn-sm btn-outline-secondary">
        <i data-lucide="arrow-left" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Back
    </a>
</div>

<div class="alert alert-info small">
    <i data-lucide="info" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
    Only user accounts with the <strong>Guardian</strong> role that don't have a profile yet are shown below.
    If the list is empty, create a Guardian user account first via
    <a href="{{ route('admin.users.create') }}" class="alert-link">User Management</a>.
</div>

<div class="card border-0 shadow" style="border-radius: 18px; background: linear-gradient(135deg, #fffef5 0%, #f4ffef 100%);">
    <div class="card-body p-4 p-lg-5">
        <form method="POST" action="{{ route('admin.guardians.store') }}">
            @csrf

            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: rgba(255,255,255,0.7); border-color: rgba(34,197,94,0.2) !important;">
                <p class="fw-semibold text-success small mb-3 d-flex align-items-center gap-2">
                    <i data-lucide="heart-handshake" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Guardian Information
                </p>
                <div class="row g-3 mb-0">
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Linked User Account</label>
                    <select name="user_id"
                            class="form-select @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Select Guardian User Account --</option>
                        @foreach($availableUsers as $user)
                            <option value="{{ $user->user_id }}"
                                    {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                {{ $user->username }} — {{ $user->email }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">First Name</label>
                    <input type="text" name="first_name"
                           class="form-control @error('first_name') is-invalid @enderror"
                           value="{{ old('first_name') }}" required>
                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Last Name</label>
                    <input type="text" name="last_name"
                           class="form-control @error('last_name') is-invalid @enderror"
                           value="{{ old('last_name') }}" required>
                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Contact Number</label>
                    <input type="text" name="contact_number"
                           class="form-control @error('contact_number') is-invalid @enderror"
                           value="{{ old('contact_number') }}" required>
                    @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Relationship to Student</label>
                    <select name="relationship"
                            class="form-select @error('relationship') is-invalid @enderror" required>
                        <option value="">-- Select --</option>
                        @foreach(['Mother', 'Father', 'Grandparent', 'Aunt/Uncle', 'Sibling', 'Legal Guardian', 'Other'] as $rel)
                            <option value="{{ $rel }}"
                                    {{ old('relationship') == $rel ? 'selected' : '' }}>
                                {{ $rel }}
                            </option>
                        @endforeach
                    </select>
                    @error('relationship')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" rows="2"
                              class="form-control @error('address') is-invalid @enderror"
                              required>{{ old('address') }}</textarea>
                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success px-4">
                    <i data-lucide="user-plus" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Create Guardian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection