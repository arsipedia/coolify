@props([
    'status' => 'Degraded',
])
<x-loading wire:loading.delay.longer />
<div class="flex items-center gap-2" wire:loading.remove.delay.longer>
    <div class="badge badge-warning badge-xs"></div>
    <div class="text-xs font-medium tracking-wide text-warning">{{ Str::headline($status) }}</div>
</div>
