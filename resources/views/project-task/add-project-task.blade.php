<div class="row">
    {{-- Task Title --}}
    <div class="col-md-12">
        <div class="mb-3">
            <label for="task_title" class="form-label">
                Task Title
                <span class="text-danger">*</span>
            </label>

            <input type="text"
                   id="task_title"
                   name="task_title"
                   class="form-control @error('task_title') is-invalid @enderror"
                   autocomplete="off"
                   value="{{ old('task_title') }}">

            @error('task_title')
            <span class="validation-message">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>
{{-- Project + Category --}}
<div class="row">

    {{-- Project --}}
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="project" class="form-label">
                Project
                <span class="text-danger">*</span>
            </label>

            <input type="text"
                   name="project"
                   id="project"
                   class="form-control @error('project') is-invalid @enderror"
                   autocomplete="off"
                   value="{{ old('project') }}">

            @error('project')
            <span class="validation-message">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>


    {{-- Category --}}
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="category" class="form-label">
                Category <span class="text-danger">*</span>
            </label>

            <select class="form-select js-task-select"
                    id="category"
                    name="category">

                <option value="">
                    Select Category
                </option>

                @foreach(\App\Enums\TaskCategoryEnum::cases() as $category)
                    <option value="{{ $category->value }}"
                        {{ old('category') == $category->value ? 'selected' : '' }}>
                        {{ $category->label() }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>

</div>


{{-- Priority + Status --}}
<div class="row">

    {{-- Priority --}}
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="priority" class="form-label">
                Priority <span class="text-danger">*</span>
            </label>

            <select id="priority"
                    name="priority"
                    class="form-select js-task-select">

                <option value="">
                    Select Priority
                </option>

                @foreach(\App\Enums\TaskPriority::cases() as $priority)
                    <option value="{{ $priority->value }}"
                        {{ old('priority') == $priority->value ? 'selected' : '' }}>
                        {{ $priority->label() }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>


    {{-- Initial Status --}}
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="status" class="form-label">
                Initial Status <span class="text-danger">*</span>
            </label>

            <select id="status"
                    name="status"
                    class="form-select js-task-select">

                <option value="">
                    Select Status
                </option>

                @foreach(\App\Enums\TaskStatus::cases() as $status)

                    @if(!in_array(
                        $status->value,
                        ['review', 'completed', 'cancelled']
                    ))

                        <option value="{{ $status->value }}"
                            {{ old('status') == $status->value ? 'selected' : '' }}>
                            {{ $status->label() }}
                        </option>

                    @endif

                @endforeach

            </select>
        </div>
    </div>

</div>


{{-- Dates + Estimated Hours --}}
<div class="row">

    {{-- Start Date --}}
    <div class="col-lg-4">
        <div class="mb-3">

            <label for="start_date" class="form-label">
                Start Date
                <span class="text-danger">*</span>
            </label>

            <input type="text"
                   name="start_date"
                   id="start_date"
                   class="form-control @error('start_date') is-invalid @enderror"
                   autocomplete="off"
                   value="{{ old('start_date') }}">

            @error('start_date')
            <span class="validation-message">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>


    {{-- Due Date --}}
    <div class="col-lg-4">
        <div class="mb-3">

            <label for="due_date" class="form-label">
                Due Date
                <span class="text-danger">*</span>
            </label>

            <input type="text"
                   name="due_date"
                   id="due_date"
                   class="form-control @error('due_date') is-invalid @enderror"
                   autocomplete="off"
                   value="{{ old('due_date') }}">

            @error('due_date')
            <span class="validation-message">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>


    {{-- Estimated Hours --}}
    <div class="col-lg-4">
        <div class="mb-3">

            <label for="estimated_hours" class="form-label">
                Est. Hours
            </label>

            <input type="number"
                   name="estimated_hours"
                   id="estimated_hours"
                   class="form-control @error('estimated_hours') is-invalid @enderror"
                   autocomplete="off"
                   min="0"
                   step="0.5"
                   value="{{ old('estimated_hours') }}">

            @error('estimated_hours')
            <span class="validation-message">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>

</div>


{{-- Assignees --}}
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            Assignees
        </div>
    </div>
</div>


{{-- Tags --}}
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            Tags
        </div>
    </div>
</div>


{{-- Checklist / Subtask --}}
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            Checklist / Subtask
        </div>
    </div>
</div>


{{-- Description --}}
<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">

            <label for="project_desc" class="form-label">
                Description
            </label>

            <textarea class="form-control"
                      id="project_desc"
                      rows="5"
                      name="project_desc">{{ old('project_desc') }}</textarea>

            @error('project_desc')
            <span class="validation-message">
                    {{ $message }}
                </span>
            @enderror

        </div>
    </div>
</div>
