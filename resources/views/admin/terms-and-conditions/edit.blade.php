@extends('admin.layouts.app')

@section('title', 'إدارة الشروط والأحكام')

@section('content')
    <section class="admin-hero mb-4">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center gap-3">
            <div class="flex-grow-1">
                <h2 class="mb-2">الشروط والأحكام</h2>
                <p class="mb-0 text-muted">إدارة الشروط والأحكام الخاصة بالموقع</p>
            </div>
            <a href="{{ route('site.terms-and-conditions') }}" target="_blank" class="btn btn-outline-info">
                <i class="bi bi-eye me-2"></i>عرض الصفحة العامة
            </a>
        </div>
    </section>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="alert-heading">حدثت أخطاء</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="panel-card">
                <div class="panel-header">
                    <div>
                        <h5 class="mb-1">
                            <i class="bi bi-file-earmark-text me-2"></i>محتوى الشروط والأحكام
                        </h5>
                        <span>قم بتحرير محتوى الشروط والأحكام الذي سيظهر في الموقع</span>
                    </div>
                </div>

                <form action="{{ route('admin.terms-and-conditions.update') }}" method="POST" class="p-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="form-label">العنوان</label>
                        <input 
                            type="text" 
                            class="form-control @error('title') is-invalid @enderror" 
                            id="title" 
                            name="title" 
                            value="{{ old('title', $termsAndConditions->title) }}"
                            required
                        >
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="summary" class="form-label">ملخص قصير (اختياري)</label>
                        <textarea 
                            class="form-control @error('summary') is-invalid @enderror" 
                            id="summary" 
                            name="summary"
                            rows="2"
                            placeholder="ملخص قصير يظهر أعلى الصفحة"
                        >{{ old('summary', $termsAndConditions->summary) }}</textarea>
                        <small class="text-muted">اترك هذا الحقل فارغاً إذا لم تكن بحاجة إلى ملخص</small>
                        @error('summary')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="form-label">المحتوى الكامل</label>
                        <textarea 
                            class="form-control @error('content') is-invalid @enderror" 
                            id="content" 
                            name="content"
                            rows="15"
                            required
                            placeholder="أدخل محتوى الشروط والأحكام هنا..."
                        >{{ old('content', $termsAndConditions->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                id="is_active" 
                                name="is_active" 
                                value="1"
                                @checked(old('is_active', $termsAndConditions->is_active))
                            >
                            <label class="form-check-label" for="is_active">
                                نشر الشروط والأحكام على الموقع
                            </label>
                        </div>
                        <small class="text-muted d-block mt-2">إذا قمت بإلغاء هذا الخيار، لن تظهر الشروط والأحكام للزوار</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i>حفظ التغييرات
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>رجوع
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // You can add a rich text editor here if you want (e.g., TinyMCE or CKEditor)
            document.addEventListener('DOMContentLoaded', function() {
                const textarea = document.getElementById('content');
                if (textarea) {
                    // Auto-save to localStorage
                    textarea.addEventListener('input', function() {
                        localStorage.setItem('terms_draft', this.value);
                    });

                    // Load from localStorage if exists
                    const draft = localStorage.getItem('terms_draft');
                    if (draft && textarea.value.length < 100) {
                        // Only load if textarea is mostly empty
                        // This prevents overwriting after page reload
                    }

                    // Clear draft on successful submit
                    document.querySelector('form').addEventListener('submit', function() {
                        localStorage.removeItem('terms_draft');
                    });
                }
            });
        </script>
    @endpush
@endsection
