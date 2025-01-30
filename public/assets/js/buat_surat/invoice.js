document.addEventListener("DOMContentLoaded", function () {
    // Global variables for form elements
    const formElements = {
        customerName: document.getElementById("customer_name"),
        customerAddress: document.getElementById("customer_address"),
        customerPhone: document.getElementById("customer_phone"),

        invoiceNumber: document.getElementById("invoice#"),
        invoiceDue: document.getElementById("invoice_due"),
        dueDate: document.getElementById("due_date"),

        itemDesc: document.getElementById("item_desc"),
        unitPrice: document.getElementById("unit_price"),
        qty: document.getElementById("qty"),
        amount: document.getElementById("amount"),

        otherName: document.getElementById("other_name"),
        otherPrice: document.getElementById("other_price"),

        account: document.getElementById("account"),
        acName: document.getElementById("ac_name"),
        bankDetails: document.getElementById("bank_details"),

        discount: document.getElementById("discount"),
        tax: document.getElementById("tax"),
        shipping: document.getElementById("shipping"),
    };

    // Preview update functions
    const updatePreview = {
        customerName: function (value) {
            const previewElement = document.querySelector(".customer_name");
            if (previewElement) {
                previewElement.textContent = value || "Customer Name";
            }
        },
        customerAddress: function (value) {
            const previewElement = document.querySelector(".customer_address");
            if (previewElement) {
                previewElement.textContent = value || "Customer Address";
            }
        },
        customerPhone: function (value) {
            const previewElement = document.querySelector(".customer_phone");
            if (previewElement) {
                previewElement.textContent = value || "Customer Phone";
            }
        },
        invoiceNumber: function (value) {
            const previewElement = document.querySelector(".no_invoice");
            if (previewElement) {
                previewElement.textContent = value || "No Invoice";
            }
        },
        invoiceDue: function (value) {
            const previewElement = document.querySelector(".invoice_due");
            if (previewElement) {
                previewElement.textContent = value
                    ? formatDate(value)
                    : "Invoice Due";
            }
        },
        dueDate: function (value) {
            const previewElement = document.querySelector(".due_date");
            if (previewElement) {
                previewElement.textContent = value
                    ? formatDate(value)
                    : "Due Date";
            }
        },
        account: function (value) {
            const previewElement = document.querySelector(".account");
            if (previewElement) {
                previewElement.textContent = value || "Account";
            }
        },
        acName: function (value) {
            const previewElement = document.querySelector(".ac-name");
            if (previewElement) {
                previewElement.textContent = value || "A/C Name";
            }
        },
        bankDetails: function (value) {
            const previewElement = document.querySelector(".bank-details");
            if (previewElement) {
                previewElement.textContent = value || "Bank Details";
            }
        },
        discount: function (value) {
            if (parseFloat(value) > 0) {
                handleInputChange(
                    { value },
                    discountElement,
                    discountRow,
                    true
                );
            } else {
                const discountElement = document.querySelector(".discount");
                if (discountElement) {
                    discountElement.textContent = formatCurrency(
                        -Math.abs(parseFloat(value) || 0)
                    );
                }
            }
        },
        tax: function (value) {
            if (parseFloat(value) > 0) {
                handleInputChange({ value }, taxElement, taxRow);
            } else {
                const taxElement = document.querySelector(".tax");
                if (taxElement) {
                    taxElement.textContent = formatCurrency(
                        Math.abs(parseFloat(value) || 0)
                    );
                }
            }
        },
        shipping: function (value) {
            if (parseFloat(value) > 0) {
                handleInputChange({ value }, shippingElement, shippingRow);
            } else {
                const shippingElement = document.querySelector(".shipping");
                if (shippingElement) {
                    shippingElement.textContent = formatCurrency(
                        Math.abs(parseFloat(value) || 0)
                    );
                }
            }
        },
    };

    // Item table and add button
    const itemTable = document.querySelector(".table tbody");
    const addItemBtn = document.querySelector(".add-item");

    // Subtotal and total elements
    const subtotalElement = document.querySelector(".subtotal");
    const discountElement = document.querySelector(".discount");
    const taxElement = document.querySelector(".tax");
    const shippingElement = document.querySelector(".shipping");
    const totalElement = document.querySelector(".total");

    const discountRow = document.querySelector(".discount").parentElement;
    const taxRow = document.querySelector(".tax").parentElement;
    const shippingRow = document.querySelector(".shipping").parentElement;

    // Load saved values when page loads
    loadSavedValues();
    function loadSavedValues() {
        // Load subtotal
        const savedSubtotal = localStorage.getItem("invoice_subtotal");
        if (savedSubtotal && subtotalElement) {
            subtotalElement.textContent = formatCurrency(savedSubtotal);
        }
        // Load total
        const savedTotal = localStorage.getItem("invoice_total");
        if (savedTotal && totalElement) {
            totalElement.textContent = formatCurrency(savedTotal);
        }
    }

    function handleInputChange(input, element, row, isNegative = false) {
        const value = parseFloat(input.value) || 0;
        if (value > 0) {
            row.classList.remove("d-none");
            element.textContent = isNegative
                ? `- ${formatCurrency(value)}`
                : formatCurrency(value);
        } else {
            row.classList.add("d-none");
            element.textContent = isNegative ? "-Rp. 0" : "Rp. 0";
        }
        calculateTotal();
    }

    // Other price submit button
    const addOtherPriceBtn = document.querySelector(
        "#harga_lainnya .btn-primary"
    );

    // Validate item inputs
    function validateItemInputs() {
        const itemDesc = formElements.itemDesc.value.trim();
        const unitPrice = formElements.unitPrice.value;
        const qty = formElements.qty.value;

        if (!itemDesc) {
            alert("Please enter an item description");
            return false;
        }
        if (unitPrice <= 0) {
            alert("Unit price must be greater than 0");
            return false;
        }
        if (qty <= 0) {
            alert("Quantity must be greater than 0");
            return false;
        }
        return true;
    }

    // Function to format currency
    function formatCurrency(value) {
        return `Rp. ${Number(value).toLocaleString("id-ID")}`;
    }

    // Calculate subtotal
    function calculateSubtotal() {
        const rows = itemTable.querySelectorAll("tr");
        let subtotal = 0;

        rows.forEach((row) => {
            const amountCell = row.querySelector("td:nth-child(4)");
            if (amountCell) {
                const amount =
                    parseFloat(
                        amountCell.textContent
                            .replace("Rp. ", "")
                            .replace(/\./g, "")
                    ) || 0;
                subtotal += amount;
            }
        });

        if (subtotalElement) {
            subtotalElement.textContent = formatCurrency(subtotal);
        }

        calculateTotal();
    }

    // Calculate total with discount, tax, and shipping
    function calculateTotal() {
        const subtotal =
            parseFloat(
                subtotalElement.textContent
                    .replace("Rp. ", "")
                    .replace(/\./g, "")
            ) || 0;

        const discount =
            parseFloat(
                discountElement.textContent
                    .replace("Rp. ", "")
                    .replace(/\./g, "")
                    .replace("-", "")
            ) || 0;

        const tax =
            parseFloat(
                taxElement.textContent.replace("Rp. ", "").replace(/\./g, "")
            ) || 0;

        const shipping =
            parseFloat(
                shippingElement.textContent
                    .replace("Rp. ", "")
                    .replace(/\./g, "")
            ) || 0;

        const total = subtotal - discount + tax + shipping;

        if (totalElement) {
            totalElement.textContent = formatCurrency(total);
        }
    }

    // Add item to table
    function addItemToTable() {
        if (!validateItemInputs()) return;

        const newRow = document.createElement("tr");

        const itemDesc = formElements.itemDesc.value;
        const unitPrice = formElements.unitPrice.value;
        const qty = formElements.qty.value;
        const amount = formElements.amount.value;

        newRow.innerHTML = `
            <td>${itemDesc}</td>
            <td>${formatCurrency(unitPrice)}</td>
            <td>${qty}</td>
            <td>${formatCurrency(amount)}</td>
        `;

        itemTable.appendChild(newRow);

        // Clear input fields
        formElements.itemDesc.value = "";
        formElements.unitPrice.value = "";
        formElements.qty.value = "";
        formElements.amount.value = "";

        // Recalculate subtotal
        calculateSubtotal();
    }

    // Add other price functionality
    function addOtherPrice() {
        const otherName = formElements.otherName.value;
        const otherPrice = parseFloat(formElements.otherPrice.value) || 0;

        const isDiscount = otherName.toLowerCase().includes("diskon");

        if (isDiscount) {
            // Create discount object with nominal
            const discountInput =
                document.querySelector('input[name="discount[nominal]"]') ||
                document.createElement("input");
            discountInput.type = "hidden";
            discountInput.name = "discount[nominal]";
            discountInput.value = otherPrice;
            form.appendChild(discountInput);

            discountElement.textContent = formatCurrency(-otherPrice);
        } else if (
            otherName.toLowerCase().includes("tax") ||
            otherName.toLowerCase().includes("pajak")
        ) {
            // Create tax object with nominal
            const taxInput =
                document.querySelector('input[name="tax[nominal]"]') ||
                document.createElement("input");
            taxInput.type = "hidden";
            taxInput.name = "tax[nominal]";
            taxInput.value = otherPrice;
            form.appendChild(taxInput);

            taxElement.textContent = formatCurrency(otherPrice);
        }

        calculateTotal();

        // Clear input fields
        formElements.otherName.value = "";
        formElements.otherPrice.value = "";
    }

    // Calculate amount automatically
    function calculateAmount() {
        const unitPrice = parseFloat(formElements.unitPrice.value) || 0;
        const qty = parseFloat(formElements.qty.value) || 0;
        const amount = unitPrice * qty;
        formElements.amount.value = amount;
    }

    function saveInvoiceData() {
        const subtotal =
            parseFloat(
                subtotalElement.textContent
                    .replace("Rp. ", "")
                    .replace(/\./g, "")
            ) || 0;

        const discount =
            parseFloat(
                discountElement.textContent
                    .replace("Rp. ", "")
                    .replace(/\./g, "")
                    .replace("-", "")
            ) || 0;

        const tax =
            parseFloat(
                taxElement.textContent.replace("Rp. ", "").replace(/\./g, "")
            ) || 0;

        const shipping =
            parseFloat(
                shippingElement.textContent
                    .replace("Rp. ", "")
                    .replace(/\./g, "")
            ) || 0;

        const total = subtotal - discount + tax + shipping;

        // Simpan semua data ke localStorage
        localStorage.setItem("invoice_subtotal", subtotal);
        localStorage.setItem("invoice_total", total);
        // localStorage.setItem("invoice_discount", discount);
        // localStorage.setItem("invoice_tax", tax);
        // localStorage.setItem("invoice_shipping", shipping);
    }

    // Remove row on table click
    // itemTable.addEventListener("click", function (e) {
    //     const row = e.target.closest("tr");
    //     if (row && row.parentNode === itemTable) {
    //         row.remove();
    //         calculateSubtotal();
    //     }
    // });

    // Event listeners
    formElements.unitPrice.addEventListener("input", calculateAmount);
    formElements.qty.addEventListener("input", calculateAmount);

    addItemBtn.addEventListener("click", function (e) {
        e.preventDefault();
        let itemIndex = document.querySelectorAll(
            "#dynamic-input-container .d-flex"
        ).length;

        const itemDesc = formElements.itemDesc.value;
        const unitPrice = formElements.unitPrice.value;
        const qty = formElements.qty.value;
        const amount = formElements.amount.value;

        addItemToTable();

        const container = document.querySelector("#dynamic-input-container");

        // Buat elemen div baru untuk input
        const newInputRow = document.createElement("div");
        newInputRow.classList.add("d-flex", "gap-3", "mb-3");

        newInputRow.innerHTML = `
            <div class="col col-4">
                <input type="text" name="item_details[${itemIndex}][item_desc]" class="form-control" value="${itemDesc}" readonly>
            </div>
            <div class="col col-2">
                <input type="number" name="item_details[${itemIndex}][unit_price]" class="form-control" value="${unitPrice}" readonly>
            </div>
            <div class="col col-2">
                <input type="number" name="item_details[${itemIndex}][qty]" class="form-control" value="${qty}" readonly>
            </div>
            <div class="col col-2">
                <input type="number" name="item_details[${itemIndex}][amount]" class="form-control" value="${amount}" readonly>
            </div>
            <div class="col col-2">
                <button type="button" class="btn btn-danger remove-item"><i class="fa-solid fa-minus"></i></button>
            </div>
        `;

        // Tambahkan elemen baru ke container
        container.appendChild(newInputRow);

        itemIndex++;
    });

    // Event delegation untuk menghapus elemen input
    document
        .querySelector("#dynamic-input-container")
        .addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-item")) {
                // Mendapatkan baris input yang akan dihapus
                const inputRow = e.target.closest(".d-flex");

                // Mendapatkan nilai item description dari input yang akan dihapus
                const itemDesc = inputRow.querySelector(
                    'input[name^="item_details"][name$="[item_desc]"]'
                ).value;

                // Mencari dan menghapus baris tabel yang sesuai
                const tableRows = itemTable.querySelectorAll("tr");
                tableRows.forEach((row) => {
                    if (row.cells[0].textContent === itemDesc) {
                        row.remove();
                    }
                });

                // Menghapus baris input
                inputRow.remove();

                // Menghitung ulang subtotal
                calculateSubtotal();
            }
        });

    if (addOtherPriceBtn) {
        addOtherPriceBtn.addEventListener("click", function (e) {
            e.preventDefault();
            addOtherPrice();
        });
    }

    // Add event listeners for new inputs
    formElements.discount.addEventListener("input", function (e) {
        updatePreview.discount(e.target.value);
    });

    formElements.tax.addEventListener("input", function (e) {
        updatePreview.tax(e.target.value);
    });

    formElements.shipping.addEventListener("input", function (e) {
        updatePreview.shipping(e.target.value);
    });

    // Add event listeners for real-time preview updates
    Object.keys(updatePreview).forEach((key) => {
        if (formElements[key]) {
            formElements[key].addEventListener("input", function (e) {
                updatePreview[key](e.target.value);
            });
        }
    });

    // Utility function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        const months = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember",
        ];
        return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
    }

    // Form submission handling
    const form = document.getElementById("input-letter-form");
    form.addEventListener("submit", function (e) {
        // Additional validation or processing can be added here if needed
        saveInvoiceData();
    });
});
