<div class="p-6">
    <div class="mb-6">
        <flux:heading size="xl" class="font-extrabold">หัวข้อกิจกรรมที่เปิดรับสมัคร</flux:heading>
        <flux:subheading class="font-medium">เลือกกิจกรรมที่สนใจ (ลงทะเบียนได้สูงสุด 3 หัวข้อ)</flux:subheading>
    </div>

    @php
        $registrationsCount = auth()->user()->registrations()->count();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($activities as $activity)
        @php
            $isRegistered = auth()->user()->registrations()->where('activity_id', $activity->id)->exists();
            $canRegister = $activity->canRegister(auth()->user());
        @endphp
        <flux:card class="bg-surface border-none shadow-sm transition-all hover:shadow-md h-full flex flex-col">
            <div class="p-5 flex-grow">
                <div class="flex justify-between items-start mb-6 border-b border-zinc-50 pb-4">
                    <flux:heading size="lg" class="text-accent-foreground font-black leading-tight flex-1">{{ $activity->name }}</flux:heading>
                    @if($isRegistered)
                        <flux:badge color="teal" size="sm" variant="pill" class="shrink-0 font-bold">ลงทะเบียนแล้ว</flux:badge>
                    @elseif($activity->is_full)
                        <flux:badge color="rose" size="sm" variant="pill" class="shrink-0 font-bold">เต็มแล้ว</flux:badge>
                    @endif
                </div>
                
                <div class="space-y-4 mb-2">
                    <!-- Speaker -->
                    <div class="flex items-start gap-2 text-lg">
                        <div class="flex items-center gap-3 text-accent/80 shrink-0 w-[140px]">
                            <flux:icon name="user" size="sm" />
                            <span class="text-zinc-500 font-bold whitespace-nowrap">วิทยากร :</span>
                        </div>
                        <span class="text-accent-foreground font-bold flex-1">{{ $activity->speaker }}</span>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-2 text-lg">
                        <div class="flex items-center gap-3 text-accent/80 shrink-0 w-[140px]">
                            <flux:icon name="map-pin" size="sm" />
                            <span class="text-zinc-500 font-bold whitespace-nowrap">สถานที่ :</span>
                        </div>
                        <span class="text-accent-foreground font-bold flex-1">{{ $activity->location }}</span>
                    </div>

                    <!-- Seats -->
                    <div class="flex items-start gap-2 text-lg">
                        <div class="flex items-center gap-3 text-accent/80 shrink-0 w-[140px]">
                            <flux:icon name="users" size="sm" />
                            <span class="text-zinc-500 font-bold whitespace-nowrap">ลงทะเบียนแล้ว :</span>
                        </div>
                        <div class="flex-1">
                           <span class="font-extrabold text-accent">{{ $activity->registered_count }}</span>
                           <span class="text-zinc-500 font-bold">/ {{ $activity->total_seats }} ที่นั่ง</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-5 pb-5 mt-auto">
                @if($isRegistered)
                    <flux:button variant="ghost" class="w-full bg-zinc-50/50 text-zinc-400 font-bold" disabled>คุณลงทะเบียนแล้ว</flux:button>
                @elseif($activity->is_full)
                    <flux:button variant="ghost" class="w-full bg-zinc-50/50 text-zinc-400 font-bold" disabled>ที่นั่งเต็มแล้ว</flux:button>
                @elseif($registrationsCount >= 3)
                    <flux:button variant="ghost" class="w-full bg-zinc-50/50 text-zinc-400 font-bold" disabled>ลงทะเบียนครบ 3 ที่แล้ว</flux:button>
                @else
                    <flux:button variant="primary" class="w-full shadow-lg hover:shadow-accent/20 hover:scale-[1.02] transition-all duration-200 py-4 text-lg font-black text-white" wire:click="register({{ $activity->id }})" wire:confirm="ยืนยันการลงทะเบียนกิจกรรมนี้?">ลงทะเบียน</flux:button>
                @endif
            </div>
        </flux:card>
        @endforeach
    </div>
</div>