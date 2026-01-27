@extends('admin.layouts.app')

@section('title', 'إضافة نوع مصروف جديد')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.distribution-types.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">الاسم (العربية)</label>
                            <input type="text" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror"
                                   value="{{ old('ar_name') }}" required>
                            @error('ar_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الاسم (English)</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الوصف</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">الأيقونة</label>
                                <select name="icon" class="form-select @error('icon') is-invalid @enderror" required>
                                    <option value="">-- اختر أيقونة --</option>
                                    @foreach ($icons as $icon)
                                        <option value="{{ $icon }}" {{ old('icon') == $icon ? 'selected' : '' }}>
                                            <i class="bi {{ $icon }}"></i> {{ $icon }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">اللون</label>
                                <select name="color" class="form-select @error('color') is-invalid @enderror" required>
                                    <option value="">-- اختر لون --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}" {{ old('color') == $color ? 'selected' : '' }}>
                                            {{ $color }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الترتيب</label>
                            <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                                   value="{{ old('order', 0) }}" required>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                تفعيل هذا النوع
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> إضافة
                            </button>
                            <a href="{{ route('admin.distribution-types.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-right"></i> رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="bi bi-info-circle"></i> معلومات
                    </h6>
                    <p class="small text-muted mb-2">
                        أضف أنواع مصروفات جديدة حسب احتياجات الجمعية.
                    </p>
                    <hr>
                    <h6>الأنواع الافتراضية:</h6>
                    <ul class="small ps-3 mb-0">
                        <li>إعانة مالية</li>
                        <li>مواد أغذية</li>
                        <li>مواد طبية</li>
                        <li>مستلزمات طبية</li>
                        <li>ملابس وأحذية</li>
                        <li>مستلزمات تعليمية</li>
                        <li>أشياء أخرى</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
