@extends('layout.header_user', ['title' => 'Ticket'])

@section('content')
    {{-- if session has error --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
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
                        @if ($tiket->status == 'menunggu' && $tiket->kategori == 2)
                        <div class="">
                            <div class="flex flex-row justify-between mb-2">
                                <h3 class="font-bold text-lg">Konfirmasi Jadwal</h3>
                            </div>

                            <form action="{{ route('pelanggan.tiket.konfirmasi_jadwal', $tiket->id) }}" method="post">
                                @csrf

                                <div class="group mb-3">
                                    <label for="persetujuan">Persetujuan</label>
                                    <select name="persetujuan" id="persetujuan" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required>
                                        <option value="1">Setuju</option>
                                        <option value="0">Tidak Setuju</option>
                                    </select>
                                </div>

                                <div class="group mb-3">
                                    <label for="alasan">Keterangan/Alasan</label>
                                    <textarea name="alasan" id="alasan" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary"></textarea>
                                </div>

                                <div class="group">
                                    <button type="submit" class="bg-primary hover:bg-red-400 transition-colors px-5 py-2 font-bold text-white rounded-md">Kirim</button>
                                </div>
                            </form>
                        </div>
                        @endif

                        @if ($tiket->status == 'pending' && $tiket->kategori == 6)
                        <div class="">
                            <div class="flex flex-row justify-between mb-2">
                                <h3 class="font-bold text-lg">Konfirmasi Persetujuan</h3>
                            </div>

                            <form action="{{ route('pelanggan.tiket.konfirmasi_persetujuan', $tiket->id) }}" method="post">
                                @csrf

                                <div class="group mb-3">
                                    <label for="persetujuan">Persetujuan</label>
                                    <select name="persetujuan" id="persetujuan" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary" required>
                                        <option value="1">Setuju</option>
                                        <option value="0">Tidak Setuju</option>
                                    </select>
                                </div>

                                <div class="group mb-3">
                                    <label for="alasan">Keterangan/Alasan</label>
                                    <textarea name="alasan" id="alasan" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary"></textarea>
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
                                                        {{-- @if ($item->status == 'menunggu')
                                                        <h1 class="text-xl font-semibold text-slate-500">{{ $item->konteks }}</h1>
                                                        @elseif ($item->status == 'penugasan')
                                                        <h1 class="text-xl font-semibold text-purple-500">{{ $item->konteks }}</h1>
                                                        @elseif ($item->status == 'dikerjakan')
                                                        <h1 class="text-xl font-semibold text-blue-500">{{ $item->konteks }}</h1>
                                                        @elseif ($item->status == 'pending')
                                                        <h1 class="text-xl font-semibold text-yellow-500">{{ $item->konteks }}</h1>
                                                        @elseif ($item->status == 'selesai')
                                                        <h1 class="text-xl font-semibold text-green-500">{{ $item->konteks }}</h1>
                                                        @elseif ($item->status == 'dibatalkan')
                                                        <h1 class="text-xl font-semibold text-red-500">{{ $item->konteks }}</h1>
                                                        @endif --}}
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
