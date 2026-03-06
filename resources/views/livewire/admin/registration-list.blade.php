<div class="p-6">
    <div class="mb-6">
        <flux:button icon="chevron-left" variant="ghost" :href="route('admin.activities')" wire:navigate>Back to Activities</flux:button>
        <flux:heading size="xl" class="mt-4">ผู้ลงทะเบียน: {{ $activity->name }}</flux:heading>
        <flux:subheading>รายการนักศึกษาที่ลงทะเบียนเข้าร่วมกิจกรรมนี้ ({{ $activity->registrations->count() }} / {{ $activity->total_seats }})</flux:subheading>
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>ลำดับ</flux:table.column>
                <flux:table.column>ชื่อ-นามสกุล</flux:table.column>
                <flux:table.column>อีเมล</flux:table.column>
                <flux:table.column>วันที่ลงทะเบียน</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach($activity->registrations as $index => $registration)
                <flux:table.row :key="$registration->id">
                    <flux:table.cell>{{ $index + 1 }}</flux:table.cell>
                    <flux:table.cell class="font-medium text-zinc-900 dark:text-white">{{ $registration->user->name }}</flux:table.cell>
                    <flux:table.cell>{{ $registration->user->email }}</flux:table.cell>
                    <flux:table.cell>{{ $registration->created_at->format('d/m/Y H:i') }}</flux:table.cell>
                </flux:table.row>
                @endforeach
                @if($activity->registrations->count() === 0)
                <flux:table.row>
                    <flux:table.cell colspan="4" class="text-center py-8 text-zinc-500">
                        ยังไม่มีผู้ลงทะเบียน
                    </flux:table.cell>
                </flux:table.row>
                @endif
            </flux:table.rows>
        </flux:table>
    </flux:card>
</div>
