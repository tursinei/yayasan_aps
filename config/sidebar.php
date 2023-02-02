<?php

define('IS_ADMIN', 0);
define('IS_PENGURUS', 1);
define('IS_KORDES', 2);
define('IS_SEKRETARIS', 3);
define('IS_BENDAHARA', 4);
define('IS_HUMAS', 5);
define('IS_KESEHATAN', 6);
//https://graphicburger.com/simple-line-icons-webfont/
return [
    'menu' => [
        [
            'icon'  => 'icon-home',
            'title' => 'Beranda',
            'url'   => 'dashboard',
            'akses' => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_HUMAS, IS_BENDAHARA, IS_KESEHATAN, IS_SEKRETARIS]
        ], [
            'icon'  => 'icon-note',
            'title' => 'Pendaftaran',
            'subTitle' => 'Daftar Yatama',
            'url'   => 'calonyatama.pendaftaran',
            'akses' => [IS_ADMIN, IS_KORDES, IS_HUMAS, IS_KESEHATAN]
        ], [
            'icon'      => 'icon-hourglass',
            'title'     => 'Calon Yatama',
            'subTitle'  => 'Yatama Sebelum Diverifikasi',
            'url'       => 'calonyatama.index',
            'akses'     => [IS_ADMIN, IS_KORDES, IS_HUMAS, IS_KESEHATAN]
        ], [
            'icon'      => 'icon-magic-wand',
            'title'     => 'Verifikasi',
            'subTitle'  => 'Verifikasi Calon Yatama',
            'url'       => 'verifikasi.index',
            'akses'     => [IS_ADMIN, IS_SEKRETARIS]
        ], [
            'icon'      => 'icon-user-female',
            'title'     => 'Yatama',
            'url'       => '#',
            'akses'     => [IS_ADMIN, IS_KORDES, IS_HUMAS, IS_KESEHATAN],
            'sub_menu'  => [
                [
                    'icon'      => 'icon-book-open',
                    'title'     => 'Data Informasi',
                    'url'       => 'yatama.index',
                    'akses'     => [IS_ADMIN, IS_KORDES, IS_HUMAS]
                ],
                [
                    'icon'      => 'icon-graduation',
                    'title'     => 'Pendidikan.index',
                    'url'       => 'pendidikan',
                    'akses'     => [IS_ADMIN, IS_KORDES, IS_HUMAS]
                ],
                [
                    'icon'      => 'icon-shield',
                    'title'     => 'Rekam Medis',
                    'url'       => 'rekammedis.index',
                    'akses'     => [IS_ADMIN, IS_KORDES, IS_HUMAS, IS_KESEHATAN]
                ],
            ]
        ], [
            'icon'  => 'icon-calculator',
            'title' => 'RAB',
            'subTitle'  => 'Rancangan Anggaran Belanja',
            'url'   => 'rab.index',
            'akses' => [IS_ADMIN, IS_BENDAHARA]
        ], [
            'icon'      => 'icon-wallet',
            'title'     => 'KAS',
            'url'       => '#',
            'akses'     => [IS_ADMIN, IS_BENDAHARA],
            'sub_menu'  => [
                [
                    'icon'      => 'icon-call-in',
                    'title'     => 'Pemasukan',
                    'url'       => 'pemasukan.index',
                    'akses'     => [IS_ADMIN, IS_BENDAHARA]
                ], [
                    'icon'      => 'icon-call-out',
                    'title'     => 'Pengeluaran',
                    'url'       => 'pengeluaran.index',
                    'akses'     => [IS_ADMIN, IS_BENDAHARA]
                ],
            ]
        ], [
            'icon'      => 'icon-bar-chart',
            'title'     => 'Laporan',
            'url'       => '#',
            'akses'     => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_HUMAS, IS_BENDAHARA, IS_KESEHATAN, IS_SEKRETARIS],
            'sub_menu'  => [
                [
                    'icon'      => 'icon-users',
                    'title'     => 'Yatama',
                    'url'       => 'laporan-yatama',
                    'akses'     => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_SEKRETARIS, IS_BENDAHARA, IS_HUMAS]
                ], [
                    'icon'      => 'icon-graduation',
                    'title'     => 'Alumni Yatama',
                    'url'       => 'laporan-alumni',
                    'akses'     => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_SEKRETARIS, IS_BENDAHARA, IS_HUMAS]
                ], [
                    'icon'      => 'icon-call-in',
                    'title'     => 'Pemasukan',
                    'url'       => 'laporan-pemasukan',
                    'akses'     => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_SEKRETARIS, IS_BENDAHARA, IS_HUMAS]
                ], [
                    'icon'      => 'icon-call-out',
                    'title'     => 'Pengeluaran',
                    'url'       => 'laporan-pengeluaran',
                    'akses'     => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_SEKRETARIS, IS_BENDAHARA, IS_HUMAS]
                ], [
                    'icon'      => 'icon-bag',
                    'title'     => 'RAB',
                    'url'       => 'laporan-rab',
                    'akses'     => [IS_ADMIN, IS_PENGURUS, IS_KORDES, IS_SEKRETARIS, IS_BENDAHARA, IS_HUMAS]
                ], [
                    'icon'      => 'icon-eyeglasses',
                    'title'     => 'Pendidikan Yatama',
                    'url'       => 'laporan-pendidikan',
                    'akses'     => [IS_ADMIN, IS_KESEHATAN]
                ],[
                    'icon'      => 'icon-plus',
                    'title'     => 'Rekam Medis',
                    'url'       => 'laporan-rekam-medis',
                    'akses'     => [IS_ADMIN, IS_KESEHATAN]
                ],
            ]
        ],[
            'icon'      => 'icon-grid',
            'title'     => 'Master Data',
            'url'       => '#',
            'akses'     => [IS_ADMIN],
            'sub_menu'  => [
                [
                    'icon'      => 'icon-layers',
                    'title'     => 'Program Yayasan',
                    'url'       => 'program.index',
                    'akses'     => [IS_ADMIN]
                ],
                [
                    'icon'      => 'icon-directions',
                    'title'     => 'Kegiatan Yayasan',
                    'url'       => 'kegiatan.index',
                    'akses'     => [IS_ADMIN]
                ],
                // [
                //     'icon'      => 'icon-user',
                //     'title'     => 'Kurator',
                //     'url'       => 'kurator.index',
                //     'akses'     => [IS_ADMIN]
                // ],
                [
                    'icon'      => 'icon-folder',
                    'title'     => 'Kelas',
                    'url'       => 'kelas.index',
                    'akses'     => [IS_ADMIN]
                ],
            ]
        ],[

            'icon'      => 'icon-users',
            'title'     => 'Users',
            'subtitle'  => 'User Aplikasi',
            'url'       => 'user.index',
            'akses'     => [IS_ADMIN],
        ]
    ]
];
