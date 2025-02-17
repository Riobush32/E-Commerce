<div>
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="card bg-base-100 w-[900px] shadow-xl h-[70vh] p-5">
            <div class="border-2 border-dashed p-3 rounded-xl border-cyan-400">
                <div class="">
                    <h1>Edit Product</h1>
                </div>
            </div>
            <div class="border-2 border-dashed p-3 rounded-xl overflow-auto border-cyan-400 mt-3">
                <div class="w-full flex justify-center">
                    <div class="flex flex-wrap gap-4 w-auto">
                        <label class="form-control max-w-xs">
                            <div class="label">
                                <span class="label-text">Product Name</span>
                            </div>
                            <input type="text" placeholder="Type here"
                                class="input input-sm input-bordered w-full max-w-xs" />
                        </label>
                        <label class="form-control  max-w-xs">
                            <div class="label">
                                <span class="label-text">Product Price</span>
                            </div>
                            <div class="join">
                                <p class="btn btn-sm join-item rounded-l-full">Rp</p>
                                <input oninput="formatCurrency(this)" class="input input-sm input-bordered join-item"
                                    placeholder="120.000" />

                            </div>
                        </label>
                        <label class="form-control  max-w-xs">
                            <div class="label">
                                <span class="label-text">Product Name</span>
                            </div>
                            <input type="text" placeholder="Type here"
                                class="input input-sm input-bordered w-full max-w-xs" />
                        </label>
                        <label class="form-control  max-w-xs">
                            <div class="label">
                                <span class="label-text">Category Product</span>
                            </div>
                            <select class="select select-bordered select-sm w-full max-w-xs">
                                <option disabled selected>Small</option>
                                <option>Small Apple</option>
                                <option>Small Orange</option>
                                <option>Small Tomato</option>
                            </select>
                        </label>
                        <label class="form-control  max-w-xs">
                            <div class="label">
                                <span class="label-text">Brand Product</span>
                            </div>
                            <select class="select select-bordered select-sm w-full max-w-xs">
                                <option disabled selected>Small</option>
                                <option>Small Apple</option>
                                <option>Small Orange</option>
                                <option>Small Tomato</option>
                            </select>
                        </label>
                        <input type="hidden" class="bg-white" id="contentDescriptionEdit" wire:model.live="description">
                        <input type="hidden" class="bg-white" id="contentInfoEdit" wire:model.live="info">
                    </div>
                </div>
                <div class="" wire:ignore>
                    <div class="mt-3">
                        <h1>Description</h1>
                        <div id="editorForEditDescription">taruh disini nanti</div>
                    </div>
                    <div class="mt-3">
                        <h1>Info</h1>
                        <div id="editorForEditInfo">taruh disini nanti</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var quill = new Quill("#editorForEditDescription", {
            theme: "snow",
            placeholder: "Tulis sesuatu...",
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ["bold", "italic", "underline"],
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }],
                    ["link", "image"]
                ]
            }
        });

        // Sinkronkan Quill ke input hidden sebelum form dikirim
        quill.on("text-change", function() {
            let content = quill.root.innerHTML;
            document.querySelector("#contentDescriptionEdit").value = content;
            console.log("Quill content:", content);

            Livewire.dispatch("setInfo", {
                value: content
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var quill = new Quill("#editorForEditInfo", {
            theme: "snow",
            placeholder: "Tulis sesuatu...",
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ["bold", "italic", "underline"],
                    [{
                        list: "ordered"
                    }, {
                        list: "bullet"
                    }],
                    ["link", "image"]
                ]
            }
        });

        // Sinkronkan Quill ke input hidden sebelum form dikirim
        quill.on("text-change", function() {
            let content = quill.root.innerHTML;
            document.querySelector("#contentInfoEdit").value = content;
            console.log("Quill content:", content);

            Livewire.dispatch("setInfo", {
                value: content
            });
        });
    });
</script>
