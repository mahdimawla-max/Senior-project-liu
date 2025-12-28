@extends('welcome')

@section('content')

<!-- ================= PAGE WRAPPER ================= -->
<div class="min-h-screen bg-gray-100 py-10">

    <!-- ================= CARD ================= -->
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 font-[sans-serif]">

        <!-- Page title -->
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-800">
                Edit Profile
            </h2>
            <p class="text-gray-500 mt-2 text-sm">
                Update your personal information below
            </p>
        </div>

        <!-- ================= FORM ================= -->
        <form action="/update-user/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @csrf

            <!-- Form grid -->
            <div class="grid sm:grid-cols-2 gap-6">

                <!-- Full Name -->
                <div>
                    <label class="text-gray-700 text-sm font-medium mb-2 block">
                        Full Name
                    </label>
                    <input
                        name="fullname"
                        type="text"
                        class="w-full bg-gray-100 text-gray-800 text-sm px-4 py-3 rounded-lg
                               focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                        placeholder="Enter your full name"
                    />
                </div>

                <!-- Birthdate -->
                <div>
                    <label class="text-gray-700 text-sm font-medium mb-2 block">
                        Birth Date
                    </label>
                    <input
                        type="date"
                        name="birthdate"
                        class="w-full bg-gray-100 text-gray-800 text-sm px-4 py-3 rounded-lg
                               focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                    >
                </div>

                <!-- Profile Picture -->
                <!-- Profile Picture -->
<div>
    <label class="text-gray-700 text-sm font-medium mb-2 block">
        Profile Picture
    </label>

    <div class="flex items-center gap-6">

        {{-- Avatar Preview --}}
        <img
            src="{{ $user->profilepicture ?? '/images/user-placeholder.png' }}"
            alt="Profile picture preview"
            class="w-20 h-20 rounded-full object-cover border border-gray-300 shadow-sm">

        {{-- Upload Button --}}
        <div>
            <label
                class="inline-flex items-center px-5 py-2.5
                       rounded-lg bg-indigo-600 text-white text-sm font-medium
                       cursor-pointer hover:bg-indigo-700 transition">
                Change Photo
                <input
                    type="file"
                    name="profilepicture"
                    class="hidden"
                    accept="image/*">
            </label>

            <p class="text-xs text-gray-500 mt-2">
                JPG, PNG, or JPEG (max 5MB)
            </p>
        </div>

    </div>
</div>


                <!-- Location -->
                <div>
                    <label class="text-gray-700 text-sm font-medium mb-2 block">
                        Location
                    </label>
                    <input
                        name="location"
                        type="text"
                        class="w-full bg-gray-100 text-gray-800 text-sm px-4 py-3 rounded-lg
                               focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                        placeholder="Enter your location"
                    />
                </div>

                <!-- About -->
                <div class="sm:col-span-2">
                    <label class="text-gray-700 text-sm font-medium mb-2 block">
                        About
                    </label>
                    <textarea
                        name="about"
                        rows="4"
                        class="w-full bg-gray-100 text-gray-800 text-sm px-4 py-3 rounded-lg
                               focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                        placeholder="Tell us something about yourself"
                    ></textarea>
                </div>

            </div>

           <!-- ================= ACTION BUTTONS ================= -->
<div class="mt-10 flex items-center justify-center gap-4">

    {{-- Cancel --}}
    <button
        type="button"
        onclick="history.back()"
        class="inline-flex items-center justify-center px-8 py-3
               rounded-lg border border-gray-300
               text-gray-700 text-sm font-medium
               hover:bg-gray-100
               transition-all duration-200"
    >
        Cancel
    </button>

    {{-- Save --}}
    <button
        type="submit"
        class="inline-flex items-center justify-center px-8 py-3
               rounded-lg bg-indigo-600 text-white text-sm font-medium
               hover:bg-indigo-700 hover:shadow-md
               transition-all duration-200"
    >
        Save Changes
    </button>

</div>


        </form>
    </div>
</div>

@endsection
