<x-app-layout>
    <div>Index of transformers</div>
    @foreach ($products as $product)
        {{ $product->name }}
        {{ $product->description }}
    @endforeach
</x-app-layout>
