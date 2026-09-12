{{--
@if(!empty($all_employees) && count($all_employees) > 0)

@else
    {!! generate_no_record_html() !!}
@endif--}}

<div class="table-responsive">
    <table class="table align-middle text-nowrap table-hover table-centered mb-0">
        <thead class="table-light">
        <tr>
            <th>Sr. no.</th>
            <th width="20%">Task</th>
            <th width="10%">Assignees</th>
            <th width="12%">Priority</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1.{{--{{$loop->iteration}}--}}.</td>
            <td>Redesign user authentication flow</td>
            <td>Assignee</td>
            <td>Priority</td>
            <td>Status</td>
            <td>
                <div class="d-flex gap-2">
                    {!! generate_view_button(route('employees.view', ['emp_id' => my_encrypt(1)])) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
