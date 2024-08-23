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
                        
                        <hr>
                            <div>
                                <div class="flex flex-row justify-between mb-2">
                                    <h1 class="font-bold text-xl">Log Perbaikan</h1>
                                </div>
                                <div class="border border-stroke rounded-md p-4">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-4 font-medium text-black dark:text-white">Tanggal</th>
                                                <th class="px-4 py-4 font-medium text-black dark:text-white">Status</th>
                                                <th class="px-4 py-4 font-medium text-black dark:text-white">Dibuat Oleh</th>
                                                <th class="px-4 py-4 font-medium text-black dark:text-white">Keterangan</th>
                                                <th class="px-4 py-4 font-medium text-black dark:text-white">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($log as $item)
                                               <tr>
                                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                                         <p class="text-black dark:text-white">{{ $item->created_at }}</p>
                                                    </td>
                                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        <p class="text-black dark:text-white">{{ $item->konteks }}</p>
                                                    </td>
                                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        <p class="text-black dark:text-white">{{ $item->dibuat_oleh }}</p>  
                                                    </td>
                                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        <p class="text-black dark:text-white">{{ $item->deskripsi }}</p>
                                                    </td>
                                                    <td class="border-b border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        @if ($item->status == 'menunggu')
                                                            <p class="inline-flex rounded-full bg-body bg-opacity-10 px-3 py-1 text-sm font-medium text-graydark">{{ $item->status }}</p>
                                                        @elseif ($item->status == 'penugasan')
                                                            <p class="inline-flex rounded-full bg-purple-600 bg-opacity-10 px-3 py-1 text-sm font-medium text-purple-800">{{ $item->status }}</p>
                                                        @elseif ($item->status == 'dikerjakan')
                                                            <p class="inline-flex rounded-full bg-blue-600 bg-opacity-10 px-3 py-1 text-sm font-medium text-blue-800">{{ $item->status }}</p>
                                                        @elseif ($item->status == 'pending')
                                                            <p class="inline-flex rounded-full bg-yellow-600 bg-opacity-10 px-3 py-1 text-sm font-medium text-yellow-800">{{ $item->status }}</p>
                                                        @elseif ($item->status == 'selesai')
                                                            <p class="inline-flex rounded-full bg-green-600 bg-opacity-10 px-3 py-1 text-sm font-medium text-green-800">{{ $item->status }}</p>
                                                        @elseif ($item->status == 'dibatalkan')
                                                            <p class="inline-flex rounded-full bg-red-600 bg-opacity-10 px-3 py-1 text-sm font-medium text-red-800">{{ $item->status }}</p>
                                                        @endif
                                                    </td>
                                               </tr>
                                           @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <hr>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    @endsection
