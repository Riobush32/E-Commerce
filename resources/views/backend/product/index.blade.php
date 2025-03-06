<x-layouts-backend>
    <x-slot:active>{{ $active }}</x-slot:active>
    <div x-data="{ formAddProduct: false, showDetailProduct: false }" class="">
        @include('backend.components.breadcrumbs')

        @livewire('backend.product.product-list')
        <div x-show="formAddProduct" class="fixed inset-0 flex items-center justify-center">
            @livewire('backend.product.add-product')
        </div>
        @livewire('backend.product.detail-product')

    </div>
    <script>
        document.addEventListener('livewire:init', () => {
            console.log("Halaman dimuat pertama kali");
            // setupEvents();
            Livewire.on('reloadJavaScript', (event) => {
                console.log("Livewire event diterima. Menjalankan ulang kode JavaScript.");
                setTimeout(function() {
                    setupEvents();
                    setEditDescription();
                    setEditInfo();
                }, 1500);

            });
            Livewire.on('reloadScriptVariant', (event) => {
                console.log("Livewire event diterima. Menjalankan ulang kode JavaScript Variant.");
                setTimeout(function() {
                    setupVariant();
                }, 1500);

            });
        });

        function setupEvents() {
            console.log('setup');
            const dropzone = document.getElementById("dropzone");
            const fileInput = document.getElementById("fileInput");
            // Pastikan dropzone ditemukan
            if (!dropzone) {
                console.error("Dropzone element tidak ditemukan!");
            } else {
                console.log("Dropzone ditemukan:", dropzone);
            }

            dropzone.addEventListener("click", () => fileInput.click());

            dropzone.addEventListener("dragover", (event) => {
                event.preventDefault();
                dropzone.classList.add("border-blue-500");
            });

            dropzone.addEventListener("dragleave", () => {
                dropzone.classList.remove("border-blue-500");
            });

            dropzone.addEventListener("drop", (event) => {
                event.preventDefault();
                dropzone.classList.remove("border-blue-500");

                if (event.dataTransfer.files.length > 0) {
                    let file = event.dataTransfer.files[0];

                    // Upload file ke Livewire
                    Livewire.find(dropzone.closest("[wire\\:id]").getAttribute("wire:id"))
                        .upload("productImage", file,
                            (uploadedFilename) => {
                                console.log("Upload sukses:", uploadedFilename);
                            },
                            (error) => {
                                console.error("Upload gagal:", error);
                            }
                        );
                }
            });

            fileInput.addEventListener("change", function() {
                if (fileInput.files.length > 0) {
                    let file = fileInput.files[0];

                    Livewire.find(dropzone.closest("[wire\\:id]").getAttribute("wire:id"))
                        .upload("productImage", file);
                }
            });
        }

        function setupVariant() {
            console.log('setupVariant');
            const dropzoneVariant = document.getElementById("dropzoneVariant");
            const variantInput = document.getElementById("variantInput");
            // Pastikan dropzoneVariant ditemukan
            if (!dropzoneVariant) {
                console.error("dropzoneVariant element tidak ditemukan!");
            } else {
                console.log("dropzoneVariant ditemukan:", dropzoneVariant);
            }

            dropzoneVariant.addEventListener("click", () => variantInput.click());

            dropzoneVariant.addEventListener("dragover", (event) => {
                event.preventDefault();
                dropzoneVariant.classList.add("border-blue-500");
            });

            dropzoneVariant.addEventListener("dragleave", () => {
                dropzoneVariant.classList.remove("border-blue-500");
            });

            dropzoneVariant.addEventListener("drop", (event) => {
                event.preventDefault();
                dropzoneVariant.classList.remove("border-blue-500");

                if (event.dataTransfer.files.length > 0) {
                    let file = event.dataTransfer.files[0];

                    // Upload file ke Livewire
                    Livewire.find(dropzoneVariant.closest("[wire\\:id]").getAttribute("wire:id"))
                        .upload("variantImage", file,
                            (uploadedFilename) => {
                                console.log("Upload sukses:", uploadedFilename);
                            },
                            (error) => {
                                console.error("Upload gagal:", error);
                            }
                        );
                }
            });

            variantInput.addEventListener("change", function() {
                if (variantInput.files.length > 0) {
                    let file = variantInput.files[0];

                    Livewire.find(dropzoneVariant.closest("[wire\\:id]").getAttribute("wire:id"))
                        .upload("variantImage", file);
                }
            });
        }
    </script>
    <script>
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ""); // Hapus semua karakter non-angka
            value = new Intl.NumberFormat("id-ID", {
                style: "decimal"
            }).format(value);
            input.value = value;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quill = new Quill("#editor", {
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
                document.querySelector("#content").value = content;
                console.log("Quill content:", content);

                Livewire.dispatch("setDescription", {
                    value: content
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quill = new Quill("#editorInfo", {
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
                document.querySelector("#content2").value = content;
                console.log("Quill content:", content);

                Livewire.dispatch("setInfo", {
                    value: content
                });
            });
        });
    </script>
    {{-- edit description --}}
    <script>
        function setEditDescription(){
            var quill = new Quill("#editorEditDescription", {
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
                document.querySelector("#contentEditDescription").value = content;
                console.log("Quill content:", content);

                Livewire.dispatch("setEditDescription", {
                    value: content
                });
            });
        }
        function setEditInfo(){
            var quill = new Quill("#editorEditInfo", {
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
                document.querySelector("#contentEditInfo").value = content;
                console.log("Quill content:", content);

                Livewire.dispatch("setEditInfo", {
                    value: content
                });
            });
        }
    </script>
</x-layouts-backend>
