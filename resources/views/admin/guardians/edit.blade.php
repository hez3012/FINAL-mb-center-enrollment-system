@extends('admin.layouts.app')
@section('title', 'Edit Guardian')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="fw-bold mb-0">Edit Guardian</h5>
    <a href="{{ route('admin.guardians.index') }}" class="btn-act btn-act-view" style="text-decoration:none;"><i data-lucide="arrow-left" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Back
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i data-lucide="check-circle" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card border-0 shadow" style="border-radius: 14px; background: #fff;">
    <div class="card-body p-4 p-lg-5">

        {{-- Profile picture display (non-editable) --}}
        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 mb-4 p-3 p-md-4 border rounded-4" style="background: #f9f7f3; border-color: #e8e3d8;">
            <div class="flex-shrink-0">
                @include('partials.avatar', [
                    'name'  => optional($guardian->user)->list_name ?? '?',
                    'image' => optional($guardian->user)->profile_picture ?? null,
                    'size'  => 64,
                ])
            </div>
            <div>
                <div class="fw-semibold text-success">{{ optional($guardian->user)->list_name }}</div>
                <small class="text-muted d-block mt-1">
                    Profile picture can be changed via
                    <a href="{{ route('admin.users.edit', $guardian->user->user_id) }}" class="fw-semibold">
                        User Management
                    </a>.
                </small>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.guardians.update',$guardian->guardian_id) }}">
            @csrf
            @method('PUT')

            <div class="border rounded-4 p-3 p-md-4 mb-4" style="background: #fff; border-color: #e8e3d8;">
                <p class="fw-semibold small mb-3 d-flex align-items-center gap-2" style="color:#1B4332;">
                    <i data-lucide="heart-handshake" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Guardian Information
                </p>
                <div class="row g-3 mb-0">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Relationship to Student <span class="text-danger">*</span>
                        </label>
                        <select name="relationship"
                                class="form-select @error('relationship') is-invalid @enderror"
                                required>
                            <option value="">-- Select --</option>
                            @foreach(['Mother','Father','Grandparent','Aunt/Uncle','Sibling','Legal Guardian','Other'] as $rel)
                                <option value="{{ $rel }}"
                                        {{ old('relationship',$guardian->relationship) == $rel ? 'selected' : '' }}>
                                    {{ $rel }}
                                </option>
                            @endforeach
                        </select>
                        @error('relationship')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Contact #1 <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="contact_number_1"
                               class="form-control @error('contact_number_1') is-invalid @enderror"
                               value="{{ old('contact_number_1', optional($guardian->user)->contact_number_1) }}"
                               required>
                        @error('contact_number_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Contact #2 <span class="text-muted small fw-normal">(optional)</span>
                        </label>
                        <input type="text" name="contact_number_2"
                               class="form-control @error('contact_number_2') is-invalid @enderror"
                               value="{{ old('contact_number_2', optional($guardian->user)->contact_number_2) }}">
                        @error('contact_number_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="alert alert-info small">
                <i data-lucide="info" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>
                To edit the guardian's name, address, email, username, or password — use
                <a href="{{ route('admin.users.edit', $guardian->user->user_id) }}" class="fw-semibold">
                    User Management
                </a>.
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn px-4 text-white fw-semibold" style="background:#1B4332;">
                    <i data-lucide="save" style="width:14px;height:14px;display:inline;vertical-align:text-bottom;"></i>Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection


