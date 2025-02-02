<?php

return [
    "data" => [
        /**
         * @param string
         * ? Nama customer
         * cara akses data : $variable["customer_name"]
         * atribut name di html : customer_name
         */
        "customer_name" => [
            "validate" => "nullable|string|min:3",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Alamat customer
         * cara akses data : $variable["customer_address"]
         * atribut name di html : customer_address
         */
        "customer_address" => [
            "validate" => "nullable|string|min:5",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Nomor telpon customer
         * cara akses data : $variable["customer_phone"]
         * atribut name di html : customer_phone
         */
        "customer_phone" => [
            "validate" => "nullable|string|regex:/[0]{1}[8]{1}[0-9]{0,11}/",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Nomor invoice
         * cara akses data : $variable["invoice#"]
         * atribut name di html : invoice#
         */
        "invoice#" => [
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

        "subtotal" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],

        "total" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],

        /**
         * @param string
         * ? Deskripsi item
         */
        "item_details" => [
            "validate" => "nullable|array",
            "cast" => "array",
        ],
        "item_details.*.item_desc" => [
            "validate" => "nullable|string|min:3",
            "cast" => "string",
        ],
        "item_details.*.unit_price" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],
        "item_details.*.qty" => [
            "validate" => "nullable|integer|min:1",
            "cast" => "integer",
        ],
        "item_details.*.amount" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],

        /**
         * @param integer
         * ? Nomor akun
         */
        "account" => [
            "validate" => "nullable|string|min:5",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Nama pemilik akun
         */
        "ac_name" => [
            "validate" => "nullable|string|min:3",
            "cast" => "string",
        ],

        /**
         * @param string
         * ? Detail bank
         */
        "bank_details" => [
            "validate" => "nullable|string|min:3",
            "cast" => "string",
        ],

        /**
         * @param integer
         * ? Diskon dalam bentuk nominal
         */
        "discount" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],

        /**
         * @param integer
         * ? Pajak dalam bentuk nominal
         */
        "tax" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],

        /**
         * @param integer
         * ? Biaya pengiriman
         */
        "shipping" => [
            "validate" => "nullable|integer|min:0",
            "cast" => "integer",
        ],
    ],

    "errorKey" => [
        "customer_name" => "Nama customer",
        "customer_address" => "Alamat customer",
        "customer_phone" => "Nomor telpon customer",
        "invoice#" => "Nomor invoice",
        "invoice_due" => "Jatuh tempo invoice",
        "due_date" => "Tenggat waktu",
        "item_desc" => "Deskripsi item",
        "unit_price" => "Harga satuan",
        "qty" => "Jumlah item",
        "amount" => "Total harga item",
        "account" => "Nomor akun",
        "ac_name" => "Nama pemilik akun",
        "bank_details" => "Detail bank",
        "discount" => "Diskon",
        "tax" => "Pajak",
        "shipping" => "Biaya pengiriman",
    ],
];
