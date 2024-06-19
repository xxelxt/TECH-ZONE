<div class="email-content">
	<h1>Xác nhận đơn hàng</h1>
	<p style="font-size: 15px;">Xin chào {{ $order->lastname }} {{ $order->firstname }},</p>
	<p style="font-size: 15px;">Cảm ơn bạn đã đặt hàng tại TechZone!</p>

	<h2>Thông tin đơn hàng #{{ $order->id }}:</h2>
	<p style="font-size: 15px;">Ngày đặt: {{ $order->created_at }}</p>
	<p style="font-size: 15px;">Tổng tiền: {{ number_format($order->total) }}đ</p>
	<p style="font-size: 15px;">Trạng thái thanh toán:
		@if ($order->payment_status == 1)
		Chưa thanh toán
		@else
		Đã thanh toán
		@endif
	</p>

	<h2>Chi tiết đơn hàng:</h2>
	<table class="table table-bordered" style="width: 100%; border-collapse: collapse; font-size: 15px">
		<thead>
			<tr>
				<th style="border: 1px solid #dee2e6; padding: 8px;">Sản phẩm</th>
				<th style="border: 1px solid #dee2e6; padding: 8px;">Số lượng</th>
				<th style="border: 1px solid #dee2e6; padding: 8px;">Giá</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orders_detail as $item)
			<tr>
				<td style="border: 1px solid #dee2e6; padding: 8px;">{{ $item->name }}</td>
				<td style="border: 1px solid #dee2e6; padding: 8px; text-align: right;">{{ $item->quantity }}</td>
				<td style="border: 1px solid #dee2e6; padding: 8px; text-align: right;">{{ number_format($item->price) }}đ</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<p style="font-size: 15px;">Bạn có thể xem chi tiết đơn hàng của mình tại <a href="{{ $body }}">đây</a>.</p>
</div>