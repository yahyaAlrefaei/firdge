<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				 font-family: 'Cairo', sans-serif; 
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									@if (isset($logo->value))
									<img src="{{url('/uploads/logo/'. $logo->value)}}" style="width: 100%; max-width: 300px;" />
									@else
									<img src="https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg"
									 style="width: 100%; max-width: 300px" />	
									@endif
								</td>

								<td>
									
									الفاتورة #: {{$invoice->id}}<br /> <br /> 
									{{__("app.invoice_date")}} : {{$invoice->date}}<br /> <br />
									{{__("app.current_date")}} : {{now()->toDateString()}}<br/> <br />
									{{__("app.client")}} : {{$invoice->client->name}}<br/> <br />
									{{__("app.seasonName")}} : {{$invoice->season->seasonName}}<br /> <br />
									{{__("app.pickedBy")}}  :  {{$invoice->pickedBy->name}}<br /> <br />
									{{__("app.ton_price")}}  : {{$invoice->ton_price}} جنيه <br /> <br />
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								{{-- <td>
									{{__("app.seasonName")}} : {{$invoice->season->seasonName}}<br />
									{{__("app.pickedBy")}}  :  {{$invoice->pickedBy->name}}<br />
									{{__("app.ton_price")}}  : {{$invoice->ton_price}} جنيه <br />
								</td> --}}

								{{-- <td>
									Acme Corp.<br />
									John Doe<br />
									john@example.com
								</td> --}}
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>{{__("app.amount")}}</td>
					<td>{{__("app.advances")}}</td>
				</tr>

				@foreach ($advances as $advance)
				<tr class="item">
					<td>{{$advance->amount}} جنيه</td>
					<td>{{$advance->date}}</td>
				</tr>
				@endforeach

				<tr class="heading">
					<td>###</td>
					<td>{{__("app.details")}}</td>
				</tr>

				<tr class="details">
					<td>{{$invoice->total_amount}}</td>
					<td>{{__("app.total_amount")}}</td>
				</tr>
				<tr class="details">
					<td>{{$invoice->paid_amount}}</td>
					<td>{{__("app.paid_amount")}}</td>
				</tr>

				@if (isset($invoice->discount) && $invoice->discount > 0)
				<tr class="details">
					<td>{{$invoice->discount}}</td>
					<td>{{__("app.discount")}}</td>
				</tr>
				@endif
				<tr class="details">
					<td>{{$invoice->remained_amount}}</td>
					<td>{{__("app.remained_amount")}}</td>
				</tr>
				<tr class="total">
					<td></td>

					<td>{{__("app.paid_amount")}}: {{$invoice->paid_amount}}</td>
				</tr>
			</table>
		</div>
	</body>
</html>