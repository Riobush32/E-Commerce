<x-layouts-main>
    <x-flash-message></x-flash-message>

    <div>
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-nXz52zyvp-SU88J-"></script>
        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
        <div class="w-full flex item-center  justify-center">
            <button id="pay-button"
                class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Pay!</button>
        </div>
        {{-- <div class="w-full flex item-center  justify-center">

            <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
            <div id="snap-container"></div>
        </div> --}}


        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            var snapToken = @json($summary->snap_token);
            payButton.addEventListener('click', function() {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
                // Also, use the embedId that you defined in the div above, here.
                // window.snap.embed(snapToken, {
                //     embedId: 'snap-container'
                // });
                window.snap.pay(snapToken, {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        window.location.href = `{{ route('checkoutSuccses', ['id' => $summary->id]) }}`
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
                        console.log(result);
                    },
                    onError: function(result) {
                        /* You may add your own implementation here */
                        alert("payment failed!");
                        console.log(result);
                    },
                    onClose: function() {
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                })
            });
        </script>
    </div>

</x-layouts-main>
