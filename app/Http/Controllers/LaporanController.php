<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    private function buatPDF($judul)
    {
        $pdf = new \FPDF('L', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, $this->teks($judul), 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'Tanggal Cetak: ' . date('d-m-Y'), 0, 1);
        $pdf->Ln(5);

        return $pdf;
    }

    private function teks($teks)
    {
        return iconv('UTF-8', 'windows-1252//TRANSLIT', (string) $teks);
    }

    private function hasilPDF($pdf, $namaFile)
    {
        $isi = $pdf->Output('S');

        return response($isi, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $namaFile . '"',
        ]);
    }

    public function anggota()
    {
        $data = Anggota::query()
    ->where('user_id', Auth::id())
    ->get();
    
        $pdf = $this->buatPDF('LAPORAN DATA ANGGOTA');

        $pdf->SetFont('Arial', 'B', 10);

        foreach ([
            [15, 'No'],
            [35, 'Nomor Anggota'],
            [60, 'Nama'],
            [110, 'Alamat'],
            [45, 'Telepon'],
        ] as [$lebar, $judul]) {
            $pdf->Cell($lebar, 10, $this->teks($judul), 1, 0, 'C');
        }

        $pdf->Ln();

        $pdf->SetFont('Arial', '', 9);

        foreach ($data as $i => $anggota) {
            $pdf->Cell(15, 9, $i + 1, 1);
            $pdf->Cell(35, 9, $this->teks($anggota->nomor_anggota), 1);
            $pdf->Cell(60, 9, $this->teks($anggota->nama), 1);
            $pdf->Cell(110, 9, $this->teks($anggota->alamat), 1);
            $pdf->Cell(45, 9, $this->teks($anggota->telepon), 1);
            $pdf->Ln();
        }

        $pdf->Ln(5);
        $pdf->Cell(0, 8, 'Jumlah Anggota: ' . $data->count(), 0, 1);

        return $this->hasilPDF($pdf, 'laporan_anggota.pdf');
    }

    public function simpanan()
    {
        $data = Simpanan::with('anggota')
            ->whereHas('anggota', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

        $pdf = $this->buatPDF('LAPORAN DATA SIMPANAN');

        $pdf->SetFont('Arial', 'B', 10);

        foreach ([
            [20, 'No'],
            [35, 'Tanggal'],
            [55, 'Nama Anggota'],
            [45, 'Jenis Simpanan'],
            [40, 'Jumlah'],
            [70, 'Keterangan'],
        ] as [$lebar, $judul]) {
            $pdf->Cell($lebar, 10, $this->teks($judul), 1, 0, 'C');
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);

        foreach ($data as $i => $simpanan) {
            $pdf->Cell(20, 9, $i + 1, 1);
            $pdf->Cell(35, 9, $this->teks($simpanan->tanggal), 1);
            $pdf->Cell(55, 9, $this->teks($simpanan->anggota->nama ?? '-'), 1);
            $pdf->Cell(45, 9, $this->teks($simpanan->jenis_simpanan), 1);
            $pdf->Cell(40, 9, number_format($simpanan->jumlah, 0, ',', '.'), 1);
            $pdf->Cell(70, 9, $this->teks($simpanan->keterangan ?? '-'), 1);
            $pdf->Ln();
        }

        $total = $data->sum('jumlah');

        $pdf->Ln(5);
        $pdf->Cell(0, 8, 'Jumlah Transaksi: ' . $data->count(), 0, 1);
        $pdf->Cell(0, 8, 'Total Simpanan: Rp ' . number_format($total, 0, ',', '.'), 0, 1);

        return $this->hasilPDF($pdf, 'laporan_simpanan.pdf');
    }

    public function pinjaman()
    {
        $data = Pinjaman::with('anggota')
            ->whereHas('anggota', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

        $pdf = $this->buatPDF('LAPORAN DATA PINJAMAN');

        $pdf->SetFont('Arial', 'B', 10);

        foreach ([
            [15, 'No'],
            [35, 'Tanggal'],
            [50, 'Nama Anggota'],
            [40, 'Jumlah Pinjaman'],
            [25, 'Bunga'],
            [25, 'Tenor'],
            [75, 'Status'],
        ] as [$lebar, $judul]) {
            $pdf->Cell($lebar, 10, $this->teks($judul), 1, 0, 'C');
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);

        foreach ($data as $i => $pinjaman) {
            $pdf->Cell(15, 9, $i + 1, 1);
            $pdf->Cell(35, 9, $this->teks($pinjaman->tanggal_pinjam), 1);
            $pdf->Cell(50, 9, $this->teks($pinjaman->anggota->nama ?? '-'), 1);
            $pdf->Cell(40, 9, number_format($pinjaman->jumlah_pinjaman, 0, ',', '.'), 1);
            $pdf->Cell(25, 9, $pinjaman->bunga . '%', 1);
            $pdf->Cell(25, 9, $pinjaman->tenor . ' bulan', 1);
            $pdf->Cell(75, 9, $this->teks($pinjaman->status), 1);
            $pdf->Ln();
        }

        $total = $data->sum('jumlah_pinjaman');

        $pdf->Ln(5);
        $pdf->Cell(0, 8, 'Jumlah Transaksi: ' . $data->count(), 0, 1);
        $pdf->Cell(0, 8, 'Total Pinjaman: Rp ' . number_format($total, 0, ',', '.'), 0, 1);

        return $this->hasilPDF($pdf, 'laporan_pinjaman.pdf');
    }
}