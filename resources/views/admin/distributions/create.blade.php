@extends('admin.layouts.app')

@section('title', 'تسجيل استلام')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if (session('previous_distribution'))
                        <div class="alert alert-warning">
                            تم صرف هذه الحالة من قبل بتاريخ
                            <strong>{{ session('previous_distribution.date') }}</strong>
                            للمستفيد
                            <strong>{{ session('previous_distribution.case_name') }}</strong>.
                            هل تريد الاستمرار؟
                            <form action="{{ route('admin.distributions.store') }}" method="POST" class="mt-2 d-flex gap-2 flex-wrap">
                                @csrf
                                <input type="hidden" name="barcode" value="{{ old('barcode') }}">
                                <input type="hidden" name="notes" value="{{ old('notes') }}">
                                <input type="hidden" name="distribution_type_id" value="{{ old('distribution_type_id') }}">
                                <input type="hidden" name="amount" value="{{ old('amount') }}">
                                <input type="hidden" name="confirm_override" value="1">
                                <button type="submit" class="btn btn-sm btn-primary">نعم، سجل الصرف</button>
                                <a href="{{ route('admin.distributions.index') }}" class="btn btn-sm btn-outline-secondary">إلغاء</a>
                            </form>
                        </div>
                    @endif
                    <form action="{{ route('admin.distributions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">امسح الباركود</label>
                            <input type="text" name="barcode" class="form-control @error('barcode') is-invalid @enderror" 
                                   value="{{ old('barcode') }}" autofocus required>
                            @error('barcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">نوع المصروف</label>
                            <select name="distribution_type_id" class="form-select @error('distribution_type_id') is-invalid @enderror" required>
                                <option value="">-- اختر نوع المصروف --</option>
                                @foreach(\App\Models\DistributionType::active() as $type)
                                    <option value="{{ $type->id }}" {{ old('distribution_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->ar_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('distribution_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">المبلغ (اختياري - للمساعدات المالية فقط)</label>
                            <div class="input-group">
                                <input type="number" name="amount" class="form-control" 
                                       value="{{ old('amount') }}" step="0.01" min="0">
                                <span class="input-group-text">EGP</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> تسجيل الصرف
                            </button>
                            <a href="{{ route('admin.distributions.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-right"></i> رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="bi bi-info-circle"></i> معلومات هامة
                    </h6>
                    <div class="alert alert-info small mb-0">
                        <p class="mb-2"><strong>نوع المصروف:</strong></p>
                        <ul class="mb-0 ps-3">
                            <li>اختر نوع المصروف الصحيح من القائمة</li>
                            <li>إذا لم تجد النوع المناسب، يمكن إضافة نوع جديد</li>
                        </ul>
                    </div>
                    <hr>
                    <div class="alert alert-info small mb-0">
                        <p class="mb-2"><strong>المبلغ المالي:</strong></p>
                        <ul class="mb-0 ps-3">
                            <li>أضف المبلغ فقط للمساعدات المالية</li>
                            <li>اترك الحقل فارغاً للمساعدات الأخرى</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
