<div class="p-6">
    <flux:heading size="xl" class="mb-6">Dashboard สรุปภาพรวม</flux:heading>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <flux:card class="bg-surface border-none shadow-sm p-4 flex flex-col items-center justify-center space-y-2">
            <flux:text size="sm" class="uppercase tracking-wider font-semibold text-zinc-400">หัวข้อกิจกรรมทั้งหมด</flux:text>
            <flux:heading size="xl" class="text-accent-foreground">{{ $stats['total_activities'] }}</flux:heading>
        </flux:card>
        <flux:card class="bg-surface border-none shadow-sm p-4 flex flex-col items-center justify-center space-y-2">
            <flux:text size="sm" class="uppercase tracking-wider font-semibold text-zinc-400">ลงทะเบียนแล้ว (คน)</flux:text>
            <flux:heading size="xl" class="text-accent-foreground">{{ $stats['total_registrations'] }}</flux:heading>
        </flux:card>
        <flux:card class="bg-surface border-none shadow-sm p-4 flex flex-col items-center justify-center space-y-2">
            <flux:text size="sm" class="uppercase tracking-wider font-semibold text-zinc-400">ที่นั่งทั้งหมด</flux:text>
            <flux:heading size="xl" class="text-accent-foreground">{{ $stats['total_seats'] }}</flux:heading>
        </flux:card>
        <flux:card class="bg-surface border-none shadow-sm p-4 flex flex-col items-center justify-center space-y-2">
            <flux:text size="sm" class="uppercase tracking-wider font-semibold text-zinc-400">เต็มแล้ว (หัวข้อ)</flux:text>
            <flux:heading size="xl" class="{{ $stats['full_activities'] > 0 ? 'text-rose-500' : 'text-accent-foreground' }}">{{ $stats['full_activities'] }}</flux:heading>
        </flux:card>
    </div>

    <flux:heading size="lg" class="mb-4">สถานะที่นั่งรายหัวข้อ</flux:heading>
    <flux:card class="bg-surface border-none shadow-sm">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>หัวข้อกิจกรรม</flux:table.column>
                <flux:table.column>ลงทะเบียน</flux:table.column>
                <flux:table.column>คงเหลือ</flux:table.column>
                <flux:table.column>สถานะ</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach($stats['activities'] as $activity)
                <flux:table.row :key="$activity->id">
                    <flux:table.cell class="font-medium text-accent-foreground">{{ $activity->name }}</flux:table.cell>
                    <flux:table.cell>{{ $activity->registrations_count }}</flux:table.cell>
                    <flux:table.cell>{{ $activity->available_seats }}</flux:table.cell>
                    <flux:table.cell>
                        @if($activity->is_full)
                        <flux:badge color="rose" size="sm" variant="pill">เต็มแล้ว</flux:badge>
                        @else
                        <flux:badge color="teal" size="sm" variant="pill">เปิดรับสมัคร</flux:badge>
                        @endif
                    </flux:table.cell>
                </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
