<div class="row mB-40">
	<div class="col-md-8 col-sm-12 m-auto ">
		<div class="bgc-white p-20 bd">

			<div class="form-group">
				<label for="type">{{__('app.expense-type')}}</label>
				<select name="type" class="form-control" id="type">
					<option value="">-----</option>
					<option {{isset($item) && $item->type == "workers_wages" ? 'selected' : ''}} value="workers_wages">{{__('app.workers_wages')}}</option>
					<option {{isset($item) && $item->type == "maintenance_fee" ? 'selected' : ''}} value="maintenance_fee">{{__('app.maintenance_fee')}}</option>
					<option {{isset($item) && $item->type == "raw_materials_expenses" ? 'selected' : ''}} value="raw_materials_expenses">{{__('app.raw_materials_expenses')}}</option>
					<option {{isset($item) && $item->type == "other_expenses" ? 'selected' : ''}} value="other_expenses">{{__('app.other_expenses')}}</option>
				</select>
			</div>

			<div class="form-group {{isset($item) && $item->type == "other_expenses" ? '' : 'd-none'}}" id="other_type">
				<label for="other_type">{{__('app.other_type')}}</label>
				<input type="text" name="other_type" class="form-control" value="{{isset($item) ? $item->other_type : old('other_type')}}">
			</div>

			<div class="form-group">
				<label for="amount">{{__('app.amount')}}</label>
				<input type="number" name="amount" class="form-control" value="{{isset($item) ? $item->amount : old('amount')}}">
			</div>
		

			<div class="form-group">
				<label>{{__('app.date')}}</label>
             <input type="date" class="form-control" name="date" value="{{ isset($item) ? $item->date : now()->toDateString() }}">
			</div>

			<div class="form-group">
				<label>{{__('app.notes')}}</label>
             <textarea type="text" class="form-control" name="notes">{{isset($item) && $item->notes != null ? $item->notes : ""}}</textarea>
			</div>
		</div>
	</div>

</div>
@push('js')
	
@endpush
<script>
	$("#type").on('change' , function(e) {
		let type = $("#type").val()
		if(type == "other_expenses") {
			$("#other_type").removeClass('d-none')
		}else {
			$("#other_type").addClass('d-none')
		}
	})
</script>