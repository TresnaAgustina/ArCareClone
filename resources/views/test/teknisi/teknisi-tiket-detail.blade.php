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
    
    @if ($errors->any())
    <div class="z-999 relative">
        <div class="bg-red-500 text-white p-4 rounded-md mb-5 mt-10">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
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

                        @if (Auth::user()->role == 'teknisi' && $tiket->kategori == 5)
                            <form action="{{ route('teknisi.tiket.menuju_lokasi', $tiket->id) }}" method="post">
                                @csrf
                                <input type="checkbox" name="info" id="info" checked>
                                <label for="info">Konfirmasi Menuju Lokasi?</label>
                                
                                <div class="group mt-4">
                                    <button type="submit" class="bg-primary hover:bg-red-400 transition-colors px-5 py-2 font-bold text-white rounded-md">Kirim</button>
                                </div>
                            </form>
                        @endif

                        @if (Auth::user()->role == 'teknisi' && $tiket->kategori != 5)
                            <div class="p-4">
                                <div class="flex flex-row justify-between mb-2">
                                    <h3 class="font-bold text-lg">Sampaikan Kendala</h3>
                                </div>

                                <form action="{{ route('teknisi.tiket.lapor_kendala', $tiket->id) }}" method="post">
                                    @csrf
                                    <div class="group">
                                        <label for="jenis_kendala">Jenis Kendala</label>
                                        <br>
                                        <select class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent pl-2 pr-2 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" name="jenis_kendala" id="jenis_kendala">
                                            <option value="1">Peralatan Kurang</option>
                                            <option value="3">Penggantian Sparepart</option>
                                            <option value="2">Perbaikan diluar Garansi</option>
                                        </select>
                                    </div>

                                    <div class="group">
                                        <label for="deskripsi">Keterangan</label>
                                        <textarea name="deskripsi" id="deskripsi" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required></textarea>
                                    </div>

                                    <div class="group mb-3">
                                        <label for="aksi_diambil">Saran Aksi</label>
                                        <br>
                                        <select class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent pl-2 pr-2 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" name="aksi_diambil" id="aksi_diambil">
                                            <option value="1">Penjadwalan Ulang</option>
                                            <option value="3">Penawaran Sparepart</option>
                                            <option value="2">Persetujuan Perbaikan diluar Garansi</option>
                                        </select>
                                    </div>

                                    <div class="group">
                                        <button type="submit" class="bg-primary hover:bg-red-400 transition-colors px-5 py-2 font-bold text-white rounded-md">Kirim</button>
                                    </div>
                                </form>
                            </div>


                            <div class="bg-[#f7f7f7] p-4">
                                <div class="flex flex-row justify-between mb-2">
                                    <h3 class="font-bold text-lg">Lapor Service Selesai</h3>
                                </div>

                                <form action="{{ route('teknisi.tiket.lapor_selesai', $tiket->id) }}" method="post">
                                    @csrf
                                    <div class="group mb-3">
                                        <label for="tanggal">Tanggal Selesai</label>
                                        <input type="date" name="tanggal" id="tanggal" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required>
                                    </div>
    
                                    <div class="group flex gap-4 mb-3">
                                        <div class="">
                                            <label for="dokumentasi">Foto Dokummentasi</label>
                                            <input type="file" accept="image/*" name="dokumentasi" id="dokumentasi" multiple class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary">
                                        </div>
                                        <div class="">
                                            <label for="workorder">Foto Work Order</label>
                                            <input type="file" accept="image/*" name="workorder" id="workorder" multiple class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary">
                                        </div>
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
