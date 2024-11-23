<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{trans('reminder.title')}}</title>
</head>
<body>
<h1>{{trans('reminder.title')}}</h1>

<p>{{trans('reminder.business_name')}} {{ $businessName }}</p>
<p>{{trans('reminder.order_type')}} {{ $orderType }}</p>
<p>{{trans('reminder.expiration_date')}} {{ $expirationDate }}</p>
<p>{{trans('reminder.reminder_date')}} {{ $reminderDate }}</p>
<p>{{ $customText }}</p>
</body>
</html>
