@extends('admin.default')

@section('page-header')
     <small>{{ trans('app.manage clients') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.clients.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{__('app.name')}}</th>
                        <th>{{__('app.phone')}}</th>
                        <th>{{__('app.phone2')}}</th>
                        <th>{{__('app.companyName')}}</th>
                        <th>{{__('app.address')}}</th>
                        <th>{{__('app.ID_card_number')}}</th>
                        <th>{{__('app.send_sms')}}</th>
                        <th>{{__('app.Actions')}}</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><a href="{{ route(ADMIN . '.clients.show', $item->id) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->phone2 }}</td>
                            <td>{{ $item->companyName }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->ID_card_number }}</td>
                            <td>
                                <button class="btn btn-info send_sms" data-client_id="{{$item->id}}" data-toggle="modal"data-target="#sendSms">{{__("app.send_sms")}}</button>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.clients.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                    <li class="list-inline-item">
                                        {!! Form::open([
                                            'class'=>'delete',
                                            'url'  => route(ADMIN . '.clients.destroy', $item->id),
                                            'method' => 'DELETE',
                                            ])
                                        !!}

                                            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>

                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>


    <div class="modal fade" id="sendSms" tabindex="-1" role="dialog" aria-labelledby="sendSmsLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{route('admin.clients.send-sms')}}">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="sendSmsLabel">{{__('app.send_sms')}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="client_id" id="client_id">
                  <label for="message-text" class="col-form-label">{{__("app.message")}}</label>
                  <textarea name="message" class="form-control" id="message-text"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__("app.close")}}</button>
              <button type="submit" class="btn btn-primary">{{__('app.send_msg')}}</button>
            </div>
          </div>
        </form>
        </div>
      </div>


@endsection
@push('js')
    <script>
        $(".send_sms").on('click' , function() {
            let btn = $(this);
            let client_id = btn.data('client_id');
            $("#client_id").val(client_id);
        })
    </script>
@endpush