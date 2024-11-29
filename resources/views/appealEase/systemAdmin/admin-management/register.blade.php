<div class="container my-3">
    <div x-data="{ userType: '' }">

    <x-validation-errors class="mb-4" />

        <!-- Start of the form -->
        <form method="POST" action="{{ route('admin-management') }}">
            @csrf

            <!-- User type selection -->
            <div class="mt-4">
                <x-label for="usertype" value="{{ __('User Type') }}" />
                <select x-model="userType" id="usertype" name="usertype" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="camis">LITIGANT</option>
                    <option value="clerk">CLERK</option>
                    <option value="judge">JUSTICE</option>
                    <!-- Add other user types as needed -->
                </select>
            </div>

            <!-- Common fields -->
            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Additional fields for 'litigant' userType -->
            <template x-if="userType === 'camis'">
                <div>
                    <div class="mt-4">
                        <x-label for="contact_number">Contact Number</x-label>
                        <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="contact_number" name="contact_number" pattern="\d{11}" title="Please enter exactly 11 digits" required>
                    </div>
                    <div class="mt-4">
                        <x-label for="atty_number">Role of Attorney's Number</x-label>
                        <input type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="atty_number" name="atty_number" min="0" required>
                    </div>
                </div>
            </template>

            <!-- Additional fields for 'justice' userType -->
            <template x-if="userType === 'judge'">
                <div>
                    <div class="mt-4">
                        <x-label for="contact_number">Contact Number</x-label>
                        <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="contact_number" name="contact_number" pattern="\d{11}" title="Please enter exactly 11 digits" required>
                    </div>
                    <div class="mt-4">
                        <x-label for="division">Division</x-label>
                        <input type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="division" name="division" min="1" max="5" required>
                    </div>
                </div>
            </template>

            <!-- Additional fields for 'division' userType -->
            <template x-if="userType === 'division'">
                <div>
                    <div class="mt-4">
                        <x-label for="contact_number">Contact Number</x-label>
                        <input type="text" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="contact_number" name="contact_number" pattern="\d{11}" title="Please enter exactly 11 digits" required>
                    </div>
                    <div class="mt-4">
                        <x-label for="division">Division</x-label>
                        <input type="number" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="division" name="division" min="1" max="5" required>
                    </div>
                </div>
            </template>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <!-- End of the form -->
    </div>
</div>
