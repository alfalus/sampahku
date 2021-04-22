<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\models\User;
use App\models\Order;
use App\models\Item;
use App\models\PriceList;

use Auth;

class Orders extends Component
{
    // use WithPagination;
    use WithFileUploads;

    public $orders, $order_id, $item, $itemName, $description, $est_weight, $fix_weight, $photo, $itemList;
    public $isOpen = 0;
    public $isEditBarang = 0;

    public function render()
    {
        $user = User::where('id','=',Auth::id())->first();
        $this->orders = Item::
        select('id_mgt_item','description_item','estimate_weight','fixed_weight','capture_image','price.type_item')
        ->join('price_list as price','management_item.id_type_item','=','price.id_type_item')
        ->where('management_item.id_penyetor','=',Auth::id())
        ->get();

        $this->itemList = $this->getPriceList();
        return view('livewire.order');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isEditBarang = false;
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->item = '';
        $this->itemName = '';
        $this->description = '';
        $this->est_weight = '';
    }

    public function save()
    {
        $this->validate([
            'itemName' => 'nullable',
            'description' => 'required',
            'est_weight' => 'required',
            'photo' => 'required|image|max:1024',
        ]);
        
        $img_name = $this->photo->getClientOriginalName();
        
        $this->photo->storePubliclyAs('photos',$img_name,'public');

        Item::updateOrCreate(['id_mgt_item' => $this->order_id], [
            'id_penyetor' => Auth::id(),
            'id_type_item' => $this->item,
            'description_item' => $this->description,
            'estimate_weight' => $this->est_weight,
            'capture_image' => $img_name,
            'fixed_weight' => 0,

        ]);
  
        session()->flash('message', 
            $this->order_id ? 'Barang Berhasil Diupdate.' : 'Barang Berhasil Ditambah.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id_mgt_item)
    {
        $post = Item::findOrFail($id_mgt_item);
        $this->order_id = $id_mgt_item;
        $this->item = $post->item;
        $this->itemName = $post->id_type_item;
        $this->description = $post->description_item;
        $this->est_weight = $post->estimate_weight;
        $this->photo = $post->capture_image;
        $this->fix_weight = $post->fixed_weight;
    
        $this->isEditBarang = true;
        $this->openModal();
    }

    public function delete($id_mgt_item)
    {
        Item::find($id_mgt_item)->delete();
        session()->flash('message', 'Barang Berhasil Dihapus!');
    }

    public function getPriceList()
    {
        $this->itemList = PriceList::get();
        return $this->itemList;
    }
}
