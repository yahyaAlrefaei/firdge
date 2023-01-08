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

            .td-column{
              width: 10%;
			  text-align: right;
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
		<div class="invoice-box rtl">
			<table cellpadding="0" cellspacing="0" class="rtl">
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
									{{-- Client details --}}
									{{__("app.current_date")}} : {{now()->toDateString()}}<br/> <br />
									{{__("app.client")}} : {{$client->name}}<br/> <br />
									{{__("app.phone")}} : {{$client->phone}}<br/> <br />
									
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading" style="display: flex;">
					<td class="td-column">{{__("app.process_type")}}</td>
                    <td class="td-column">{{__("app.seasonName")}}</td>
                    <td class="td-column">{{__("app.product")}}</td>
                    <td class="td-column">{{__("app.type")}}</td>
                    <td class="td-column">{{__("app.number_kilo")}}</td>
                    <td class="td-column">{{__("app.sacks_number")}}</td>
                    <td class="td-column">{{__("app.sacks_type")}}</td>
                    <td class="td-column">{{__("app.sacks_color")}}</td>
                    <td class="td-column">{{__("app.warehouse")}}</td>
                    <td class="td-column">{{__("app.floor")}}</td>
				</tr>
                @foreach ($processes as $process)
                <tr class="details" style="display: flex;">
					<td class="td-column">{{ __('app.'.$process->process_type)}}</td>
					<td class="td-column">{{$process->seasonRelation->seasonName}}</td>
                    <td class="td-column">{{$process->productRelation->productName}}</td>
                    <td class="td-column">{{$process->typeRelation->type}}</td>
                    <td class="td-column">{{$process->number_kilo}}</td>
                    <td class="td-column">{{$process->sacks_number}}</td>
                    <td class="td-column">{{$process->sacksRelation->sacksName}}</td>
                    <td class="td-column">{{$process->sacks_color}}</td>
                    <td class="td-column">{{$process->warehouseRelation->warehouseName}}</td>
                    <td class="td-column">{{$process->floorRelation->floorName}}</td>
				</tr>
                @endforeach
			</table>
		</div>
	</body>
</html>
