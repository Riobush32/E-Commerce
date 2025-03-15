<div>
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <div class="flex justify-center flex-col items-center">
        <p class="text-center text-xl ">
            Tekan Pay untuk melanjutkan pemabayaran
        </p>

        <button id="pay-button">Pay!</button>
    </div>
    

    <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
    <div id="snap-container"></div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
            // Also, use the embedId that you defined in the div above, here.
            window.snap.embed('YOUR_SNAP_TOKEN', {
                embedId: 'snap-container'
            });
        });
    </script>
</div>
