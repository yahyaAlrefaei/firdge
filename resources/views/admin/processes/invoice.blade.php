<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
            font-family: cairo, sans-serifArial;
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
            font-family: cairo, sans-serifArial;
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
                                    <img src="{{ url('/uploads/logo/' . $logo->value) }}"
                                        style="width: 100%; max-width: 300px;" />
                                @else
                                    <img src="https://image.shutterstock.com/image-vector/ui-image-placeholder-wireframes-apps-260nw-1037719204.jpg"
                                        style="width: 100%; max-width: 300px" />
                                @endif
                            </td>

                            <td>
                                {{ __('app.date') }} : {{ $process->date }}<br /> <br />
                                {{ __('app.current_date') }} : {{ now()->toDateString() }}<br /> <br />
                                {{ __('app.client') }} : {{ $process->clientRelation->name }}<br /> <br />
                                {{ __('app.phone') }} : {{ $process->clientRelation->phone }}<br /> <br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>###</td>
                <td style="direction: rtl;">{{ __('app.details') }}</td>
            </tr>
            <tr class="details">
                <td>{{ __('app.' . $process->process_type) }}</td>
                <td style="direction: rtl;">{{ __('app.process_type') }}</td>
            </tr>
            <tr class="details">
                <td>{{ $process->seasonRelation->seasonName }}</td>
                <td>{{ __('app.seasonName') }}</td>
            </tr>
            <tr class="details">
                <td>{{ $process->productRelation->productName }}</td>
                <td>{{ __('app.product') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->typeRelation->type }}</td>
                <td>{{ __('app.type') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->number_kilo }}</td>
                <td>{{ __('app.number_kilo') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->sacks_number }}</td>
                <td>{{ __('app.sacks_number') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->sacksRelation->sacksName }}</td>
                <td>{{ __('app.sacks_type') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->sacks_color }}</td>
                <td>{{ __('app.sacks_color') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->warehouseRelation->warehouseName }}</td>
                <td>{{ __('app.warehouse') }}</td>
            </tr>

            <tr class="details">
                <td>{{ $process->floorRelation->floorName }}</td>
                <td>{{ __('app.floor') }}</td>
            </tr>
        </table>
    </div>
</body>

</html>