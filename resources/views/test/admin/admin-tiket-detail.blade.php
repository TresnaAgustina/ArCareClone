@extends('layout.header_user', ['title' => 'Ticket'])

{{-- if session has error --}}
@section('content')

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
                        
                        {{-- <div>
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Satuan Kerja
                                <sub class="text-red-600 text-lg">*</sub>
                            </label>
                            <input readonly type="text" name="nama_pelanggan" value="{{ $tiket->nama_pelanggan }}" placeholder="Satuan Kerja"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <h1 class="font-bold text-xl">Data PIC</h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama PIC Fakultas
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input readonly type="text" name="nama_pic_fakultas" value="{{ $tiket->nama_pic_fakultas }}"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Telepon PIC Fakultas
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input readonly type="tel" name="telepon_pic_fakultas" value="{{ $tiket->telepon_pic_fakultas }}" placeholder="Telepon PIC Fakultas"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                    
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama PIC Ruangan
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input readonly type="text" name="name_pic_ruangan" value="{{ $tiket->nama_pic_ruangan }}" placeholder="Nama PIC Ruangan"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                   
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Telepon PIC Ruangan
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input readonly type="tel" name="telepon_pic_ruangan" value="{{ $tiket->telepon_pic_ruangan }}" placeholder="Telepon PIC Ruangan"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                            </div>
                        </div>
                        <div>
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Keterangan <sup>(opsional)</sup>
                            </label>
                            <textarea rows="6" name="keterangan" placeholder="Keterangan"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary">{{ $tiket->keterangan }}</textarea>
                        </div> --}}
                        <hr>
                            <div>
                                <div class="flex flex-row justify-between mb-2">
                                    <h1 class="font-bold text-xl">Log Perbaikan</h1>
                                </div>
                                <div class="border border-stroke rounded-md p-4 overflow-x-auto">
                                    <table class="w-full text-left table-fixed">
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
                                                    <td class="border-[#eee] px-4 py-5 dark:border-strokedark">
                                                         <p class="text-black dark:text-white">{{ $item->created_at }}</p>
                                                    </td>
                                                    <td class="border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        <p class="text-black dark:text-white">{{ $item->konteks }}</p>
                                                    </td>
                                                    <td class="border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        <p class="text-black dark:text-white">{{ $item->dibuat_oleh }}</p>  
                                                    </td>
                                                    <td class="border-[#eee] px-4 py-5 dark:border-strokedark">
                                                        <p class="text-black dark:text-white">{{ $item->deskripsi }}</p>
                                                    </td>
                                                    <td class="border-[#eee] px-4 py-5 dark:border-strokedark">
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
