@extends('layout.header_login', ['title' => "Login"])

@section('content')   
<div>
    <main class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div></div>
        <div class="mt-16 p-2">
            <div
                  class="rounded-md border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
                >
                  <div
                    class=" border-stroke px-6.5 py-4 dark:border-strokedark"
                  >
                    <h3 class="font-black text-4xl text-center text-[#F23C4A] dark:text-white">
                      ArCare
                    </h3>
                  </div>
                  <form action="{{ route('auth') }}" method="POST">
                    @csrf
                    <div class="p-6.5">
                      <div class="mb-4.5">
                        <label
                          class="mb-3 block text-sm font-medium text-black dark:text-white"
                        >
                          Username
                        </label>
                        <input
                        name="username"
                          type="text"
                          placeholder="Masukan username"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                        />
                      </div>

                      <div>
                        <label
                          class="mb-3 block text-sm font-medium text-black dark:text-white"
                        >
                          Password
                        </label>
                        <input
                        name="password"
                          type="password"
                          placeholder="Masukan password"
                          autocomplete="new-password"
                          class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                        />
                      </div>

                      <div
                        class="mb-5.5 mt-5 flex items-center justify-end"
                      >
                        {{-- <label for="formCheckbox" class="flex cursor-pointer">
                          <div class="relative pt-0.5">
                            <input
                              type="checkbox"
                              id="formCheckbox"
                              class="taskCheckbox sr-only"
                            />
                            <div
                              class="box mr-3 flex h-5 w-5 items-center justify-center rounded border border-stroke dark:border-form-strokedark dark:bg-form-input"
                            >
                              <span class="text-white opacity-0">
                                <svg
                                  class="fill-current"
                                  width="10"
                                  height="7"
                                  viewBox="0 0 10 7"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                >
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M9.70685 0.292804C9.89455 0.480344 10 0.734667 10 0.999847C10 1.26503 9.89455 1.51935 9.70685 1.70689L4.70059 6.7072C4.51283 6.89468 4.2582 7 3.9927 7C3.72721 7 3.47258 6.89468 3.28482 6.7072L0.281063 3.70701C0.0986771 3.5184 -0.00224342 3.26578 3.785e-05 3.00357C0.00231912 2.74136 0.10762 2.49053 0.29326 2.30511C0.4789 2.11969 0.730026 2.01451 0.992551 2.01224C1.25508 2.00996 1.50799 2.11076 1.69683 2.29293L3.9927 4.58607L8.29108 0.292804C8.47884 0.105322 8.73347 0 8.99896 0C9.26446 0 9.51908 0.105322 9.70685 0.292804Z"
                                    fill=""
                                  />
                                </svg>
                              </span>
                            </div>
                          </div>
                          <p>Remember me</p>
                        </label> --}}

                        {{-- <a href="#" class="text-sm text-primary hover:underline"
                          >Forget password?</a
                        > --}}
                      </div>

                      <button type="submit"
                        class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
                      >
                        Login
                      </button>
                      <br>
                      <p class="text-center">If you are having trouble, for assistance please contact</p>
                      <div class="flex flex-row gap-3 justify-center">
                        <div><i class="fa-solid fa-phone"></i> +62853321220</div>
                        <div><i class="fa-brands fa-whatsapp"></i> +628513302129</div>
                      </div>
                    </div>
                  </form>
                </div>
        </div>
        <div></div>
    </main>
</div>
@endsection