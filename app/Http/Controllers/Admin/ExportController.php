<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericExport;

use App\Models\Kontak;
use App\Models\Pendaftaran;
use App\Models\WhatsappLog;

class ExportController extends Controller
{
    // =========================
    // EXPORT KONTAK
    // =========================

    public function kontak()
    {
        $data = Kontak::all()->map(function ($item) {
            return [
                'ID' => $item->id,
                'Nama Lengkap' => $item->nama_lengkap,
                'No Telepon' => "'" . $item->no_telepon,
                'Topik Pertanyaan' => $item->topik_pertanyaan,
                'Pesan' => $item->pesan,
                'Status' => ucfirst($item->status),
                'Tanggal' => $item->created_at->format('d-m-Y H:i'),
            ];
        });

        return Excel::download(
            new GenericExport(
                $data,
                [
                    'ID',
                    'Nama Lengkap',
                    'No Telepon',
                    'Topik Pertanyaan',
                    'Pesan',
                    'Status',
                    'Tanggal',
                ]
            ),
            'data_kontak.xlsx'
        );
    }

    // =========================
    // EXPORT PENDAFTARAN
    // =========================

    public function pendaftaran()
    {
        $data = Pendaftaran::all()->map(function ($item) {
            return [
                'ID' => $item->id,
                'Nama Lengkap' => $item->nama_lengkap,
                'Email' => $item->email,
                'NISN' => "'" . $item->nisn,
                'Program Unggulan' => $item->program_unggulan_dipilih,
                'Status' => ucfirst($item->status),
                'Tanggal' => $item->created_at->format('d-m-Y H:i'),
            ];
        });

        return Excel::download(
            new GenericExport(
                $data,
                [
                    'ID',
                    'Nama Lengkap',
                    'Email',
                    'NISN',
                    'Program Unggulan',
                    'Status',
                    'Tanggal',
                ]
            ),
            'data_pendaftaran.xlsx'
        );
    }

    // =========================
    // EXPORT WHATSAPP
    // =========================

    public function whatsapp()
    {
        $data = WhatsappLog::all()->map(function ($item) {
            return [
                'ID' => $item->id,
                'Nama' => $item->name,
                'No WhatsApp' => "'" . $item->phone,
                'Keperluan' => $item->purpose,
                'Status' => ucfirst($item->status),
                'Tanggal' => $item->created_at->format('d-m-Y H:i'),
            ];
        });

        return Excel::download(
            new GenericExport(
                $data,
                [
                    'ID',
                    'Nama',
                    'No WhatsApp',
                    'Keperluan',
                    'Status',
                    'Tanggal',
                ]
            ),
            'data_whatsapp.xlsx'
        );
    }
}