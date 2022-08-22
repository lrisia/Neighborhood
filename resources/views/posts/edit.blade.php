@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="mt-6 text-3xl mb-6">
            แก้ไขรายงาน
        </h1>

        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('PUT')

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
                       value="{{ old('title', $post->title) }}"
                       placeholder="" required>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    ปัญหานี้เกี่ยวข้องกับเรื่องอะไรบ้าง (ใส่ได้มากกว่า 1 หัวข้อโดยแบ่งระหว่างหัวข้อด้วยลูกน้ำ `,`)
                </label>
                <input type="text" name="tags" id="tags"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('tags', $post->tagsConcat()) }}"
                       placeholder="" autocomplete="off" required>
            </div>

{{--            <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">เลือกหน่วยงานที่ต้องการให้รับผิดชอบรายงานนี้</label>--}}
{{--            <select name="organization" id="organization" class="mb-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">--}}
{{--                @foreach(\App\Models\Organization::get() as $organization)--}}
{{--                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}

            <label for="organization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">เลือกหน่วยงานที่ต้องการให้รับผิดชอบรายงานนี้</label>
            <select name="organization" id="organization" class="mb-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="{{ $post->organization->id }}">{{ $post->organization->name }}</option>
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
                          required >{{ old('description') }}{{ $post->description }}</textarea>
            </div>

            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                รูปภาพ (ไม่ต้องแก้ไขหากใช้รูปเดิม)
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
                <button class="app-button" type="submit">แก้ไข</button>
            </div>

        </form>
    </section>

    <section class="mx-8 mt-16">
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-b border-red-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-red-500">พื้นที่อันตราย</span>
            </div>
        </div>

        <div>
            <h3 class="text-red-600 mb-4 text-2xl">
                ลบรายงาน
                <p class="text-gray-800 text-xl">
                    เมื่อลบแล้วจะมาสามารถย้อนกลับได้ โปรดกระทำอย่างรอบครอบ
                </p>
            </h3>

            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="relative z-0 mb-6 w-full group">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        เขียนหัวข้อให้ถูกต้องเพื่อลบ
                    </label>
                    <input type="text" name="title" id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="" required>
                </div>
                <button class="app-button red" type="submit">ลบ</button>
            </form>
        </div>
    </section>

@endsection
