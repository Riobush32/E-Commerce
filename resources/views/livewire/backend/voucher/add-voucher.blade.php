<div @click.outside="formAddVoucher=false">
    @if (session()->has('message'))
        <div class="fixed right-32 w-96 top-32 z-30 alert alert-success flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="btn btn-sm btn-circle" onclick="this.parentElement.remove()">✕</button>
        </div>
    @endif
    <div class="ralative card bg-base-100 w-[800px] shadow-xl">
        <button @click="formAddVoucher = false" class="absolute top-5 right-5 btn btn-circle btn-outline btn-xs">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <form wire:submit="saveNewVoucher" class="card-body max-h-[70vh] overflow-auto">
            <h2 class="card-title">Add New Voucher</h2>
            <div class="">
                <div class="grid grid-cols-3 gap-8 mt-3 ">
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend mb-2 text-sm">Voucher Name</legend>
                        <input wire:model.live="voucherName" type="text" class="input input-sm w-full" placeholder="Type here" />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend mb-2 text-sm">Poins Reqiured</legend>
                        <input wire:model.live="voucherPoins" min=1 type="number" class="input input-sm w-full" placeholder="Type here" />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend mb-2 text-sm">Minimal Purchase</legend>
                        <input wire:model.live="voucher_min_purchase" class="input input-sm w-full join-item " oninput="formatCurrency(this)"
                            placeholder="Type here" />
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend mb-2 text-sm">Discount Type</legend>
                        <select wire:model.live="voucher_discount_type" class="select select-ghost select-sm">
                            <option selected value="">Pick a Type</option>
                            <option value="percentage">Percentage (%)</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </fieldset>
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend mb-2 text-sm">Discount Value</legend>
                        <input wire:model.live="voucher_discount_value" type="text" class="input input-sm w-full" placeholder="Type here" value=""
                            {{ empty($voucher_discount_type) ? 'disabled' : '' }} {!! $voucher_discount_type == 'fixed'
                                ? 'oninput="formatCurrency(this)"'
                                : ($voucher_discount_type == 'percentage'
                                    ? 'oninput="formatPercentage(this)" onblur="formatPercentage(this)"'
                                    : '') !!} />

                    </fieldset>
                </div>
                <hr class="my-5">
                <div class="w-full flex justify-center mt-10 ">
                    <h1 class="underline text-xl">Voucher Validated</h1>
                </div>
                <p>
                    <span>Dari :</span><span class="text-green-400"> {{ $voucher_valid_from }}</span>
                </p>
                <p>
                    <span>Sampai :</span> <span class="text-red-400"> {{ $voucher_valid_until }}</span>
                </p>
                <div class="w-full flex justify-center mt-10 ">
                    <calendar-range id="myRangeCalendar" months="2">
                        <div class="flex gap-4 justify-center flex-wrap">
                            <calendar-month></calendar-month>
                            <calendar-month offset="1"></calendar-month>
                        </div>
                    </calendar-range>
                </div>
            </div>

            <div class="card-actions justify-end">
                <button type="submit"
                    class="btn btn-sm text-white tracking-widest font-light btn-primary">Save</button>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("myRangeCalendar").addEventListener("change", (event) => {
                let dates = event.target.value.split("/"); // Memisahkan tanggal awal & akhir
                let startDate = dates[0]; // Tanggal awal
                let endDate = dates[1]; // Tanggal akhir

                @this.set('voucher_valid_from', startDate);
                @this.set('voucher_valid_until', endDate);
            });
        });
    </script>
</div>
