<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="season_id">{{__("app.seasonName")}}</label>
            <select name="season_id" class="form-control season_id" id="">
                <option value="">----</option>
                @foreach ($seasons as $season)
                    <option value="{{$season->id}}" {{isset($invoice) && $invoice->season_id == $season->id ? "selected" : ""}}>{{$season->seasonName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="client_id">{{__("app.client")}}</label>
            <select name="client_id" class="form-control client_id" id="">
                <option value="">----</option>
                @foreach ($clients as $client)
                    <option value="{{$client->id}}" {{isset($invoice) && $invoice->client_id == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="total_tons">{{__("app.total_tons")}}</label>
          <input type="number" name="total_tons" readonly class="form-control" id="total_tons" value="{{isset($invoice) ? $invoice->total_tons : old('total_tons')}}">
        </div>
        <div class="form-group">
            <label for="ton_price">{{__("app.ton_price")}}</label>
          <input type="number" name="ton_price" readonly class="form-control" id="ton_price" value="{{isset($invoice) ? $invoice->ton_price : old('ton_price')}}">
        </div>
        <div class="form-group">
            <label for="total_amount">{{__("app.total_amount")}}</label>
          <input type="number" name="total_amount" readonly class="form-control" id="total_amount" value="{{isset($invoice) ? $invoice->total_amount : '0.00'}}">
        </div>
        <div class="form-group">
            <label for="paid_amount">{{__("app.paid_amount")}}</label>
          <input type="number" name="paid_amount" readonly class="form-control" id="paid_amount" value="{{isset($invoice) ? $invoice->paid_amount : '0.00'}}">
        </div>
        <div class="form-group">
            <label for="remained_amount">{{__("app.remained_amount")}}</label>
          <input type="number"  name="remained_amount" readonly class="form-control" id="remained_amount" value="{{isset($invoice) ? $invoice->remained_amount : '0.00'}}">
        </div>
        
        <div class="form-group">
            <label for="amount">{{__("app.add_amount")}}</label>
          <input type="number" name="amount" class="form-control" id="amount" value="{{isset($invoice) ? $invoice->amount : '0.00'}}">
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="amount">{{__("app.percent_discount")}}</label>
              <input type="number" class="form-control" name="percent_discount" id="percent_discount" value="{{isset($invoice) ? $invoice->percent_discount : ""}}">
            </div>
            <div class="form-group col-md-6">
                <label for="amount">{{__("app.fixed_discount")}}</label>
              <input type="number" class="form-control" name="fixed_discount" id="fixed_discount" value="{{isset($invoice) ? $invoice->fixed_discount : '0.00'}}">
            </div>
        </div>
        

        <div class="form-group">
            <label>{{__('app.date')}}</label>
         <input type="date" class="form-control" name="date" value="{{ isset($invoice) ? $invoice->date : now()->toDateString() }}">
        </div>
        <div  class="col-12">
            <label>{{__('app.notes')}}</label>
            <textarea class="form-control" name="notes" >{{ isset($invoice) ? $invoice->notes : old('notes') }}</textarea>
        </div>
    </div>
    <br>

    <div class="col-md-6 col-sm-12">
        <div class="pt-30 pl-20">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h2>{{__('app.advances')}}</h2>
                    <table id="" style="width: 100%;" class="table table-bordered data-table responsive table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('app.seasonName')}}</th>
                            <th>{{__('app.amount')}}</th>
                            <th>{{__('app.date')}}</th>
                            <th>{{__('app.picked_by')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>

                    </table>
            </div>
        </div>
    </div>
</div>

@push('js')
@endpush