@extends('layout.header_user', ['title' => 'Ticket'])

@section('content')
    {{-- if session has error --}}
    @if (session('error'))
        <div class="z-999 relative">
            <div class="bg-red-500 text-white p-4 rounded-md mb-5 mt-10">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div>
        <div class="flex flex-col gap-9">
            <!-- Input Fields -->
            <form x-data="newTicket" x-on:submit.prevent="getData()" method="POST">
                @csrf
                <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="border-b flex flex-row justify-between border-stroke px-6.5 py-4 dark:border-strokedark">
                        <h3 class="font-semibold text-2xl text-black dark:text-white">
                            Pengajuan Tiket
                        </h3>
                        <button class="py-2 px-5 bg-primary hover:bg-red-400 rounded-lg transition-colors text-white">
                            Kirim Data <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="flex flex-col gap-5.5 p-6.5">
                        <div>
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Satuan Kerja
                                <sub class="text-red-600 text-lg">*</sub>
                            </label>
                            <input readonly type="text" name="nama_pelanggan" value="{{ Auth::user()->name }}" placeholder="Satuan Kerja"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
                        </div>
                        <h1 class="font-bold text-xl">Data PIC</h1>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama PIC Fakultas
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input type="text" name="nama_pic_fakultas" x-model="nama_pic_fakultas" placeholder="Nama PIC Fakultas"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                    <span id="nama_pic_fakultas-error" class="text-red-600 text-sm"></span>
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Telepon PIC Fakultas
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input type="tel" name="telepon_pic_fakultas" x-model="telepon_pic_fakultas" placeholder="Telepon PIC Fakultas"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                    <span id="telepon_pic_fakultas-error" class="text-red-600 text-sm"></span>
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Nama PIC Ruangan
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input type="text" name="nama_pic_ruangan" x-model="nama_pic_ruangan" placeholder="Nama PIC Ruangan"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                    <span id="nama_pic_ruangan-error" class="text-red-600 text-sm"></span>
                                   
                            </div>
                            <div>
                                <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                    Telepon PIC Ruangan
                                    <sub class="text-red-600 text-lg">*</sub>
                                </label>
                                <input type="tel" name="telepon_pic_ruangan" x-model="telepon_pic_ruangan" placeholder="Telepon PIC Ruangan"
                                    class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                    <span id="telepon_pic_ruangan-error" class="text-red-600 text-sm"></span>
                            </div>
                        </div>
                        <div>
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                Keterangan <sup>(opsional)</sup>
                            </label>
                            <textarea rows="6" name="keterangan" x-model="keterangan" placeholder="Keterangan"
                                class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
                        </div>
                        <br>
                        <div>
                            <div class="flex flex-row justify-between mb-2">
                                <h1 class="font-bold text-xl">Data Detail Permasalahan</h1>
                                <button
                                    x-on:click="detail_tickets.push({lokasi: '', alamat: '', detail_products: [{merk_produk: '', permasalahan: ''}]})"
                                    class="py-2 px-4 border border-primary text-primary hover:text-white hover:bg-primary transition-colors rounded-md"><span><i
                                            class="fa-regular fa-square-plus"></i></span> Tambah Lokasi</button>
                            </div>
                            <div>
                                <template x-for="(obj, idx) in detail_tickets":key="idx">
                                    <div class="flex flex-col bg-neutral-100 rounded-md p-4 mb-3 gap-2">
                                        <div class="flex flex-row-reverse">
                                            <template x-if="idx > 0">
                                                <button x-on:click="detail_tickets.splice(idx, 1)"
                                                    class="py-2 px-3 bg-red-500 hover:bg-red-400 text-white rounded-md"><i
                                                        class="fa-solid fa-xmark"></i></button>
                                            </template>
                                        </div>
                                        <input type="text" name="detail_tickets[idx]['lokasi']" placeholder="Lokasi" x-model="detail_tickets[idx]['lokasi']"
                                            class="w-full rounded-lg border-[1.5px] bg-white border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                        <textarea rows="4" name="detail_tickets[idx]['alamat']" placeholder="Detail Lokasi" x-model="detail_tickets[idx]['alamat']"
                                            class="w-full rounded-lg border-[1.5px] bg-white border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required></textarea>
                                        <div class="flex flex-col gap-3">
                                            <template
                                                x-for="(data, index) in  detail_tickets[idx]['detail_products']":key="index"
                                                x-effect="console.log(detail_tickets.length)">
                                                <div class="flex flex-row gap-2">
                                                    <div class="basis-2/4">
                                                        <input type="text"
                                                            name="detail_tickets[idx]['detail_products'][index]['merk_produk']"
                                                            x-model="detail_tickets[idx]['detail_products'][index]['merk_produk']"
                                                            placeholder="Merk Produk"
                                                            class="w-full rounded-lg border-[1.5px] bg-white border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                                    </div>
                                                    <div class="basis-3/4">
                                                        <input type="text"
                                                            name="detail_tickets[idx]['detail_products'][index]['permasalahan']"
                                                            x-model="detail_tickets[idx]['detail_products'][index]['permasalahan']"
                                                            placeholder="Permasalahan"
                                                            class="w-full rounded-lg border-[1.5px] bg-white border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" required />
                                                    </div>
                                                    <div class="basis-1/4">
                                                        <template x-if="index == 0">
                                                            <button
                                                                x-on:click="detail_tickets[idx]['detail_products'].push({produk: '', permasalahan: ''})"
                                                                class="text-primary hover:bg-neutral-200 transition-colors w-full h-full rounded-lg border-[1.5px] border-stroke bg-white text-xl font-semibold">+</button>
                                                        </template>
                                                        <template x-if="index > 0">
                                                            <button
                                                                x-on:click="detail_tickets[idx]['detail_products'].splice(index, 1)"
                                                                class="text-primary hover:bg-neutral-200 transition-colors w-full h-full rounded-lg border-[1.5px] border-stroke bg-white text-xl font-semibold">-</button>
                                                        </template>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('newTicket', () => ({
                    id_pelanggan: '{{ Auth::user()->id }}',
                    nama_pic_fakultas: '',
                    telepon_pic_fakultas: '',
                    nama_pic_ruangan: '',
                    telepon_pic_ruangan: '',
                    keterangan: '',
                    detail_tickets: [{
                        lokasi: '',
                        alamat: '',
                        detail_products: [{
                            merk_produk: '',
                            permasalahan: ''
                        }]
                    }],
                    getData() {
                        let tiket_detail = []
                        this.detail_tickets.map((data) => tiket_detail.push(JSON.parse(JSON.stringify(
                            data))))


                        let data = {
                            id_pelanggan: this.id_pelanggan,
                            nama_pic_fakultas: this.nama_pic_fakultas,
                            telepon_pic_fakultas: this.telepon_pic_fakultas,
                            nama_pic_ruangan: this.nama_pic_ruangan,
                            telepon_pic_ruangan: this.telepon_pic_ruangan,
                            keterangan: this.keterangan,
                            detail_tickets: tiket_detail
                        }

                        postDataTicket(data)
                    }
                }))
            })


            const postDataTicket = async (ticket) => {
                try {
                    console.log(ticket);
                    const response = await fetch("{{ url('pelanggan/tiket/store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(ticket)
                    });

                    // Jika respon statusnya sukses (2xx)
                    if (response.ok) {
                        const data = await response.json();
                        console.log(data);
                        return Swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil disimpan.',
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = "{{ url('pelanggan/tiket') }}";
                        });
                    } else if (response.status === 422) {
                        // Jika respon statusnya 422 (Unprocessable Entity)
                        const errorData = await response.json();
                        console.error(errorData);

                        // Reset semua error sebelumnya
                        const errorElements = document.querySelectorAll('.text-red-600');
                        errorElements.forEach(element => element.textContent = '');

                        // Tampilkan error di field yang sesuai
                        for (const [field, messages] of Object.entries(errorData.errors)) {
                            const errorField = document.querySelector(`#${field}-error`);
                            if (errorField) {
                                errorField.textContent = messages.join(', ');
                            }
                        }

                        return Swal.fire({
                            title: 'Gagal',
                            text: 'Terdapat kesalahan dalam pengisian form.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        // Handle other types of errors (e.g., server errors)
                        return Swal.fire({
                            title: 'Gagal',
                            text: 'Terdapat kesalahan dalam pengiriman data. Silahkan coba lagi nanti.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                } catch (error) {
                    console.error(error);
                    return Swal.fire({
                        title: 'Gagal',
                        text: 'Terjadi kesalahan dalam sistem. Silahkan coba lagi nanti.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            }
        </script>
    @endsection
