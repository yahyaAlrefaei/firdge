@push('css')
	<style>
		
	</style>
@endpush

<div class="row mB-40">
	<div class="col-md-8 col-sm-12 m-auto ">
		<div class="bgc-white p-20 bd">

			<div class="form-group">
                <label for="client_id">{{__('app.client')}}</label>
                <select name="client_id" id="" class="form-control">
                    <option value="">----</option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}" {{isset($advance) && $advance->client_id == $client->id ? "selected" : ""}}>{{$client->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="season_id">{{__("app.seasonName")}}</label>
                <select name="season_id" id="" class="form-control">
                    <option value="">----</option>
                    @foreach ($seasons as $season)
                        <option value="{{$season->id}}" {{isset($advance) && $advance->season_id == $season->id ? "selected" : ""}}>{{$season->seasonName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="amount">{{__('app.amount')}}</label>
                <input type="number" class="form-control" name="amount"
                 value="{{isset($advance) ? $advance->amount : old('amount')}}">
            </div>

            <div class="form-group">
                <label for="date">{{__('app.date')}}</label>
                <input type="date" class="form-control" name="date"
                 value="{{isset($advance) ? $advance->date : now()->toDateString()}}">
            </div>
            <div class="form-group">
                <label for="notes">{{__('app.notes')}}</label>
                <textarea name="notes" class="form-control">{{isset($advance) ? $advance->notes : old('notes')}}</textarea>
            </div>
		</div>
	</div>

</div>

@push('js')
	<script>
	
	</script>
@endpush