<!-- Job Application Form (To be included in job detail view) -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Apply for this Position</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label for="resume" class="form-label">Resume/CV (PDF, DOC, DOCX)</label>
                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                <div class="form-text">
                    <small class="text-muted">Optional if you've already uploaded a resume to your profile. Max size: 2MB</small>
                </div>
            </div>

            <div class="mb-4">
                <label for="cover_letter" class="form-label">Cover Letter</label>
                <textarea class="form-control" id="cover_letter" name="cover_letter" rows="6" required>{{ old('cover_letter') }}</textarea>
                <div class="form-text">
                    <small class="text-muted">Explain why you're a good fit for this position</small>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit Application</button>
                <a href="{{ route('jobs.index') }}" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
</div>
