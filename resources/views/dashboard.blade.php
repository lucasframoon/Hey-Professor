<x-app-layout>

    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form post :action="route('question.store')">
            <x-textarea label="Question" name="question"/>

            <x-btn.primary>Save</x-buttons>
            <x-btn.reset>Cancel</x-buttons>
        </x-form>

        <hr class="border-gray-700">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">List of questions</div>
        <div class="dark:text-gray-400 space-y-4">
            @foreach ($questions as $item )
                <x-question :question="$item" />
            @endforeach
        </div>
    </x-container>
</x-app-layout>
