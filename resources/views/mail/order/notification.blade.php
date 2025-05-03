<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');
    </style>
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #f9fafb; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <div style="padding: 30px; text-align: center; border-bottom: 1px solid #e5e7eb;">
            <h1 style="font-size: 24px; font-weight: 600; color: #111827; margin: 0;">New Order Received</h1>
            <p style="font-size: 14px; color: #6b7280; margin-top: 8px;">You have a new order in your store!</p>
        </div>
        
        <div style="padding: 30px;">
            <h2 style="font-size: 18px; font-weight: 500; color: #111827; margin-bottom: 20px;">Order #{{ $order->id }}</h2>
            
            <div style="margin-bottom: 25px;">
                <p style="font-size: 14px; color: #4b5563; margin: 5px 0;"><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p style="font-size: 14px; color: #4b5563; margin: 5px 0;"><strong>Customer Name:</strong> {{ $order->customer->user->fname }}</p>
            </div>
            
            <div style="border: 1px solid #e5e7eb; border-radius: 6px; overflow: hidden;">
                @foreach ($order->productvariants as $item)
                <div style="display: flex; padding: 15px; border-bottom: 1px solid #e5e7eb; background-color: #fafafa;">
                    <div style="width: 80px; height: 80px; flex-shrink: 0; margin-right: 15px;">
                        <img src="{{ $item->images[0]->path }}" alt="product image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 4px;">
                    </div>
                    <div style="flex-grow: 1;">
                        <p style="font-size: 14px; font-weight: 500; color: #111827; margin: 0 0 5px 0;">{{ $item->name }}</p>
                        <p style="font-size: 12px; color: #6b7280; margin: 0;">Qty: {{ $item->pivot->quantity }}</p>
                    </div>
                    <div style="width: 60px; text-align: right;">
                        <p style="font-size: 14px; font-weight: 500; color: #111827; margin: 0;">${{ $item->price }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div style="margin-top: 20px; text-align: right;">
                <div style="display: inline-block; text-align: left;">
                    <p style="font-size: 16px; font-weight: 500; color: #111827; margin: 10px 0 0 0;"><strong>Total:</strong> ${{ $order->price }}</p>
                </div>
            </div>
        </div>
        
        <div style="padding: 20px 30px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
            <h3 style="font-size: 16px; font-weight: 500; color: #111827; margin-bottom: 10px;">View Order Details</h3>
            <p style="font-size: 14px; color: #4b5563; margin: 0 0 15px 0;">You can manage this order in your store dashboard:</p>
            <a href="http://sellora.local" style="display: inline-block; padding: 10px 20px; background-color: #111827; color: white; text-decoration: none; font-size: 14px; border-radius: 4px;">View Order</a>
        </div>
        
        <div style="padding: 20px 30px; text-align: center; background-color: #f3f4f6;">
            <p style="font-size: 12px; color: #6b7280; margin: 0 0 10px 0;">Need help? Contact support at <a href="mailto:support@sellora.com" style="color: #111827; text-decoration: underline;">support@sellora.com</a></p>
            <p style="font-size: 12px; color: #6b7280; margin: 0;">© {{ date('Y') }} Sellora. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
