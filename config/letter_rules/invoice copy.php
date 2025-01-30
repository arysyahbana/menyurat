<?php

return [
    "data" => [
        /**
         * @param string
         * ? Nama penerima invoice
         * cara akses data : $variable["recipient_name"]
         * atribut name di html : recipient_name
         */
        "recipient_name" => [
            "validate" => "nullable|string|min:3",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Alamat penerima invoice
         * cara akses data : $variable["recipient_address"]
         * atribut name di html : recipient_address
         */
        "recipient_address" => [
            "validate" => "nullable|string|min:5",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Nomor telpon penerima invoice
         * cara akses data : $variable["recipient_phone"]
         * atribut name di html : recipient_phone
         */
        "recipient_phone" => [
            "validate" => "nullable|string|regex:/[0]{1}[8]{1}[0-9]{0,11}/",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Nomor invoice
         * cara akses data : $variable["invoice_number"]
         * atribut name di html : invoice_number
         */
        "invoice_number" => [
            "validate" => "nullable|string",
            "cast" => "string",
        ],

        /**
         * @param date
         * ? Jatuh tempo invoice
         * cara akses data : $variable["invoice_due"]
         * atribut name di html : invoice_due
         */
        "invoice_due" => [
            "validate" => "nullable|date",
            "cast" => "date",
        ],

        /**
         * @param date
         * ? Tenggat waktu invoice
         * cara akses data : $variable["due_date"]
         * atribut name di html : due_date
         */
        "due_date" => [
            "validate" => "nullable|date",
            "cast" => "date",
        ],

        /**
         * @param array
         * ? Detail pesanan
         * cara akses data : lakukan foreach dari data $variable["invoice_details"]
         */
        "invoice_details" => [
            "validate" => "nullable|array",
            "cast" => "array",
            "items" => [
                /**
                 * @param string
                 * ? Nama barang
                 * cara akses data : $item["name"]
                 * atribut name di html : invoice_details[$index][name]
                 * cara akses old dan error : invoice_details.$index.name
                 */
                "name" => [
                    "validate" => "required|string|min:3",
                    "cast" => "string",
                ],

                /**
                 * @param integer
                 * ? Jumlah barang
                 * cara akses data : $item["quantity"]
                 * atribut name di html : invoice_details[$index][quantity]
                 * cara akses old dan error : invoice_details.$index.quantity
                 */
                "quantity" => [
                    "validate" => "required|integer|min:0",
                    "cast" => "integer",
                ],

                /**
                 * @param integer
                 * ? Harga satuan barang
                 * cara akses data : $item["price"]
                 * atribut name di html : invoice_details[$index][price]
                 * cara akses old dan error : invoice_details.$index.price
                 */
                "price" => [
                    "validate" => "required|integer|min:0",
                    "cast" => "integer",
                ],
            ],
        ],

        /**
         * @param object
         * ? Metode pembayaran
         */
        "payment_method" => [
            "validate" => "nullable|array",
            "cast" => "object",
            "items" => [
                /**
                 * @param integer
                 * ? Nomor akun
                 * cara akses data : $variable["payment_method"]["account_number"]
                 * atribut name di html : payment_method[account_number]
                 * cara akses old dan error : payment_method.account_number
                 */
                "account_number" => [
                    "validate" => "required|integer|min:5",
                    "cast" => "integer",
                ],

                /**
                 * @param string
                 * ? Nama pemilik akun
                 * cara akses data : $variable["payment_method"]["account_name"]
                 * atribut name di html : payment_method[account_name]
                 * cara akses old dan error : payment_method.account_name
                 */
                "account_name" => [
                    "validate" => "required|string|min:3",
                    "cast" => "string",
                ],

                /**
                 * @param string
                 * ? Nama metode pembayaran, misal bank Jago dll
                 * cara akses data : $variable["payment_method"]["payment_name"]
                 * atribut name di html : payment_method[payment_name]
                 * cara akses old dan error : payment_method.payment_name
                 */
                "payment_name" => [
                    "validate" => "required|string|min:3",
                    "cast" => "string",
                ],
            ],
        ],

        /**
         * @param object
         * ? Diskon
         */
        "discount" => [
            "validate" => "nullable|array",
            "cast" => "object",
            "items" => [
                /**
                 * @param double
                 * ? Diskon dalam bentuk persentase
                 * cara akses data : $variable["discount"]["percentage"]
                 * atribut name di html : discount[percentage]
                 * cara akses old dan error : discount.percentage
                 */
                "percentage" => [
                    "validate" => "required_without_all:discount.nominal|prohibits:discount.nominal|decimal:0,2|min:0|max:100",
                    "cast" => "double",
                ],

                /**
                 * @param integer
                 * ? Diskon dalam bentuk nominal
                 * cara akses data : $variable["discount"]["nominal"]
                 * atribut name di html : discount[nominal]
                 * cara akses old dan error : discount.nominal
                 */
                "nominal" => [
                    "validate" => "required_without_all:discount.percentage|prohibits:discount.percentage|integer|min:0",
                    "cast" => "integer",
                ],
            ],
        ],

        /**
         * @param object
         * ? Pajak
         */
        "tax" => [
            "validate" => "nullable|array",
            "cast" => "object",
            "items" => [
                /**
                 * @param double
                 * ? Pajak dalam bentuk persentase
                 * cara akses data : $variable["tax"]["percentage"]
                 * atribut name di html : tax[percentage]
                 * cara akses old dan error : tax.percentage
                 */
                "percentage" => [
                    "validate" => "required_without_all:tax.nominal|prohibits:tax.nominal|decimal:0,2|min:0|max:100",
                    "cast" => "double",
                ],

                /**
                 * @param integer
                 * ? Pajak dalam bentuk nominal
                 * cara akses data : $variable["tax"]["nominal"]
                 * atribut name di html : tax[nominal]
                 * cara akses old dan error : tax.nominal
                 */
                "nominal" => [
                    "validate" => "required_without_all:tax.percentage|prohibits:tax.percentage|integer|min:0",
                    "cast" => "integer",
                ],
            ],
        ],

        /**
         * @param integer
         * ? Biaya pengiriman
         * cara akses data : $variable["shipping"]
         * atribut name di html : shipping
         */
        "shipping" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],

        /**
         * @param integer
         * ? Pembayaran DP
         * cara akses data : $variable["dp"]
         * atribut name di html : dp
         */
        "dp" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],
    ],

    "errorKey" => [
        "recipient_name" => "Nama penerima invoice",
        "recipient_address" => "Alamat penerima invoice",
        "recipient_phone" => "Nomor telpon penerima invoice",
        "invoice_number" => "Nomor invoice",
        "invoice_due" => "Jatuh tempo invoice",
        "due_date" => "Tenggat waktu",
        "invoice_details" => "Detail pesanan",
        "payment_method" => "Metode pembayaran",
        "discount" => "Diskon",
        "tax" => "Pajak",
        "shipping" => "Biaya pengiriman",
        "dp" => "Pembayaran dimuka",

        // items
        "invoice_details.*.name" => "Nama barang",
        "invoice_details.*.quantity" => "Jumlah barang",
        "invoice_details.*.price" => "Harga barang (satuan)",
        "payment_method.account_number" => "Nomor akun",
        "payment_method.account_name" => "Nama pemilik akun",
        "payment_method.payment_name" => "Metode pembayaran",
        "discount.percentage" => "Persentase diskon",
        "discount.nominal" => "Nominal diskon",
        "tax.percentage" => "Persentase pajak",
        "tax.nominal" => "Nominal pajak",
    ],
];
