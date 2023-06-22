<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Models\Pemesanan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class TransactionTable extends Component
{
    use LivewireAlert;
    protected $listeners = ['tableTransactionUpdate', 'confirmed', 'canceled', 'searchReusable'];
    public $search, $data_pesanan, $pesanan_id;

    public function mount()
    {
        $this->tableTransactionUpdate();
    }

    public function render()
    {
        return view('livewire.components.transaction-table')->extends('layouts.app')->section('content');
    }

    public function searchReusable($query)
    {
        $this->search = $query;
        $this->tableTransactionUpdate();
    }

    public function tableTransactionUpdate()
    {
        if ($this->search) {
            $this->data_pesanan = Pemesanan::whereHas('customers', function($q){
                $q->where('nama_cust', 'LIKE', '%' . $this->search . '%');
            })
                ->with('kamars')
                ->orderBy('id', 'DESC')
                ->get();
        }else{
            $this->data_pesanan = Pemesanan::with('customers', 'kamars')
                ->orderBy('id', 'DESC')
                ->get();
        }
    }

    public function delete($id)
    {
        $this->confirm('Are you sure delete this data?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
            'onConfirmed' => 'confirmed',
            'onCancelled' => 'cancelled'
        ]);

        $this->pesanan_id = $id;
    }


    public function confirmed()
    {
        $data = Pemesanan::findOrFail($this->pesanan_id);
        $data->delete();

        $this->alert('success', 'Berhasil menghapus pesanan');
        $this->emit('tableTransactionUpdate');
    }
}
