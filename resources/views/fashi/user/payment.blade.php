@extends('master')

@section('css')
    <link href="/libraries/vnpayqr/Styles.min.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i>{{ trans('header.home') }}</a>
                        <a href="{{ route('product.index') }}">{{ trans('header.shop') }}</a>
                        <span>{{ trans('text.payment') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="checkout-section spad">
        <div class="container">
            <form method="POST" id="form-payment" class="checkout-form" action="{{ route('create_order') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <h4>{{ trans('text.billing_details') }}</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="receiver">{{ trans('text.receiver') }}<span>*</span></label>
                                <input type="text" readonly class="mb-3" name="receiver" value="{{ $data['receiver']}}">
                            </div>

                            <div class="col-lg-12">
                                <label for="phone">{{ trans('text.phone') }}<span>*</span></label>
                                <input type="text" readonly class="mb-3" name="phone" value="{{ $data['phone'] }}">
                            </div>
                            <div class="col-lg-12">
                                <label for="address">{{ trans('text.address') }}<span>*</span></label>
                                <input type="text" class="mb-3" readonly name="address" value="{{ $data['address'] }}">
                            </div>
                            <div class="col-lg-12">
                                <label for="type-shipment">{{ trans('payment.shipment.type_shipment') }}<span>*</span></label>
                                <input type="text" class="mb-3" readonly name="typeShipment" value="{{ $data['typeShipment'] }}">
                            </div>
                            <div class="col-lg-12">
                                <label for="type-payment">{{ trans('payment.payment.type_payment') }}<span>*</span></label>
                                <input type="text" class="mb-3" readonly name="typePayment" value="{{ $data['typePayment'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>{{ trans('text.your_order') }}</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>{{ trans('text.product') }}<span>{{ trans('text.total') }}</span></li>
                                    @php $totalPrice = 0; @endphp
                                    @if (isset($cart))
                                        @foreach ($cart as $productCart)
                                            <li class="fw-normal">
                                                {{ $productCart['name'] }} x {{ $productCart['quantity'] }} ({{ $productCart['color'] }} - {{ $productCart['size'] }})
                                                <span>
                                                    ${{ number_format($subTotal = $productCart['price'] * $productCart['quantity']) }}
                                                </span>
                                            </li>
                                            @php $totalPrice += $subTotal; @endphp
                                        @endforeach
                                    @endif
                                    @if ($data['typeShipment'] == config('payment.shipment.type.fast'))
                                        <li class="total-price">{{ trans('payment.shipment.fee') }}
                                            <span>${{ number_format(config('payment.shipment.fee.fast')) }}</span></li>
                                        @php $totalPrice += config('payment.shipment.fee.fast'); @endphp
                                        <input type="hidden" name="feeShipment" value="{{ config('payment.shipment.fee.fast') }}">
                                    @elseif($data['typeShipment'] == config('payment.shipment.type.normal'))
                                        <li class="total-price">{{ trans('payment.shipment.fee') }}
                                            <span>${{ number_format(config('payment.shipment.fee.normal')) }}</span></li>
                                        @php $totalPrice += config('payment.shipment.fee.normal'); @endphp
                                        <input type="hidden" name="feeShipment" value="{{ config('payment.shipment.fee.normal') }}">
                                    @endif
                                    <li class="total-price">{{ trans('text.total') }}<span>${{ number_format($totalPrice) }}</span></li>
                                    <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($data['typePayment'] == config('payment.payment.type.vnpay'))
                    <div class="vnpay-qr">
                        <div id="header" class="clearfix border-radius-header">
                            <div class="container clearfix">
                                <div class="navbar-header">
                                    <img src="{{ asset('images/payment/logo.png') }}" width="170" height="60" alt="VNPAY">
                                </div>
                            </div>
                        </div>
                        <div id="container" class="container bs-docs-container clearfix">
                            <div class="alert alert-info text-center alert-dismissible"><a
                                href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                @lang('payment.vnpay.notify')
                            </div>
                            <div class="row">
                                <div class="col-md-12 pull-left">
                                    <div class="box box-qrcode">
                                        <div class="title">
                                            <h2>@lang('payment.vnpay.application')<br> @lang('payment.vnpay.scan')</h2>
                                            <div class="icon-title"></div>
                                        </div>
                                        <div class="box-cont clearfix">
                                            <div class="qrcode">
                                                <div class="qrcode-pic">
                                                    <img data-toggle="modal" data-target="#modal-qrcode" style="cursor: pointer"
                                                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOYAAADmCAIAAABOCG7sAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAACYVSURBVHhe7dJBjhxZlm3LP/9Jv19YkIYjt8VxpTqZVQFQmmsfveYR4P/3//7661/l7z/Zv/5l/v6T/etf5u8/2b/+Zf7+k/3rX+bvP9m//mX+/pP961/m7z/Zv/5l/v6T/etf5von+//9AZ4e5pPTx3x2cjrMkSJFihRpmCNFijTMkYZ5mE9Oh/nk9Lfy9Cfn9gd4ephPTh/z2cnpMEeKFClSpGGOFCnSMEca5mE+OR3mk9PfytOfnNsf4OlhPjl9zGcnp8McKVKkSJGGOVKkSMMcaZiH+eR0mE9OfytPf3Juf4Cnh/nk9DGfnZwOc6RIkSJFGuZIkSINc6RhHuaT02E+Of2tPP3JuX0hveKJSMMcKdLJ6clppEiRIkV6xRORIkWKFGmYI0WKFGmYh3mYhznSK56I9Mm5fSG94olIwxwp0snpyWmkSJEiRXrFE5EiRYoUaZgjRYoUaZiHeZiHOdIrnoj0ybl9Ib3iiUjDHCnSyenJaaRIkSJFesUTkSJFihRpmCNFihRpmId5mIc50iueiPTJuX0hveKJSMMcKdLJ6clppEiRIkV6xRORIkWKFGmYI0WKFGmYh3mYhznSK56I9Mm5fSFFOjmNFClSpGGO9IonIkU6OY0U6TGfDXOkk9OT00jDHGmYIw1zpEgnp5EifXJuX0iRTk4jRYoUaZgjveKJSJFOTiNFesxnwxzp5PTkNNIwRxrmSMMcKdLJaaRIn5zbF1Kkk9NIkSJFGuZIr3giUqST00iRHvPZMEc6OT05jTTMkYY50jBHinRyGinSJ+f2hRTp5DRSpEiRhjnSK56IFOnkNFKkx3w2zJFOTk9OIw1zpGGONMyRIp2cRor0ybl9IUU6OY0UKdIwRxrmYR7mSMMcKdIwn5wOc6THfHZyGmmYIw1zpEiRIkU6OY0U6ZNz+0KKdHIaKVKkYY40zMM8zJGGOVKkYT45HeZIj/ns5DTSMEca5kiRIkWKdHIaKdIn5/aFFOnkNFKkSMMcaZiHeZgjDXOkSMN8cjrMkR7z2clppGGONMyRIkWKFOnkNFKkT87tCynSyWmkSJGGOdIwD/MwRxrmSJGG+eR0mCM95rOT00jDHGmYI0WKFCnSyWmkSJ+c2xdSpJPTSJEiRYoU6eQ0UqST05PT/wo/OcyRIkU6OY0UaZhPTiNFOjmNFOmTc/tCinRyGilSpEiRIp2cRop0cnpy+l/hJ4c5UqRIJ6eRIg3zyWmkSCenkSJ9cm5fSJFOTiNFihQpUqST00iRTk5PTv8r/OQwR4oU6eQ0UqRhPjmNFOnkNFKkT87tCynSyWmkSJEiRYp0chop0snpyel/hZ8c5kiRIp2cRoo0zCenkSKdnEaK9Mm5fSG94olIkU5OIw1zpJPTYY50chrp5DRSpGEe5kiRHvPZMEc6OY30iicifXJuX0iveCJSpJPTSMMc6eR0mCOdnEY6OY0UaZiHOVKkx3w2zJFOTiO94olIn5zbF9IrnogU6eQ00jBHOjkd5kgnp5FOTiNFGuZhjhTpMZ8Nc6ST00iveCLSJ+f2hfSKJyJFOjmNNMyRTk6HOdLJaaST00iRhnmYI0V6zGfDHOnkNNIrnoj0ybn9AZ6OFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIv1Wnv7k3P4AT0eKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRfitPf3Juf4CnI0WKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEi/lac/Obc/wNORIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpEiRIkWKFClSpN/K059c25/mrxvmSMMcKdIwR/oxz0U6OY0U6TGfRYoUKVKkSMN8cvq/4X/1t/+BOdIwR4o0zJF+zHORTk4jRXrMZ5EiRYoUKdIwn5z+b/hf/e1/YI40zJEiDXOkH/NcpJPTSJEe81mkSJEiRYo0zCen/xv+V3/7H5gjDXOkSMMc6cc8F+nkNFKkx3wWKVKkSJEiDfPJ6f+G67f9dZEiveKJYX7MZ5EiRTo5HeZIkX4rT5+cRhrmYX7MZyenkV7xxK+4vvFqpEiveGKYH/NZpEiRTk6HOVKk38rTJ6eRhnmYH/PZyWmkVzzxK65vvBop0iueGObHfBYpUqST02GOFOm38vTJaaRhHubHfHZyGukVT/yK6xuvRor0iieG+TGfRYoU6eR0mCNF+q08fXIaaZiH+TGfnZxGesUTv+LpN37h5PQVT0Q6OX3MZ5GGeZiH+TGfRYr0mM9e8cQwR4o0zJGGOdLJaaRPHr31P7x0cvqKJyKdnD7ms0jDPMzD/JjPIkV6zGeveGKYI0Ua5kjDHOnkNNInj976H146OX3FE5FOTh/zWaRhHuZhfsxnkSI95rNXPDHMkSINc6RhjnRyGumTR2/9Dy+dnL7iiUgnp4/5LNIwD/MwP+azSJEe89krnhjmSJGGOdIwRzo5jfTJuX0hveKJSJFe8cTJ6TC/4olIkSJFihQp0mM++zHPRYoUKdIwR4oUaZgjfee681KkVzwRKdIrnjg5HeZXPBEpUqRIkSJFesxnP+a5SJEiRRrmSJEiDXOk71x3Xor0iiciRXrFEyenw/yKJyJFihQpUqRIj/nsxzwXKVKkSMMcKVKkYY70nevOS5Fe8USkSK944uR0mF/xRKRIkSJFihTpMZ/9mOciRYoUaZgjRYo0zJG+c915aZhf8cRjPhvmSMN8cvqKJyIN8zBHOjkd5kiRIg1zpEiRhjlSpGEe5kjfue68NMyveOIxnw1zpGE+OX3FE5GGeZgjnZwOc6RIkYY5UqRIwxwp0jAPc6TvXHdeGuZXPPGYz4Y50jCfnL7iiUjDPMyRTk6HOVKkSMMcKVKkYY4UaZiHOdJ3rjsvDfMrnnjMZ8McaZhPTl/xRKRhHuZIJ6fDHClSpGGOFCnSMEeKNMzDHOk7T+++8gvDPMyP+ewxnw3zMJ+cnpyenJ6cRhrmSMM8zJEiveKJSJFe8cR33vzdfmGYh/kxnz3ms2Ee5pPTk9OT05PTSMMcaZiHOVKkVzwRKdIrnvjOm7/bLwzzMD/ms8d8NszDfHJ6cnpyenIaaZgjDfMwR4r0iiciRXrFE99583f7hWEe5sd89pjPhnmYT05PTk9OT04jDXOkYR7mSJFe8USkSK944juP7/6BeZgjRRrmYR7mYY4UaZgjnZxGihQpUqRIkR7z2TAPc6RhjjTMkSJFihQp0jBH+uTavvLSMA9zpEjDPMzDPMyRIg1zpJPTSJEiRYoUKdJjPhvmYY40zJGGOVKkSJEiRRrmSJ9c21deGuZhjhRpmId5mIc5UqRhjnRyGilSpEiRIkV6zGfDPMyRhjnSMEeKFClSpEjDHOmTa/vKS8M8zJEiDfMwD/MwR4o0zJFOTiNFihQpUqRIj/lsmIc50jBHGuZIkSJFihRpmCN9cm7/wHxy+pjPIg3zyekwRzo5jTTMkSJFihQpUqRIwxwpUqTHfBYpUqRhPjmNNMzfue68NMwnp4/5LNIwn5wOc6ST00jDHClSpEiRIkWKNMyRIkV6zGeRIkUa5pPTSMP8nevOS8N8cvqYzyIN88npMEc6OY00zJEiRYoUKVKkSMMcKVKkx3wWKVKkYT45jTTM37nuvDTMJ6eP+SzSMJ+cDnOkk9NIwxwpUqRIkSJFijTMkSJFesxnkSJFGuaT00jD/J3rzksnp8McaZgjnZxGesUTJ6eRIkWKNMzDHCnSyekwR4o0zJEiRRrmSJEiRYoUKdJ3rjsvnZwOc6RhjnRyGukVT5ycRooUKdIwD3OkSCenwxwp0jBHihRpmCNFihQpUqRI37nuvHRyOsyRhjnSyWmkVzxxchopUqRIwzzMkSKdnA5zpEjDHClSpGGOFClSpEiRIn3nuvPSyekwRxrmSCenkV7xxMlppEiRIg3zMEeKdHI6zJEiDXOkSJGGOVKkSJEiRYr0nevOS5EiRYr0iide8USkSJGGOdJjPnvMZ8M8zMMcKdJjPosUKdIwn5xG+h2ut/xapEiRIr3iiVc8ESlSpGGO9JjPHvPZMA/zMEeK9JjPIkWKNMwnp5F+h+stvxYpUqRIr3jiFU9EihRpmCM95rPHfDbMwzzMkSI95rNIkSIN88lppN/hesuvRYoUKdIrnnjFE5EiRRrmSI/57DGfDfMwD3OkSI/5LFKkSMN8chrpd7je8muRTk6H+eT0MZ895rNhjjTMwzzMwxwpUqRIkU5OIw3zYz4b5kiRTk4jDfMn5/aFdHI6zCenj/nsMZ8Nc6RhHuZhHuZIkSJFinRyGmmYH/PZMEeKdHIaaZg/ObcvpJPTYT45fcxnj/lsmCMN8zAP8zBHihQpUqST00jD/JjPhjlSpJPTSMP8ybl9IZ2cDvPJ6WM+e8xnwxxpmId5mIc5UqRIkSKdnEYa5sd8NsyRIp2cRhrmT87tD/MzkV7xRKRhfsxnkSJFihQpUqRIkSI95rNIj/ks0snpMJ+cRor0K65vvPrH+JlIr3gi0jA/5rNIkSJFihQpUqRIkR7zWaTHfBbp5HSYT04jRfoV1zde/WP8TKRXPBFpmB/zWaRIkSJFihQpUqRIj/ks0mM+i3RyOswnp5Ei/YrrG6/+MX4m0iueiDTMj/ksUqRIkSJFihQpUqTHfBbpMZ9FOjkd5pPTSJF+xatvfpHPIg3zMEd6xRMnp4/5LNIrnjg5HeZIkR7zWaRhjhQpUqRIkYY50ifX9k+8+pjPIg3zMEd6xRMnp4/5LNIrnjg5HeZIkR7zWaRhjhQpUqRIkYY50ifX9k+8+pjPIg3zMEd6xRMnp4/5LNIrnjg5HeZIkR7zWaRhjhQpUqRIkYY50ifX9k+8+pjPIg3zMEd6xRMnp4/5LNIrnjg5HeZIkR7zWaRhjhQpUqRIkYY50ifX9oRfGOZIj/ks0jAPc6RhHuZIkSJFinRyOsyRhnmYI0WKFOkxnz3ms0iRIkWKFOmTX/5v+A9+YZgjPeazSMM8zJGGeZgjRYoUKdLJ6TBHGuZhjhQpUqTHfPaYzyJFihQpUqRPfvm/4T/4hWGO9JjPIg3zMEca5mGOFClSpEgnp8McaZiHOVKkSJEe89ljPosUKVKkSJE++eX/hv/gF4Y50mM+izTMwxxpmIc5UqRIkSKdnA5zpGEe5kiRIkV6zGeP+SxSpEiRIkX65Nx+E88N82M+izTMwxwpUqTHfBZpmCMN8zBHijTMkU5OI0WKNMyRIg3z73C95dd+zHPD/JjPIg3zMEeKFOkxn0Ua5kjDPMyRIg1zpJPTSJEiDXOkSMP8O1xv+bUf89wwP+azSMM8zJEiRXrMZ5GGOdIwD3OkSMMc6eQ0UqRIwxwp0jD/Dtdbfu3HPDfMj/ks0jAPc6RIkR7zWaRhjjTMwxwp0jBHOjmNFCnSMEeKNMy/w/WWX4t0chop0jBHihQp0o95bpgjRYo0zI/5LFKkSMMcKVKkSJEiDXOkSMMc6U+6fsNfEenkNFKkYY4UKVKkH/PcMEeKFGmYH/NZpEiRhjlSpEiRIkUa5kiRhjnSn3T9hr8i0slppEjDHClSpEg/5rlhjhQp0jA/5rNIkSINc6RIkSJFijTMkSINc6Q/6foNf0Wkk9NIkYY5UqRIkX7Mc8McKVKkYX7MZ5EiRRrmSJEiRYoUaZgjRRrmSH/S09/wF0V6xRORTk4jRXrMZ5EiRYoUKVKkSCenkYZ5mE9OI52cRvoxz0U6OR3mT57+rV6K9IonIp2cRor0mM8iRYoUKVKkSJFOTiMN8zCfnEY6OY30Y56LdHI6zJ88/Vu9FOkVT0Q6OY0U6TGfRYoUKVKkSJEinZxGGuZhPjmNdHIa6cc8F+nkdJg/efq3einSK56IdHIaKdJjPosUKVKkSJEiRTo5jTTMw3xyGunkNNKPeS7Syekwf3JuDziN9IonhjlSpJPTk9OT00h/jJ85OT05jTTMwxwp0h/jZ75z3Xnp5DTSK54Y5kiRTk5PTk9OI/0xfubk9OQ00jAPc6RIf4yf+c5156WT00iveGKYI0U6OT05PTmN9Mf4mZPTk9NIwzzMkSL9MX7mO9edl05OI73iiWGOFOnk9OT05DTSH+NnTk5PTiMN8zBHivTH+JnvXHdeihQpUqRIJ6fDHOkxnw3zMEeKFClSpEgnp5EiRRrmSD/muUiRTk5PTiOdnEb65Ny+kCJFihTp5HSYIz3ms2Ee5kiRIkWKFOnkNFKkSMMc6cc8FynSyenJaaST00ifnNsXUqRIkSKdnA5zpMd8NszDHClSpEiRIp2cRooUaZgj/ZjnIkU6OT05jXRyGumTc/tCihQpUqST02GO9JjPhnmYI0WKFClSpJPTSJEiDXOkH/NcpEgnpyenkU5OI33y0/9+vzDMkSJFivSKJ4Z5mF/xRKRIkSJFGuZhjhQpUqST08d8NsyRIkWKNMyRvvPL/w3/wa8Nc6RIkSK94olhHuZXPBEpUqRIkYZ5mCNFihTp5PQxnw1zpEiRIg1zpO/88n/Df/BrwxwpUqRIr3himIf5FU9EihQpUqRhHuZIkSJFOjl9zGfDHClSpEjDHOk7v/zf8B/82jBHihQp0iueGOZhfsUTkSJFihRpmIc5UqRIkU5OH/PZMEeKFCnSMEf6zuO7f2COFOnkdJgjRYo0zJEiRYo0zJGGOdLJaaRIJ6fDHOnHPBcpUqST00gnp5E+efrf6aVhjhTp5HSYI0WKNMyRIkWKNMyRhjnSyWmkSCenwxzpxzwXKVKkk9NIJ6eRPnn63+mlYY4U6eR0mCNFijTMkSJFijTMkYY50slppEgnp8Mc6cc8FylSpJPTSCenkT55+t/ppWGOFOnkdJgjRYo0zJEiRYo0zJGGOdLJaaRIJ6fDHOnHPBcpUqST00gnp5E+Obd/YI70Y557zGeRIkWKFClSpEiRhvnHPPdjnhvmVzzxX+Env3PdeWmYI/2Y5x7zWaRIkSJFihQpUqRh/jHP/ZjnhvkVT/xX+MnvXHdeGuZIP+a5x3wWKVKkSJEiRYoUaZh/zHM/5rlhfsUT/xV+8jvXnZeGOdKPee4xn0WKFClSpEiRIkUa5h/z3I95bphf8cR/hZ/8zk//f/m1k9NIwxwpUqQf81ykSMMcaZiH+eQ0UqRIJ6eRTk4jRYo0zJGGOdLJaaRPHr118Asnp5GGOVKkSD/muUiRhjnSMA/zyWmkSJFOTiOdnEaKFGmYIw1zpJPTSJ88euvgF05OIw1zpEiRfsxzkSINc6RhHuaT00iRIp2cRjo5jRQp0jBHGuZIJ6eRPnn01sEvnJxGGuZIkSL9mOciRRrmSMM8zCenkSJFOjmNdHIaKVKkYY40zJFOTiN9cm7/wPyYzyJFGuaT00jDPMyRhjlSpFc8McyRIkWKFOkxnw1zpGGONMzDHGmYv3PdeWmYH/NZpEjDfHIaaZiHOdIwR4r0iieGOVKkSJEiPeazYY40zJGGeZgjDfN3rjsvDfNjPosUaZhPTiMN8zBHGuZIkV7xxDBHihQpUqTHfDbMkYY50jAPc6Rh/s5156VhfsxnkSIN88lppGEe5kjDHCnSK54Y5kiRIkWK9JjPhjnSMEca5mGONMzfue68dHIaKdJjPhvmx3wWaZgjnZwO88lppEi/lacjRRrmSJGGOdIwP+azYf7k3B5wGinSYz4b5sd8FmmYI52cDvPJaaRIv5WnI0Ua5kiRhjnSMD/ms2H+5NwecBop0mM+G+bHfBZpmCOdnA7zyWmkSL+VpyNFGuZIkYY50jA/5rNh/uTcHnAaKdJjPhvmx3wWaZgjnZwO88lppEi/lacjRRrmSJGGOdIwP+azYf7k6W94KdJjPjs5jRQpUqRIw3xyGunkNNLJaaRhjvSKJ4Y5UqRhjjTMkSJFijTMkSJ9cm1feSnSYz47OY0UKVKkSMN8chrp5DTSyWmkYY70iieGOVKkYY40zJEiRYo0zJEifXJtX3kp0mM+OzmNFClSpEjDfHIa6eQ00slppGGO9IonhjlSpGGONMyRIkWKNMyRIn1ybV95KdJjPjs5jRQpUqRIw3xyGunkNNLJaaRhjvSKJ4Y5UqRhjjTMkSJFijTMkSJ9cm1feSnSMEca5kiRTk4jDXOkYY4UKdJjPhvmSMM8zJEinZxGesxnkV7xxMlppEifPP2bvBRpmCMNc6RIJ6eRhjnSMEeKFOkxnw1zpGEe5kiRTk4jPeazSK944uQ0UqRPnv5NXoo0zJGGOVKkk9NIwxxpmCNFivSYz4Y50jAPc6RIJ6eRHvNZpFc8cXIaKdInT/8mL0Ua5kjDHCnSyWmkYY40zJEiRXrMZ8McaZiHOVKkk9NIj/ks0iueODmNFOmTp3+Tl05OIw3zMEca5kjDHClSpEjD/Ft5epiHOVKkk9PHfBbp5DTSYz4b5u88vnvAaaRhHuZIwxxpmCNFihRpmH8rTw/zMEeKdHL6mM8inZxGesxnw/ydx3cPOI00zMMcaZgjDXOkSJEiDfNv5elhHuZIkU5OH/NZpJPTSI/5bJi/8/juAaeRhnmYIw1zpGGOFClSpGH+rTw9zMMcKdLJ6WM+i3RyGukxnw3zd647L0WKdHI6zJGGeZgf89nJaaQ/xs9EGubHfBbpMZ+dnEaKFClSpEjDHOk7152XIkU6OR3mSMM8zI/57OQ00h/jZyIN82M+i/SYz05OI0WKFClSpGGO9J3rzkuRIp2cDnOkYR7mx3x2chrpj/EzkYb5MZ9FesxnJ6eRIkWKFCnSMEf6znXnpUiRTk6HOdIwD/NjPjs5jfTH+JlIw/yYzyI95rOT00iRIkWKFGmYI33nuvNSpEiRhnmYT06HeZgjDfMwR4r0Y557xRORIg3zMEeKNMyRIg1zpEiRTk6/c915KVKkSMM8zCenwzzMkYZ5mCNF+jHPveKJSJGGeZgjRRrmSJGGOVKkSCen37nuvBQpUqRhHuaT02Ee5kjDPMyRIv2Y517xRKRIwzzMkSINc6RIwxwpUqST0+9cd16KFCnSMA/zyekwD3OkYR7mSJF+zHOveCJSpGEe5kiRhjlSpGGOFCnSyel3Ht99If2Y54Y50jCfnEaK9JjPIr3iiWEe5pPTSCenr3giUqRhHuZIw/zJo//O/+GlSD/muWGONMwnp5EiPeazSK94YpiH+eQ00snpK56IFGmYhznSMH/y6L/zf3gp0o95bpgjDfPJaaRIj/ks0iueGOZhPjmNdHL6iiciRRrmYY40zJ88+u/8H16K9GOeG+ZIw3xyGinSYz6L9IonhnmYT04jnZy+4olIkYZ5mCMN8yeP/jsPfiHSMD/ms0iRTk4jRYr0mM8iRYp0cjrMJ6fDHOkxnw1zpEjDHGmYI0X6FW+++covRxrmx3wWKdLJaaRIkR7zWaRIkU5Oh/nkdJgjPeazYY4UaZgjDXOkSL/izTdf+eVIw/yYzyJFOjmNFCnSYz6LFCnSyekwn5wOc6THfDbMkSINc6RhjhTpV7z55iu/HGmYH/NZpEgnp5EiRXrMZ5EiRTo5HeaT02GO9JjPhjlSpGGONMyRIv2KN9/8hL90mIf5MZ8Nc6RIkSINc6RIwxwp0m/l6ZPTYY40zMMcKVKkYR7mT67tT/AXDfMwP+azYY4UKVKkYY4UaZgjRfqtPH1yOsyRhnmYI0WKNMzD/Mm1/Qn+omEe5sd8NsyRIkWKNMyRIg1zpEi/ladPToc50jAPc6RIkYZ5mD+5tj/BXzTMw/yYz4Y5UqRIkYY5UqRhjhTpt/L0yekwRxrmYY4UKdIwD/Mn5/aFdHIaKVKkYR7mSMM8zMM8zJEiRfo/yZ8Y6RVPRIo0zJEiRRrmSJE+ObcvpJPTSJEiDfMwRxrmYR7mYY4UKdL/Sf7ESK94IlKkYY4UKdIwR4r0ybl9IZ2cRooUaZiHOdIwD/MwD3OkSJH+T/InRnrFE5EiDXOkSJGGOVKkT87tC+nkNFKkSMM8zJGGeZiHeZgjRYr0f5I/MdIrnogUaZgjRYo0zJEifXJu/8Ac6eR0mB/zWaRIkSK94olIkV7xxDBHGuZIwzzMkSINc6RhjjTMkSJFihTpk3P7B+ZIJ6fD/JjPIkWKFOkVT0SK9IonhjnSMEca5mGOFGmYIw1zpGGOFClSpEifnNs/MEc6OR3mx3wWKVKkSK94IlKkVzwxzJGGOdIwD3OkSMMcaZgjDXOkSJEiRfrk3P6BOdLJ6TA/5rNIkSJFesUTkSK94olhjjTMkYZ5mCNFGuZIwxxpmCNFihQp0ifn9g/MkR7z2WM+i3RyGunkNNJjPot0cjrMkSINc6RIw3xyGmmYI52cRhrmSN+57rw0zJEe89ljPot0chrp5DTSYz6LdHI6zJEiDXOkSMN8chppmCOdnEYa5kjfue68NMyRHvPZYz6LdHIa6eQ00mM+i3RyOsyRIg1zpEjDfHIaaZgjnZxGGuZI37nuvDTMkR7z2WM+i3RyGunkNNJjPot0cjrMkSINc6RIw3xyGmmYI52cRhrmSN95fPcPzD/muUiRIg1zpGGOFClSpGGOFGmYI0V6xRORTk6HOVKkYY4UaZgjDXOk7zy++wfmH/NcpEiRhjnSMEeKFCnSMEeKNMyRIr3iiUgnp8McKdIwR4o0zJGGOdJ3Ht/9A/OPeS5SpEjDHGmYI0WKFGmYI0Ua5kiRXvFEpJPTYY4UaZgjRRrmSMMc6TuP7/6B+cc8FylSpGGONMyRIkWKNMyRIg1zpEiveCLSyekwR4o0zJEiDXOkYY70nad3/8SvRRrmk9NIkYY50snpK54Y5lc88ZjPIkV6xRPDHCnSH+NnvvPL/+/+g1+LNMwnp5EiDXOkk9NXPDHMr3jiMZ9FivSKJ4Y5UqQ/xs9855f/3/0HvxZpmE9OI0Ua5kgnp694Yphf8cRjPosU6RVPDHOkSH+Mn/nOL/+/+w9+LdIwn5xGijTMkU5OX/HEML/iicd8FinSK54Y5kiR/hg/851f/n/3G/lLI52cDnOkYY40zMMcKVKkk9NIkSINc6RIwzzMkSINc6RIJ6eRTk4jffLorT/EXxfp5HSYIw1zpGEe5kiRIp2cRooUaZgjRRrmYY4UaZgjRTo5jXRyGumTR2/9If66SCenwxxpmCMN8zBHihTp5DRSpEjDHCnSMA9zpEjDHCnSyWmkk9NInzx66w/x10U6OR3mSMMcaZiHOVKkSCenkSJFGuZIkYZ5mCNFGuZIkU5OI52cRvrk3P4ATw/zMA9zpEiRTk5PToc5UqRIkYb5MZ9FivSYzyJFGuZIkSJFijTMkb5z3Xnpt/L0MA/zMEeKFOnk9OR0mCNFihRpmB/zWaRIj/ksUqRhjhQpUqRIwxzpO9edl34rTw/zMA9zpEiRTk5PToc5UqRIkYb5MZ9FivSYzyJFGuZIkSJFijTMkb5z3Xnpt/L0MA/zMEeKFOnk9OR0mCNFihRpmB/zWaRIj/ksUqRhjhQpUqRIwxzpO9edlyK94olIkSKdnEaKFOnkNNJjPhvmk9M/xs9EihQp0jBHihTp5DTS73C95dciveKJSJEinZxGihTp5DTSYz4b5pPTP8bPRIoUKdIwR4oU6eQ00u9wveXXIr3iiUiRIp2cRooU6eQ00mM+G+aT0z/Gz0SKFCnSMEeKFOnkNNLvcL3l1yK94olIkSKdnEaKFOnkNNJjPhvmk9M/xs9EihQp0jBHihTp5DTS73C95dciRTo5jRQp0mM+ixTpxzw3zJF+zHOP+SzSMA/zyekwR/qv8JOfnNsXUqST00iRIj3ms0iRfsxzwxzpxzz3mM8iDfMwn5wOc6T/Cj/5ybl9IUU6OY0UKdJjPosU6cc8N8yRfsxzj/ks0jAP88npMEf6r/CTn5zbF1Kkk9NIkSI95rNIkX7Mc8Mc6cc895jPIg3zMJ+cDnOk/wo/+cm5fSFFOjmNFCnSMA/zMA9zpEiR/hg/E2mYh/nkdJhf8USkSMMcKVKkSJGG+ZNz+0KKdHIaKVKkYR7mYR7mSJEi/TF+JtIwD/PJ6TC/4olIkYY5UqRIkSIN8yfn9oUU6eQ0UqRIwzzMwzzMkSJF+mP8TKRhHuaT02F+xRORIg1zpEiRIkUa5k/O7Qsp0slppEiRhnmYh3mYI0WK9Mf4mUjDPMwnp8P8iiciRRrmSJEiRYo0zJ+c2xdSpJPTSJEiPeazYY40zJGGOdIwR4p0chopUqRIkSJF+q08HSlSpEjDHCnSyekn5/aFFOnkNFKkSI/5bJgjDXOkYY40zJEinZxGihQpUqRIkX4rT0eKFCnSMEeKdHL6ybl9IUU6OY0UKdJjPhvmSMMcaZgjDXOkSCenkSJFihQpUqTfytORIkWKNMyRIp2cfnJuX0iRTk4jRYr0mM+GOdIwRxrmSMMcKdLJaaRIkSJFihTpt/J0pEiRIg1zpEgnp5+c2xfSK56IdHL6iieGeZgjRYoUKdIwD3OkSI/5LFKkSMMc6eR0mCNFGuZhjvSd685LkV7xRKST01c8MczDHClSpEiRhnmYI0V6zGeRIkUa5kgnp8McKdIwD3Ok71x3Xor0iicinZy+4olhHuZIkSJFijTMwxwp0mM+ixQp0jBHOjkd5kiRhnmYI33nuvNSpFc8Eenk9BVPDPMwR4oUKVKkYR7mSJEe81mkSJGGOdLJ6TBHijTMwxzpO9edl34rT0c6OR3mSMN8cjrMv5WnI0U6OY00zJEiDfMwR4oUKdIrnvgV1zde/a08HenkdJgjDfPJ6TD/Vp6OFOnkNNIwR4o0zMMcKVKkSK944ldc33j1t/J0pJPTYY40zCenw/xbeTpSpJPTSMMcKdIwD3OkSJEiveKJX3F949XfytORTk6HOdIwn5wO82/l6UiRTk4jDXOkSMM8zJEiRYr0iid+xZtv/vrrf9Hff7J//cv8/Sf717/M33+yf/3L/P0n+9e/zN9/sn/9y/z9J/vXv8zff7J//cv8/Sf717/K//t//z9oB/bNaom4pAAAAABJRU5ErkJggg==" width="180" height="180" alt="qrcode">
                                                </div>
                                            </div>
                                            <div class="qrcode-cont">
                                                <div class="qrcode-title">@lang('payment.vnpay.payment_online')</div>

                                                <div class="price text-center">${{ number_format($totalPrice) }}</div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info">@lang('payment.vnpay.confirm')</button>
                                        <div class="or clearfix">
                                            <span>@lang('payment.vnpay.or')</span>
                                        </div>
                                        <div class="form-group btn-cancel clearfix">
                                            <button type="button" onclick="cancel()" class="btn btn-default form-control"
                                                id="btnCancel" name="btnCancel">
                                                @lang('payment.vnpay.cancel')
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($data['typePayment'] == config('payment.payment.type.atm'))
                    <div class="tknh">
                        <div class="section-body-middle-form-p1 nopadding no-border">
                            <div class="wrap">
                                <button type="button" class="btn-list-option collapsed paytype-localbank" data-toggle="collapse"
                                    data-target="#tab1" aria-expanded="false">
                                    <h3>@lang('payment.atm.list_bank')</h3>
                                    <div class="triangle-border"></div>
                                    <span class="arrow">
                                        <img src="{{ asset('images/payment/ic-arrow.svg') }}">
                                    </span>
                                </button>
                                <div id="tab1" class="list-option-collapse collapse show" aria-expanded="true" style="height: 1px;">
                                    <div class="collapse-wrap">
                                        <ul class="list_cart-2 clearfix">
                                            <li>
                                                <label for="VIETCOMBANK">
                                                    <input type="button" onclick="bank(this.value)" value="VIETCOMBANK"
                                                        id="VIETCOMBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/vietcombank_logo.png') }}" width="200" height="40"
                                                        alt="VIETCOMBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="VIETINBANK">
                                                    <input type="button" onclick="bank(this.value)" value="VIETINBANK" id="VIETINBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/vietinbank_logo.png') }}" width="200" height="40"
                                                        alt="VIETINBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="BIDV">
                                                    <input type="button" onclick="bank(this.value)" value="BIDV" id="BIDV" name="paymethod"><img
                                                        src="{{ asset('images/payment/bidv_logo.png') }}" width="200" height="40" alt="BIDV"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="AGRIBANK">
                                                    <input type="button" onclick="bank(this.value)" value="AGRIBANK" id="AGRIBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/agribank_logo.png') }}" width="200" height="40"
                                                        alt="AGRIBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="SACOMBANK">
                                                    <input type="button" onclick="bank(this.value)" value="SACOMBANK" id="SACOMBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/sacombank_logo.png') }}" width="200" height="40"
                                                        alt="SACOMBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="TECHCOMBANK">
                                                    <input type="button" onclick="bank(this.value)" value="TECHCOMBANK" id="TECHCOMBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/techcombank_logo.png') }}" width="200" height="40"
                                                        alt="TECHCOMBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="ACB">
                                                    <input type="button" onclick="bank(this.value)" value="ACB" id="ACB" name="paymethod"><img
                                                        src="{{ asset('images/payment/acb_logo.png') }}" width="200" height="40" alt="ACB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="VPBANK">
                                                    <input type="button" onclick="bank(this.value)" value="VPBANK" id="VPBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/vpbank_logo.png') }}" width="200" height="40" alt="VPBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="DONGABANK">
                                                    <input type="button" onclick="bank(this.value)" value="DONGABANK" id="DONGABANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/dongabank_logo.png') }}" width="200" height="40"
                                                        alt="DONGABANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="EXIMBANK">
                                                    <input type="button" onclick="bank(this.value)" value="EXIMBANK" id="EXIMBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/eximbank_logo.png') }}" width="200" height="40"
                                                        alt="EXIMBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="TPBANK">
                                                    <input type="button" onclick="bank(this.value)" value="TPBANK" id="TPBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/tpbank_logo.png') }}" width="200" height="40" alt="TPBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="NCB">
                                                    <input type="button" onclick="bank(this.value)" value="NCB" id="NCB" name="paymethod"><img
                                                        src="{{ asset('images/payment/ncb_logo.png') }}" width="200" height="40" alt="NCB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="OJB">
                                                    <input type="button" onclick="bank(this.value)" value="OJB" id="OJB" name="paymethod"><img
                                                        src="{{ asset('images/payment/oceanbank_logo.png') }}" width="200" height="40" alt="OJB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="MSBANK">
                                                    <input type="button" onclick="bank(this.value)" value="MSBANK" id="MSBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/msbank_logo.png') }}" width="200" height="40" alt="MSBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="HDBANK">
                                                    <input type="button" onclick="bank(this.value)" value="HDBANK" id="HDBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/hdbank_logo.png') }}" width="200" height="40" alt="HDBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="NAMABANK">
                                                    <input type="button" onclick="bank(this.value)" value="NAMABANK" id="NAMABANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/namabank_logo.png') }}" width="200" height="40"
                                                        alt="NAMABANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="OCB">
                                                    <input type="button" onclick="bank(this.value)" value="OCB" id="OCB" name="paymethod"><img
                                                        src="{{ asset('images/payment/ocb_logo.png') }}" width="200" height="40" alt="OCB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="SCB">
                                                    <input type="button" onclick="bank(this.value)" value="SCB" id="SCB" name="paymethod"><img
                                                        src="{{ asset('images/payment/scb_logo.png') }}" width="200" height="40" alt="SCB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="IVB">
                                                    <input type="button" onclick="bank(this.value)" value="IVB" id="IVB" name="paymethod"><img
                                                        src="{{ asset('images/payment/ivb_logo.png') }}" width="200" height="40" alt="IVB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="ABBANK">
                                                    <input type="button" onclick="bank(this.value)" value="ABBANK" id="ABBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/abb_logo.png') }}" width="200" height="40" alt="ABBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="MBBANK">
                                                    <input type="button" onclick="bank(this.value)" value="MBBANK" id="MBBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/mbbank_logo.png') }}" width="200" height="40" alt="MBBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="SHB">
                                                    <input type="button" onclick="bank(this.value)" value="SHB" id="SHB" name="paymethod"><img
                                                        src="{{ asset('images/payment/shb_logo.png') }}" width="200" height="40" alt="SHB"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="BACABANK">
                                                    <input type="button" onclick="bank(this.value)" value="BACABANK" id="BACABANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/bacabank_logo.png') }}" width="200" height="40"
                                                        alt="BACABANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="PVCOMBANK">
                                                    <input type="button" onclick="bank(this.value)" value="PVCOMBANK" id="PVCOMBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/pvcombank_logo.png') }}" width="200" height="40"
                                                        alt="PVCOMBANK"/>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="SAIGONBANK">
                                                    <input type="button" onclick="bank(this.value)" value="SAIGONBANK" id="SAIGONBANK" name="paymethod"><img
                                                        src="{{ asset('images/payment/saigonbank_logo.png') }}" width="200" height="40"
                                                        alt="SAIGONBANK"/>
                                                </label>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border mt-5">
                            <h3 class="d-flex justify-content-center mt-3" id="bank-name">Vietcombank</h3>
                            <div class="form-group clearfix has-feedback m-5">
                                <label class="sr-only" for="card_number">@lang('payment.atm.account_number')</label>
                                <input type="text" class="form-control" name="account_number" id="card_number"
                                    placeholder="@lang('payment.atm.account_number')" maxlength="20" data-bv-field="card_number">
                            </div>
                            <div class="form-group clearfix has-feedback m-5">
                                <label class="sr-only" for="card_holder_acc">@lang('payment.atm.account_holder_name')</label>
                                <input type="text" class="form-control" name="card_holder_acc" id="card_holder_acc"
                                    placeholder="@lang('payment.atm.account_holder_name')" maxlength="35"
                                    data-bv-field="card_holder_acc">
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" onclick="confirmCode()" class="btn btn-info">
                                    @lang('payment.vnpay.confirm')
                                </button>
                            </div>
                            <div class="or clearfix">
                                <span>@lang('payment.vnpay.or')</span>
                            </div>
                            <div class="form-group btn-cancel clearfix">
                                <button type="button" onclick="cancel()" class="btn btn-default form-control"
                                    id="btnCancel" name="btnCancel">
                                    @lang('payment.vnpay.confirm')
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="order-btn justify-content-center d-flex">
                        <button type="submit" @if (!isset($cart)) disabled="" @endif class="site-btn place-btn mt-5">
                            {{ trans('text.place_order') }}</button>
                    </div>
                @endif
            </form>
        </div>
    </section>
    <script type="text/javascript">
        function cancel()
        {
            var kt = confirm("Do you want to cancel this order?");
            if (kt == true) {
                window.location="http://127.0.0.1:8000/carts";
            }
        }

        function confirmCode()
        {
            let re = prompt("Please enter code:");

            if (re == '12345') {
                $('#form-payment').submit();
            } else if (re != null) {
                alert('Code wrong, please try again!');
            }
        }

        function bank(e)
        {
            $('#bank-name').text(e);
        }
    </script>
@endsection
