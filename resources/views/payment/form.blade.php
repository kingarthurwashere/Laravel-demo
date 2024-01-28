<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>

<body>
    <form action="/payment/charge" method="post">
        @csrf
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount" required>
        <button type="submit">Pay Now</button>
    </form>
</body>

</html>