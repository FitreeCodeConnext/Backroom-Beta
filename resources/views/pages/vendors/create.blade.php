@extends('layouts.master')
@section('title')
    Create Vendor
@endsection
@section('content')
    <div class="pb-4 mb-4 rounded-t">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('vendor.index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        Vendor
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Add
                            Vendor
                        </a>
                    </div>
                </li>

            </ol>
        </nav>
    </div>
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add
            Vendor
        </h3>
    </div>
    <div class="grid gap-4 mb-4 sm:grid-cols-1">
        <form action="{{ route('vendor.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-4 md:grid-cols-3">
                <div>
                    <label for="text" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสร้านค้า</label>
                    <input type="text" id="text" name="vendor_id" placeholder="0000001"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="" required />
                </div>
                <div>
                    <label class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสสาขา</label>
                    <select name="branch_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>เลือก</option>
                        <option value="{{$branch_id}}">{{$branch_id}}</option>
                    </select>
                </div>
                <div>
                    <label for="text-id-no" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">รหัสเครื่อง
                        (Terminal ID)</label>
                    <select name="term_id" id="text-id-no"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>เลือก</option>
                        @foreach ($terminal_info as $terminal)
                            <option value="{{$terminal['term_id']}}">{{$terminal['term_id']}}</option>
                        @endforeach

                    </select>
                </div>
                <div>
                    <label for="text-no" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">ลำดับที่</label>
                    <input type="text" id="text-no" name="term_seq" placeholder="1, 2..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="" required />
                </div>
                <div>
                    <label for="datepicker-start"
                        class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">วันที่เริ่มใช้</label>
                    <div class="relative">
                        <input  type="datetime-local" name="issuedate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="12-07-2024">
                    </div>
                </div>
                <div>
                    <label for="datepicker-end"
                        class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">วันที่สิ้นสุดใช้งาน</label>
                    <div class="relative">
                        
                        <input  type="datetime-local" name="validdate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="12-07-2024">
                    </div>
                </div>
                <div>
                    <label for="text-vendor"
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อร้านค้า</label>
                    <input type="text" id="text-vendor" name="vendor_name" placeholder="ร้านข้าวแกง ..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="" required />
                </div>

                {{-- ไม่ได้ ใส่ name --}}
                <div>
                    <label for="text-eng" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อร้านค้า
                        Eng</label>
                    <input type="text" id="text-eng" name="" placeholder="ร้านข้าวแกง ..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="" />
                </div>
                <div>
                    <label for="text-owner" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Owner</label>
                    <select name="owner_shop" id="text-owner"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>เลือก</option>
                        <option value="0">ร้านค้าทั่วไป</option>
                        <option value="1">ร้านค้า CPN</option>
                    </select>
                </div>
                <div>
                    <label for="text-1"
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white">จุดร้านค้า</label>
                    <input type="text" id="text-1" name="" placeholder="จุดขายที่ 13"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-2" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">ประเภทร้านค้า
                        (SUB)</label>
                    <input type="text" id="text-2" name="" placeholder="จุดขายที่ 13"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-owner"
                        class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">ประเภทร้านค้า</label>
                    <select name="" id="text-owner"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>เลือก</option>
                        <option value="0">เครื่องดื่ม</option>
                        <option value="1">อาหาร</option>
                        <option value="2">เบ็ดเตล็ด</option>
                    </select>
                </div>
                <div>
                    <label for="text-3" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">AR SAB</label>
                    <input type="text" id="text-3" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-4" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Contract
                        No.</label>
                    <input type="text" id="text-4" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-5" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Lease No.</label>
                    <input type="text" id="text-5" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-6"
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white">เลขเสียภาษี</label>
                    <input type="text" id="text-6" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-7"
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white">สาขาเสียภาษี</label>
                    <input type="text" id="text-7" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-8" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Location
                        No.</label>
                    <input type="text" id="text-8" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-9" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Serial
                        No.</label>
                    <input type="text" id="text-9" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-10" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">IP
                        Address</label>
                    <input type="text" id="text-10" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-11" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Txn No.</label>
                    <input type="text" id="text-11" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-12" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Bacth No.</label>
                    <input type="text" id="text-12" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-13" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Bill
                        Count</label>
                    <input type="text" id="text-13" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-14" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Consign</label>
                    <input type="text" id="text-14" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-15" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">GP Code</label>
                    <input type="text" id="text-15" name="" placeholder="..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
                <div>
                    <label for="text-16" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">GP Consign
                        %</label>
                    <input type="text" id="text-16" name="" placeholder="0.00"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value=""  />
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            <a href="{{ route('payment-group.index') }}">
                <button type="button"
                    class="text-white focus:outline-non bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 mt-2 ">
                    Cancel
                </button>
            </a>
        </form>
    </div>
@endsection
@section('scripts')
@endsection
