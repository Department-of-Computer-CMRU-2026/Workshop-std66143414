<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <flux:heading size="xl">จัดการหัวข้อกิจกรรม</flux:heading>
            <flux:subheading>เพิ่ม แก้ไข หรือลบหัวข้อกิจกรรมสำหรับลงทะเบียน</flux:subheading>
        </div>
        <flux:button icon="plus" variant="primary" wire:click="create">เพิ่มกิจกรรมใหม่</flux:button>
    </div>

    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column>ชื่อกิจกรรม</flux:table.column>
                <flux:table.column>วิทยากร</flux:table.column>
                <flux:table.column>สถานที่</flux:table.column>
                <flux:table.column>ที่นั่ง (ลงทะเบียน/ทั้งหมด)</flux:table.column>
                <flux:table.column>จัดการ</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach($activities as $activity)
                <flux:table.row :key="$activity->id">
                    <flux:table.cell class="font-medium text-zinc-900 dark:text-white">
                        <a href="{{ route('admin.registrations', $activity) }}" class="hover:underline">
                            {{ $activity->name }}
                        </a>
                    </flux:table.cell>
                    <flux:table.cell>{{ $activity->speaker }}</flux:table.cell>
                    <flux:table.cell>{{ $activity->location }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge size="sm" color="{{ $activity->is_full ? 'red' : 'green' }}" inset="left">
                            {{ $activity->registrations_count }} / {{ $activity->total_seats }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        <div class="flex gap-2">
                            <flux:button size="sm" variant="ghost" icon="pencil" wire:click="edit({{ $activity->id }})" />
                            <flux:button size="sm" variant="ghost" color="red" icon="trash" wire:click="delete({{ $activity->id }})" wire:confirm="ยืนยันการลบกิจกรรมนี้?" />
                        </div>
                    </flux:table.cell>
                </flux:table.row>
                @endforeach
                @if(count($activities) === 0)
                <flux:table.row>
                    <flux:table.cell colspan="5" class="text-center py-8 text-zinc-500">
                        ยังไม่มีหัวข้อกิจกรรม
                    </flux:table.cell>
                </flux:table.row>
                @endif
            </flux:table.rows>
        </flux:table>
    </flux:card>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingActivityId ? 'แก้ไขกิจกรรม' : 'เพิ่มกิจกรรมใหม่' }}</flux:heading>
            </div>

            <flux:input label="ชื่อกิจกรรม" wire:model="name" placeholder="ระบุชื่อกิจกรรม..." />
            <flux:input label="วิทยากร" wire:model="speaker" placeholder="ระบุชื่อวิทยากร..." />
            <flux:input label="สถานที่" wire:model="location" placeholder="ระบุสถานที่จัดงาน..." />
            <flux:input label="จำนวนที่นั่งทั้งหมด" type="number" wire:model="total_seats" placeholder="เช่น 50" />

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button variant="ghost" wire:click="$set('showModal', false)">ยกเลิก</flux:button>
                <flux:button variant="primary" wire:click="save">บันทึกข้อมูล</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
