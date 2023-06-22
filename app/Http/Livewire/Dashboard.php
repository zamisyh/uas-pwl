<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pemesanan;
use App\Models\Customer;
use App\Models\Kamar;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Dashboard extends Component
{

    use LivewireAlert;

    public $customer_id, $kamar_id, $tgl_checkin, $tgl_checkout, $lama_inap, $total_bayar = 0;
    public $search, $rows = 5;
    public $data_customer, $data_kamar;

    public function mount()
    {
        $this->data_customer = Customer::all();
        $this->data_kamar = Kamar::all();
    }

    public function updatedSearch()
    {
        $this->emit('searchReusable', $this->search);
    }

    public function render()
    {
        return view('livewire.dashboard')->extends('layouts.app')->section('content');
    }

    public function updatedLamaInap()
    {
        if (!is_null($this->kamar_id)) {
            $getHargaKamar = Kamar::where('id', $this->kamar_id)->first('jenis_kamar');
            $this->total_bayar = (int) $this->lama_inap * $getHargaKamar->jenis_kamar;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'customer_id' => 'required',
            'kamar_id' => 'required',
            'tgl_checkin' =>  'required|date',
            'tgl_checkout' => 'required|date',
            'lama_inap' => 'required|numeric',
            'total_bayar' => 'required|numeric',
        ]);

        try {
           Pemesanan::insert($data);
           $this->alert('success', 'Berhasil membuat pesanan', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);

            $this->emit('tableTransactionUpdate');
        } catch (\Exception $e) {
           dd($e->getMessage());
        }
    }
}
