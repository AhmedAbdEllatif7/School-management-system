

<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showAddParentform" type="button">{{ trans('Parent_trans.add_parent') }}</button><br><br>

<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.email') }}</th>
            <th>{{ trans('Parent_trans.fatherName') }}</th>
            <th>{{ trans('Parent_trans.identificationlID') }}</th>
            <th>{{ trans('Parent_trans.passportID') }}</th>
            <th>{{ trans('Parent_trans.phone') }}</th>
            <th>{{ trans('Parent_trans.job') }}</th>
            <th>{{ trans('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($parents as $parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $parent->email }}</td>
                <td>{{ $parent->father_name }}</td>
                <td>{{ $parent->father_national_id }}</td>
                <td>{{ $parent->father_passport_id }}</td>
                <td>{{ $parent->father_phone }}</td>
                <td>{{ $parent->father_job }}</td>
                <td>
                    <button wire:click="edit({{ $parent->id }})" title="{{ trans('Grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $parent->id }})" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>
