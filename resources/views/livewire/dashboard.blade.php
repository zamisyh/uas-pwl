<div>
    <div class="container px-14 py-14">
        <div class="flex justify-between mb-10">
            <div>
                <input wire:model='search' type="text" class="input input-bordered" placeholder="Cari nama customer ..." />
            </div>
            <div>
                <!-- The button to open modal -->
                <label for="my-modal-6" class="btn">Tambah Data</label>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                <div class="modal modal-bottom sm:modal-middle">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Tambah Transaksi</h3>
                        <form>
                            <div class="w-full form-control">
                                <label class="label">
                                    <span class="label-text">Nama Customer</span>
                                </label>
                                <select wire:model='customer_id' class="w-full select select-bordered @error('customer_id') select-error @enderror">
                                    <option value="" selected>Pilih</option>
                                    @foreach ($data_customer as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->nama_cust }}</option>
                                    @endforeach
                                </select>
                                <label class="label">
                                    @error('customer_id')
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="w-full form-control">
                                <label class="label">
                                    <span class="label-text">Jenis Kamar</span>
                                </label>
                                <select wire:model='kamar_id' class="w-full select select-bordered @error('kamar_id') select-error @enderror">
                                    <option value="" selected>Pilih</option>
                                    @foreach ($data_kamar as $kamar)
                                        <option value="{{ $kamar->id }}">{{ $kamar->kategori }} [{{ number_format($kamar->jenis_kamar) }} / Hari]</option>
                                    @endforeach
                                </select>
                                <label class="label">
                                    @error('kamar_id')
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="w-full form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Checkin</span>
                                </label>
                                <input wire:model='tgl_checkin' type="date" placeholder="Masukkan tanggal checkout" class="w-full input input-bordered @error('tgl_checkin') input-error @enderror" />
                                <label class="label">
                                    @error('tgl_checkin')
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="w-full form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Checkout</span>
                                </label>
                                <input wire:model='tgl_checkout' type="date" placeholder="Masukkan tanggal checkout" class="w-full input input-bordered @error('tgl_checkout') input-error @enderror" />
                                <label class="label">
                                    @error('tgl_checkout')
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="w-full form-control">
                                <label class="label">
                                    <span class="label-text">Lama Inap</span>
                                </label>
                                <input wire:model='lama_inap' type="number" placeholder="Masukkan nama customer" class="w-full input input-bordered @error('lama_inap') input-error @enderror" />
                                <label class="label">
                                    @error('lama_inap')
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="w-full form-control">
                                <label class="label">
                                    <span class="label-text">Total Bayar</span>
                                </label>
                                <input wire:model='total_bayar' type="number" readonly placeholder="Masukkan nama customer" class="w-full input input-bordered @error('total_bayar') input-error @enderror" />
                                <label class="label">
                                    @error('total_bayar')
                                    <span class="text-red-500 label-text-alt">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </form>
                        <div class="modal-action">
                            <label for="my-modal-6" class="btn">Close</label>
                            <button wire:click='save' for="my-modal-6" class="btn btn-primary">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @livewire('components.transaction-table')
    </div>
</div>
