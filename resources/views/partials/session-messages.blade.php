@if(session('success'))
    <div class="mb-6 bg-fresh-green/10 border border-fresh-green/20 text-fresh-green px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-brick-red/10 border border-brick-red/20 text-brick-red px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
@endif