<ul class="list-inline d-flex justify-content-between justify-between">
    <li class="list-inline-item">
        <a href="{{ route(ADMIN . '.invoices.edit', $id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>

        <li class="list-inline-item" style="margin: 0 .5rem 0 .5rem;">
            <a href="{{ route(ADMIN . '.invoices.pdf', $id) }}" class="btn btn-info btn-sm"><i class="fa fa-print"></i></a>
        </li>

    <li class="list-inline-item">
        {!! Form::open([
            'class'=>'delete',
            'url'  => route(ADMIN . '.invoices.destroy', $id),
            'method' => 'DELETE',
            ])
        !!}

            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

        {!! Form::close() !!}
    </li>
</ul>