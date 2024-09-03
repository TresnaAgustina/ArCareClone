<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-white duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5 border-b border-neutral-200">
        <a href="index.html">
            Hello
            {{-- <img src="./images/logo/logo.svg" alt="Logo" /> --}}
        </a>

        <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill="" />
            </svg>
        </button>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 lg:mt-3 lg:px-6" x-data="{ selected: $persist('Dashboard'), subpage: $persist('') }" x-effect="console.log(selected)">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-black">MENU</h3>

                <ul x-effect="console.log('this Page: '+ page)" class="mb-6 flex flex-col gap-1.5">

                    <!-- Menu Item Dashboard -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-bold text-black hover:text-white duration-300 ease-in-out hover:bg-primary dark:hover:bg-meta-4"
                            href="/admin/dashboard"
                            x-on:click="selected = (selected === 'Dashboard' ? '':'Dashboard'); subpage = ''"
                            :class="{ 'bg-primary text-white dark:bg-meta-4': (selected === 'Dashboard') && (
                                    page === 'dashboard') }">
                            <i class="fa-solid fa-house"></i>

                            Dashboard
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->
                    <!-- Menu Item Master -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-bold text-black hover:text-white duration-300 ease-in-out hover:bg-primary dark:hover:bg-meta-4"
                            x-on:click="selected = (selected === 'Master' ? '': 'Master'); subpage = ''"
                            {{-- @click.prevent="selected = (selected === 'Master' ? '':'Master')" --}}
                            :class="{ 'bg-primary text-white dark:bg-meta-4': (selected === 'Master') || (
                                    page === 'ticketMasuk' || page === 'dikerjakan' || page === 'pending' ||
                                    page === 'selesai' || page === 'dibatalkan') }">
                            <i class="fa-solid fa-database"></i>

                            Data Master

                            <svg @click.prevent="selected = (selected === 'Master' ? '':'Master')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Master') }" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Master') ? 'block' : 'hidden'" x-effect="console.log(subpage)">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a x-on:click="subpage = 'satker'; page = 'satker'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        x-bind:class="subpage === 'satker' ? 'text-red-500' : 'text-bodydark2'"
                                        href="/admin/master/satker">Satuan Kerja</a>
                                </li>
                                <li>
                                    <a x-on:click="subpage = 'akun'; page = 'akun'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        x-bind:class="subpage === 'akun' ? 'text-red-500' : 'text-bodydark2'"
                                        href="/pelanggan/master/akun">Akun</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                    <!-- Menu Item Master -->

                    <!-- Menu Item Ticket -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-bold text-black hover:text-white duration-300 ease-in-out hover:bg-primary dark:hover:bg-meta-4"
                            href="{{ route('admin.tiket.index') }}"
                            x-on:click="selected = (selected === 'Ticket' ? '': 'Ticket'); subpage = ''"
                            {{-- @click.prevent="selected = (selected === 'Ticket' ? '':'Ticket')" --}}
                            :class="{ 'bg-primary text-white dark:bg-meta-4': (selected === 'Ticket') || (
                                    page === 'ticketMasuk' || page === 'dikerjakan' || page === 'pending' ||
                                    page === 'selesai' || page === 'dibatalkan') }">
                            <i class="fa-solid fa-ticket"></i>

                            Ticket

                            <svg @click.prevent="selected = (selected === 'Ticket' ? '':'Ticket')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 fill-current"
                                :class="{ 'rotate-180': (selected === 'Ticket') }" width="20" height="20"
                                viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.41107 6.9107C4.73651 6.58527 5.26414 6.58527 5.58958 6.9107L10.0003 11.3214L14.4111 6.91071C14.7365 6.58527 15.2641 6.58527 15.5896 6.91071C15.915 7.23614 15.915 7.76378 15.5896 8.08922L10.5896 13.0892C10.2641 13.4147 9.73651 13.4147 9.41107 13.0892L4.41107 8.08922C4.08563 7.76378 4.08563 7.23614 4.41107 6.9107Z"
                                    fill="" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Ticket') ? 'block' : 'hidden'" x-effect="console.log(subpage)">
                            <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
                                <li>
                                    <a x-on:click="subpage = 'ticketMasuk'; page = 'ticketMasuk'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        href="/admin/tiket/masuk"
                                        x-bind:class="subpage === 'ticketMasuk' ? 'text-red-500' : 'text-bodydark2'">Ticket
                                        Masuk</a>
                                </li>
                                <li>
                                    <a x-on:click="subpage = 'dikerjakan'; page = 'dikerjakan'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        href="/admin/tiket/aktif"
                                        x-bind:class="subpage === 'dikerjakan' ? 'text-red-500' : 'text-bodydark2'">Dikerjakan</a>
                                </li>
                                <li>
                                    <a x-on:click="subpage = 'pending'; page = 'pending'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        x-bind:class="subpage === 'pending' ? 'text-red-500' : 'text-bodydark2'"
                                        href="/admin/tiket/pending">Pending</a>
                                </li>
                                <li>
                                    <a x-on:click="subpage = 'selesai'; page = 'selesai'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        x-bind:class="subpage === 'selesai' ? 'text-red-500' : 'text-bodydark2'"
                                        href="/admin/tiket/selesai">Selesai</a>
                                </li>
                                <li>
                                    <a x-on:click="subpage = 'dibatalkan'; page = 'dibatalkan'"
                                        class="group relative flex items-center gap-2.5 rounded-md font-semibold px-4 duration-300 ease-in-out hover:text-red-500"
                                        x-bind:class="subpage === 'dibatalkan' ? 'text-red-500' : 'text-bodydark2'"
                                        href="/pelanggan/tiket/dibatalkan">Dibatalkan</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                    <!-- Menu Item Ticket -->

                    <!-- Menu Item Sikronisasi Erzap -->
                    <li>
                        <a class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-bold text-black hover:text-white duration-300 ease-in-out hover:bg-primary dark:hover:bg-meta-4"
                            href="/admin/dashboard"
                            x-on:click="selected = (selected === 'Sikronisasi Erzap' ? '':'Sikronisasi Erzap'); subpage = ''"
                            :class="{ 'bg-primary text-white dark:bg-meta-4': (selected === 'Sikronisasi Erzap') && (
                                    page === 'erzap') }">
                            <i class="fa-solid fa-rotate"></i>

                            Sikronisasi Erzap
                        </a>
                    </li>
                    <!-- Menu Item Sikronisasi Erzap -->
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
