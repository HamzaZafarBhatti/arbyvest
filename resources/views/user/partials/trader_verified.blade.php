<div class="verified">
    <h5 class="text-success">
        VERIFIED and APPROVED as a TRADER
    </h5>
    <ul class="text-primary">
        <li>Full Name: {{ $trader->name }}</li>
        <li>WhatsApp Number: {{ $trader->phone }}</li>
        <li>Phone Number: {{ $trader->phone }}</li>
        <li>Available USD Balance: {{ $trader->get_usd_wallet }}</li>
        <li>Available GBP Balance: {{ $trader->get_gbp_wallet }}</li>
    </ul>
</div>
