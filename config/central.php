<?php

return [
    "system_roles" => [
        "administrator" => "admin",
        "user" => "user",
    ],

    "system_permissions" => [
        "users_manage",
        "letters_manage",
        "letters_access",
    ],

    "paths" => [
        "company_logo" => "images/logo",
    ],

    // letter type and letter rules name of each type
    "letter_types" => [
        "Surat Mutasi Karyawan" => [
            // ? clear
            // ? completed
            "rule" => "employee_mutation",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.mutasi.index",
            "pdf" => "user.pdf.mutasi.index",
        ],
        "Surat Promosi Karyawan" => [
            // ? clear
            // ? completed
            "rule" => "employee_promotion",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.promosi_karyawan.index",
            "pdf" => "user.pdf.promosi_karyawan.index",
        ],
        "Surat Demosi Karyawan" => [
            // ? clear
            // ? completed
            "rule" => "employee_demotion",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.demosi.index",
            "pdf" => "user.pdf.demosi.index",
        ],
        "Surat Perjanjian PKWT" => [
            // ? clear
            "rule" => "pkwt_agreement",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.pkwt.index",
            "pdf" => "user.pdf.pkwt.index",
        ],
        "Surat Perjanjian PKWTT" => [
            // ? clear
            "rule" => "pkwtt_agreement",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.pkwtt.index",
            "pdf" => "user.pdf.pkwtt.index",
        ],
        "Surat Penawaran Layanan" => [
            // ? clear
            // ? completed
            "rule" => "service_offering",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.penawaran_layanan.index",
            "pdf" => "user.pdf.penawaran_layanan.index",
        ],
        "Surat Peringatan" => [
            // ? clear
            // ? completed
            "rule" => "warning",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.peringatan.index",
            "pdf" => "user.pdf.peringatan.index",
        ],
        "Surat Invoice" => [
            // ? clear
            "rule" => "invoice",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.invoice.index",
            "pdf" => "user.pdf.invoice.index",
        ],
        "Surat Pemberitahuan" => [
            // ? clear
            // ? completed
            "rule" => "announcement",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.pemberitahuan.index",
            "pdf" => "user.pdf.pemberitahuan.index",
        ],
        "Surat Balasan" => [
            // ?clear
            // ? completed
            "rule" => "response",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.balasan.index",
            "pdf" => "user.pdf.balasan.index",
        ],
        "Surat Penawaran Harga" => [
            // ? clear
            // ? completed
            "rule" => "quotation",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.penawaran_harga.index",
            "pdf" => "user.pdf.penawaran_harga.index",
        ],
        "Surat Konfirmasi Pesanan" => [
            // ? clear
            // ? completed
            "rule" => "order_confirmation",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.konfirmasi_pesanan.index",
            "pdf" => "user.pdf.konfirmasi_pesanan.index",
        ],
        "Surat Undangan" => [
            // ? clear
            // ? completed
            "rule" => "invitation",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.undangan.index",
            "pdf" => "user.pdf.undangan.index",
        ],
        "Surat Permohonan" => [
            // ? clear
            // ? completed
            "rule" => "application",
            "image" => "assets/img/surat.jpg",
            "view" => "user.buat_surat.permohonan.index",
            "pdf" => "user.pdf.permohonan.index",
        ],
    ],

    "days" => [
        "Monday" => "Senin",
        "Tuesday" => "Selasa",
        "Wednesday" => "Rabu",
        "Thursday" => "Kamis",
        "Friday" => "Jumat",
        "Saturday" => "Sabtu",
        "Sunday" => "Minggu",
    ],

    "months" => [
        "January" => "Januari",
        "February" => "Februari",
        "March" => "Maret",
        "April" => "April",
        "May" => "Mei",
        "June" => "Juni",
        "July" => "Juli",
        "August" => "Agustus",
        "September" => "September",
        "October" => "Oktober",
        "November" => "November",
        "December" => "Desember",
    ],
];
