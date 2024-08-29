@extends('layout.header_user', ['title' => 'Ticket'])

{{-- if session has error --}}
@section('content')

    @if (session('error'))
    <div class="z-999 relative">
        <div class="bg-red-500 text-white p-4 rounded-md mb-5 mt-10">
            {{ session('error') }}
        </div>
    </div>
    @endif
    {{-- if session has success --}}
    @if (session('success'))
    <div class="z-999 relative">
        <div class="bg-green-500 text-white p-4 rounded-md mb-5 mt-10">
            {{ session('success') }}
        </div>
    </div>
    @endif

    <div>
        <div class="flex flex-col gap-9">
            <!-- Input Fields -->
            <div>
                @csrf      
                <div  class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="border-b flex flex-row justify-between border-stroke px-6.5 py-4 dark:border-strokedark">
                        <h3 class="font-semibold text-2xl text-black dark:text-white">
                            Simulasi Response - {{ Auth::user()->name }}
                        </h3>
                    </div>
                    <div class="flex flex-col gap-5.5 p-6.5">
                        @if ($tiket->status == 'menunggu' && ($tiket->kategori == 1 || $tiket->kategori == 4))
                        <div class="">
                            <div class="flex flex-row justify-between mb-2">
                                <h3 class="font-bold text-lg">Konfirmasi Jadwal</h3>
                            </div>

                            <form action="{{ route('admin.tiket.kirim_jadwal', $tiket->id) }}" method="post">
                                @csrf
                                <div class="group">
                                    <label for="tanggal">Saran Tanggal Perbaikan</label>
                                    <input type="date" name="tanggal" id="tanggal" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required>
                                </div>

                                <div class="group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required></textarea>
                                </div>

                                <div class="group">
                                    <button type="submit" class="bg-primary hover:bg-red-400 transition-colors px-5 py-2 font-bold text-white rounded-md">Kirim</button>
                                </div>
                            </form>
                        </div>
                        @endif

                        @if (($tiket->status == 'penugasan' && $tiket->kategori == 3) || ($tiket->status == 'penugasan' && $tiket->kategori == 7))
                        <div class="">
                            <div class="flex flex-row justify-between mb-2">
                                <h3 class="font-bold text-lg">Penugasan Teknisi</h3>
                            </div>

                            <form action="{{ route('admin.tiket.penugasan', $tiket->id) }}" method="post">
                                @csrf
                                <div class="group mb-3">
                                    <label for="tanggal">Pilih Teknisi</label>
                                    <select class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" name="id_teknisi" id="id_teknisi">
                                        @foreach ($teknisi as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="group">
                                    {{-- tanggal_perbaikan --}}
                                    <label for="tanggal">Tanggal Perbaikan</label>
                                    <input type="date" name="tanggal_perbaikan" id="tanggal_perbaikan" value="{{ $tiket->tanggal_perbaikan }}" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required>
                                </div>

                                <div class="group mb-3">
                                    <label for="deskripsi">Keterangan</label>
                                    <textarea name="deskripsi" id="deskripsi" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required></textarea>
                                </div>

                                <div class="group">
                                    <button type="submit" class="bg-primary hover:bg-red-400 transition-colors px-5 py-2 font-bold text-white rounded-md">Kirim</button>
                                </div>
                            </form>
                        </div>
                        @endif

                        @if ($tiket->status == 'dikerjakan' && $tiket->kategori == 8) {{-- Teknisi lapor kendala --}}
                            <form action="{{ route('admin.tiket.meneruskan_kendala', $tiket->id) }}" method="post">
                                @csrf
                                <div class="group">
                                    <label for="jenis_kendala">Jenis Kendala</label>
                                    <br>

                                    <select class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent pl-2 pr-2 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" name="jenis_kendala" id="jenis_kendala">
                                        <option @if ($kendala->jenis_kendala == 'Perlengkapan Kurang') selected @endif value="1">Peralatan Kurang</option>
                                        <option @if ($kendala->jenis_kendala == 'Penggantian Sparepart') selected @endif value="2">Penggantian Sparepart</option>
                                        <option @if ($kendala->jenis_kendala == 'Perbaikan diluar Garansi') selected @endif value="3">Perbaikan diluar Garansi</option>
                                    </select>
                                </div>

                                <div class="group">
                                    <label for="deskripsi">Keterangan</label>
                                    <textarea name="deskripsi" id="deskripsi" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required>{{ $kendala->deskripsi }}</textarea>
                                </div>

                                <div class="group mb-3">
                                    <label for="aksi_diambil">Saran Aksi</label>
                                    <br>
                                    <select class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent pl-2 pr-2 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" name="aksi_diambil" id="aksi_diambil">
                                        <option @if ($kendala->aksi_diambil == 1)
                                            selected
                                        @endif value="1">Penjadwalan Ulang</option>
                                        <option @if ($kendala->aksi_diambil == 3)
                                            selected
                                        @endif value="3">Penawaran Sparepart</option>
                                        <option @if ($kendala->aksi_diambil == 2)
                                            selected
                                        @endif value="2">Persetujuan Perbaikan diluar Garansi</option>
                                    </select>
                                </div>

                                <div class="group">
                                    <button type="submit" class="bg-primary hover:bg-red-400 transition-colors px-5 py-2 font-bold text-white rounded-md">Sampaikan</button>
                                </div>
                            </form>
                        @endif
                        
                        <hr>

                            <div>
                                <div class="flex flex-row justify-between mb-2">
                                    <h1 class="font-bold text-xl">Log Perbaikan</h1>
                                </div>
                                <div class="border border-stroke rounded-md p-4 flex flex-col gap-3">
                                    @foreach ($log as $item)
                                        <div class="w-full h-auto py-4 px-8 bg-[#F8F8F8] border border-stroke rounded-sm flex justify-between items-center">
                                            <div class="w-full flex justify-start gap-24 md:gap-14 align-middle content-center">
                                                {{-- #2 --}}
                                                <div class="group flex flex-col gap-1 w-4/12">
                                                    <div class="label">
                                                        <label class="font-light text-slate-400" for="tanggal">Status:</label>
                                                    </div>
                                                    <div class="value">
                                                        <h1 class="text-xl font-semibold text-green-500">{{ $item->konteks }}</h1>
                                                    </div>
                                                </div>
                                                {{-- #3 --}}
                                                <div class="group flex flex-col gap-1 w-1/5">
                                                    <div class="label">
                                                        <label class="font-light text-slate-400" for="tanggal">Dibuat Oleh:</label>
                                                    </div>
                                                    <div class="value">
                                                        <h1 class="text-xl font-normal">{{ $item->dibuat_oleh }}</h1>
                                                    </div>
                                                </div>
                                                {{-- #1 --}}
                                                <div class="group flex flex-col gap-1">
                                                    <div class="label">
                                                        <label class="font-light text-slate-400" for="tanggal">Tanggal:</label>
                                                    </div>
                                                    <div class="value">
                                                        <h1 class="text-xl font-normal">{{ $item->created_at }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <i class="fa-solid fa-caret-right text-3xl"></i>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        <hr>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    @endsection
