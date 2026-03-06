<div class="p-6">
    <div class="mb-6">
        <flux:heading size="xl" class="font-extrabold">กิจกรรมที่คุณลงทะเบียนไว้</flux:heading>
        <flux:subheading class="font-medium">ดูแลจัดการรายการกิจกรรมที่ได้เลือกไว้</flux:subheading>
    </div>

    @if($registrations->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($registrations as $registration)
        <flux:card class="bg-surface border-none shadow-sm transition-all hover:shadow-md h-full flex flex-col">
            <div class="p-5 flex-grow">
                <flux:heading size="lg" class="text-accent-foreground font-black mb-6 leading-tight border-b border-zinc-50 pb-4">{{ $registration->activity->name }}</flux:heading>
                
                <div class="space-y-4 mb-2">
                    <!-- Speaker -->
                    <div class="flex items-start gap-2 text-lg">
                        <div class="flex items-center gap-3 text-accent/80 shrink-0 w-[160px]">
                            <flux:icon name="user" size="sm" />
                            <span class="text-zinc-500 font-bold whitespace-nowrap">วิทยากร :</span>
                        </div>
                        <span class="text-accent-foreground font-bold flex-1">{{ $registration->activity->speaker }}</span>
                    </div>

                    <!-- Location -->
                    <div class="flex items-start gap-2 text-lg">
                        <div class="flex items-center gap-3 text-accent/80 shrink-0 w-[160px]">
                            <flux:icon name="map-pin" size="sm" />
                            <span class="text-zinc-500 font-bold whitespace-nowrap">สถานที่ :</span>
                        </div>
                        <span class="text-accent-foreground font-bold flex-1">{{ $registration->activity->location }}</span>
                    </div>

                    <!-- Time -->
                    <div class="flex items-start gap-2 text-lg">
                        <div class="flex items-center gap-3 text-accent/80 shrink-0 w-[160px]">
                            <flux:icon name="calendar" size="sm" />
                            <span class="text-zinc-400 font-bold whitespace-nowrap">วันที่บันทึก :</span>
                        </div>
                        <span class="text-accent-foreground font-bold flex-1">{{ $registration->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="px-5 pb-5 mt-auto">
                <flux:button variant="ghost" color="rose" class="w-full hover:bg-rose-50/50 py-4 text-base font-bold" wire:click="cancel({{ $registration->id }})" wire:confirm="ยืนยันการยกเลิกการลงทะเบียน?">ยกเลิกการลงทะเบียน</flux:button>
            </div>
        </flux:card>
        @endforeach
    </div>
    @else
    <flux:card class="bg-surface border-none shadow-sm p-12 flex flex-col items-center justify-center text-center">
        <flux:icon name="calendar" size="lg" class="text-accent/30 mb-4" />
        <flux:heading class="text-accent-foreground font-extrabold">คุณยังไม่ได้ลงทะเบียนกิจกรรมใดๆ</flux:heading>
        <flux:subheading class="mb-6 font-medium">ไปที่หน้ารายการกิจกรรมเพื่อเลือกหัวข้อที่สนใจ</flux:subheading>
        <flux:button variant="primary" :href="route('activities.index')" wire:navigate class="text-white font-bold">ดูหัวข้อกิจกรรมทั้งหมด</flux:button>
    </flux:card>
    @endif
</div>