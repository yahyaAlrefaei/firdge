<ul class="list-inline">
    <li class="list-inline-item">
        <a href="{{ route(ADMIN . '.advances.edit', $id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
    <li class="list-inline-item">
        {!! Form::open([
            'class'=>'delete',
            'url'  => route(ADMIN . '.advances.destroy', $id),
            'method' => 'DELETE',
            ])
        !!}

            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

        {!! Form::close() !!}
    </li>
</ul>