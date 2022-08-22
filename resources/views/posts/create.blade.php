@extends('layouts.main')

@section('content')
    <section class="mt-6 mx-8">
        <h1 class="text-3xl mb-6">
            เขียนรายงานใหม่
        </h1>

        <h1 class="text-1xl mb-2">แนวทางในการแจ้งปัญหาต่าง ๆ</h1>
        <textarea name="" id="" cols="30" rows="6" disabled
                  style="resize: none"
                  class="mb-6 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
หากปัญหาของคุณเป็นเรื่องเล็กน้อย เช่น น้ำหก มดกัด โดนแมวเลีย สามารถแจ้งแม่บ้านในบริเวณใกล้ ๆ ได้เลย
แต่หากปัญหาของคุณจำเป็นต้องมีการประสานงานระดับใหญ่ ต่อไปนี้จะเป็นแนวทางการเลือกองค์กรที่จะรายงานเพื่อให้ไม่เสียเวลาถูกส่งเรื่องกลับมา
- องค์การบริหาร องค์กรนิสิต หากปัญหาของคุณเกี่ยวข้องกับระบบการบริหารนิสิต
- สำนักงานวิทยาศาสตร์ หากปัญหาของคุณเกี่ยวข้องกับคณะวิทยาศาสตร์
- สำนักกีฬา หากปัญหาของคุณเกี่ยวข้องกับการเรื่องกีฬา เช่น สนาม อุปกรณ์
- สภาผู้แทนนิสิตองค์กรนิสิต หากปัญหาของคุณเกี่ยวกับเรื่องสวัสดิการหรือสิทธิต่าง ๆ ภายในมหาวิทยาลัย
        </textarea>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    หัวข้อ
                </label>
                @if ($errors->has('title'))
                    <p class="text-red-600">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <input type="text" name="title" id="title"
                       class="bg-gray-50 border @error('title') border-red-600 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title') }}"
                       placeholder="" required>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    ปัญหานี้เกี่ยวข้องกับเรื่องอะไรบ้าง (ใส่ได้มากกว่า 1 หัวข้อโดยแบ่งระหว่างหัวข้อด้วยลูกน้ำ `,`)
                </label>
                <input type="text" name="tags" id="tags"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('tags') }}"
                       placeholder="" autocomplete="off" required>
            </div>

            <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">เลือกหน่วยงานที่ต้องการให้รับผิดชอบรายงานนี้</label>
            <select name="organization" id="organization" class="mb-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach(\App\Models\Organization::get() as $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                @endforeach
            </select>

            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                   รายละเอียด
                </label>
                @error('description')
                    <p class="text-red-600">
                        {{ $message }}
                    </p>
                @enderror
                <textarea rows="4" type="text" name="description" id="description"
                       class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required >{{ old('description') }}</textarea>
            </div>

            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                รูปภาพ
            </label>
            <div class="flex justify-center items-center w-full mb-6">
                <label for="upload" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">คลิกเพื่ออัปโหลด</span> หรือลากไฟล์มาวางที่นี่ แต่ถ้าลากวางจะไม่มีอะไรเกิดขึ้นนะเพราะว่าไม่ได้ทำ</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input accept=".jpg, .jpeg, .png" id="upload" name="upload" type="file" class="" />
                </label>
            </div>

            <div>
                <button class="app-button" type="submit">ส่ง</button>
            </div>

        </form>
    </section>

@endsection
