@extends('layout.header_user', ['title' => "Dashboard"])

@section('content')
    <div class="flex flex-col gap-5">
        {{-- jumlah statistik tiket --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            {{-- card 1 --}}
            <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
          >
            <div
              class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
            <i class="fa-solid fa-ticket text-primary"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
              <div>
                <h4
                  class="text-title-md font-bold text-black dark:text-white"
                >
                  12
                </h4>
                <span class="text-sm font-medium">Total Ticket</span>
              </div>

            </div>
          </div>
            {{-- card 2 --}}
            <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
          >
            <div
              class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
            <i class="fa-solid fa-ticket text-primary"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
              <div>
                <h4
                  class="text-title-md font-bold text-black dark:text-white"
                >
                  3
                </h4>
                <span class="text-sm font-medium">Ticket Menunggu</span>
              </div>

            </div>
          </div>
            {{-- card 3 --}}
            <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
          >
            <div
              class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
            <i class="fa-solid fa-ticket text-primary"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
              <div>
                <h4
                  class="text-title-md font-bold text-black dark:text-white"
                >
                  2
                </h4>
                <span class="text-sm font-medium">Ticket On Process</span>
              </div>

            </div>
          </div>
            {{-- card 4 --}}
            <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
          >
            <div
              class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
            <i class="fa-solid fa-ticket text-primary"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
              <div>
                <h4
                  class="text-title-md font-bold text-black dark:text-white"
                >
                  1
                </h4>
                <span class="text-sm font-medium">Pending</span>
              </div>

            </div>
          </div> 
            {{-- card 5 --}}
            <div
            class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
          >
            <div
              class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
            >
            <i class="fa-solid fa-ticket text-primary"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
              <div>
                <h4
                  class="text-title-md font-bold text-black dark:text-white"
                >
                  4
                </h4>
                <span class="text-sm font-medium">Ticket Selesai</span>
              </div>

            </div>
          </div> 
                {{-- card 6 --}}
            <div
                class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark"
              >
                <div
                  class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4"
                >
                <i class="fa-solid fa-ticket text-primary"></i>
                </div>
    
                <div class="mt-4 flex items-end justify-between">
                  <div>
                    <h4
                      class="text-title-md font-bold text-black dark:text-white"
                    >
                      1
                    </h4>
                    <span class="text-sm font-medium">Ticket Dibatalkan</span>
                  </div>
    
                </div>
              </div> 
        </div>
        <div class="container">
            <h2 class="font-black text-2xl py-4">Tiket Aktif</h2>
            <div class="flex flex-col gap-4 mb-20">
                <div class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="text-xl font-bolds">TK-20019223</div>
                    <br>
                    <hr>
                    <br>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                        <div>
                            <p class="text-neutral-500 text-md">PIC Fakultas</p>
                            <h3 class="text-neutral-950 font-bold text-xl">Fakultas Kedokteran Unud</h3>
                        </div>
                        <div>
                            <p class="text-neutral-500 text-md">PIC Ruangan</p>
                            <h3 class="text-neutral-950 font-bold text-xl">John Doe</h3>
                        </div>
                        <div>
                            <p class="text-neutral-500 text-md">tanggal</p>
                            <h3 class="text-neutral-950 font-bold text-xl">12/08/2024</h3>
                        </div>
                    </div>                  
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 bg-neutral-200 rounded-md p-4 items-center align-middle">
                        <div class="col-span-1">
                            <p class="text-neutral-700 text-sm font-bold mb-2">Status</p>
                            <h3 class="text-neutral-950">Sedang proses perbaikan</h3>
                        </div>
                        <div class="col-span-2">
                            <p class="text-neutral-700 text-sm font-bold mb-2">Deskripsi</p>
                            <h3 class="text-neutral-950 text-ellipsis overflow-hidden h-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec vehicula lorem, id dictum turpis. Donec in pretium metus. Vestibulum molestie aliquam erat, et aliquam purus tempus quis. Proin auctor at ipsum ac fermentum. In hac habitasse platea dictumst. Mauris non dui nulla. Duis dui nibh, congue sed ipsum at, mollis viverra dui.</h3>
                        </div>
                        <div class="col-span-1">
                            <div class="rounded-lg bg-blue-500 p-2">
                               <p class="item-center text-center font-bold text-white">Sedang Perbaikan</p>
                            </div>
                        </div>
                    </div>                  
                </div>
                <div class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                    <div class="text-xl font-bolds">TK-20019223</div>
                    <br>
                    <hr>
                    <br>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
                        <div>
                            <p class="text-neutral-500 text-md">PIC Fakultas</p>
                            <h3 class="text-neutral-950 font-bold text-xl">Fakultas Kedokteran Unud</h3>
                        </div>
                        <div>
                            <p class="text-neutral-500 text-md">PIC Ruangan</p>
                            <h3 class="text-neutral-950 font-bold text-xl">John Doe</h3>
                        </div>
                        <div>
                            <p class="text-neutral-500 text-md">tanggal</p>
                            <h3 class="text-neutral-950 font-bold text-xl">12/08/2024</h3>
                        </div>
                    </div>                  
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 bg-neutral-200 rounded-md p-4 items-center align-middle">
                        <div class="col-span-1">
                            <p class="text-neutral-700 text-sm font-bold mb-2">Status</p>
                            <h3 class="text-neutral-950">Sedang proses perbaikan</h3>
                        </div>
                        <div class="col-span-2">
                            <p class="text-neutral-700 text-sm font-bold mb-2">Deskripsi</p>
                            <h3 class="text-neutral-950 text-ellipsis overflow-hidden h-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec vehicula lorem, id dictum turpis. Donec in pretium metus. Vestibulum molestie aliquam erat, et aliquam purus tempus quis. Proin auctor at ipsum ac fermentum. In hac habitasse platea dictumst. Mauris non dui nulla. Duis dui nibh, congue sed ipsum at, mollis viverra dui.</h3>
                        </div>
                        <div class="col-span-1">
                            <div class="rounded-lg bg-blue-500 p-2">
                               <p class="item-center text-center font-bold text-white">Sedang Perbaikan</p>
                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
            <div class="grid grid-cols-1 bottom-0 left-0 right-0 h-full sticky md:hidden mb-4">
                <button class="absolute bottom-0 z-50 w-full bg-primary shadow-lg text-white rounded-md py-4">Buat Ticket Baru</button>
            </div>
        </div>
    </div>
@endsection