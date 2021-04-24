<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\models\User;
use App\models\Order;
use App\models\Item;
use App\models\ItemDetail as Detail;
use App\models\PriceList;
use Illuminate\Support\Facades\DB;

use Auth;

class Orders extends Component
{
    // use WithPagination;
    use WithFileUploads;

    public $orders, $order_id, $trx, $mgt_id, $item, $itemName, $description, $est_weight, $fix_weight, $photo, $itemList, $user, $detail_id, $req_order, $lat, $lng, $history;
    public $isOpen = 0;
    public $isEditBarang = 0;

    protected $listeners = [
        'setLatLong' => 'setLatLong'
    ];

    public function render()
    {
        $this->user = User::where('id','=',Auth::id())->first();
        $this->orders = $this->getLastItem();
        // $this->history = $this->getHistory();

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

        $last_id = $this->getMgtItem();
        if ($last_id) {
            $this->mgt_id = $last_id->id_mgt_item;
        } else {
            $item = Item::updateOrCreate(['id_mgt_item' => $this->mgt_id],[
                'id_penyetor' => Auth::id(),
            ]);
            $this->mgt_id = $item->id_mgt_item;
        }


        Detail::updateOrCreate(['id_detail' => $this->detail_id], [
            'id_mgt_item' => $this->mgt_id,
            'id_type_item' => $this->item,
            'description_item' => $this->description,
            'estimate_weight' => $this->est_weight,
            'capture_image' => $img_name
        ]);
        

  
        session()->flash('message', 
            $this->mgt_id ? 'Barang Berhasil Diupdate.' : 'Barang Berhasil Ditambah.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id_detail)
    {
        $post = Detail::findOrFail($id_detail);
        $this->detail_id = $id_detail;
        $this->mgt_id = $post->id_mgt_item;
        $this->item = $post->item;
        $this->itemName = $post->id_type_item;
        $this->description = $post->description_item;
        $this->est_weight = $post->estimate_weight;
        $this->photo = $post->capture_image;
        $this->fix_weight = $post->fixed_weight;
    
        $this->isEditBarang = true;
        $this->openModal();
    }

    public function delete($id_detail)
    {
        $this->orders = $this->getLastItem();
        Detail::find($id_detail)->delete();
        session()->flash('message', 'Barang Berhasil Dihapus!');
    }

    public function getPriceList()
    {
        $this->itemList = PriceList::get();
        return $this->itemList;
    }

    public function getMgtItem()
    {
        try {
            $result = Item::where('id_penyetor',Auth::id())->where('status','0')->latest('id_mgt_item')->first();
        } catch (\Throwable $th) {
            dd(true);
        }
        return $result;
    }

    public function getLastItem()
    {
        $this->orders = Item::
        select('management_item.id_mgt_item','id_penyetor','status','detail.id_detail','detail.description_item','detail.estimate_weight','detail.fixed_weight','detail.capture_image','price.type_item','price.price_weight')
        ->join('item_detail as detail','management_item.id_mgt_item','=','detail.id_mgt_item')
        ->join('price_list as price','detail.id_type_item','=','price.id_type_item')
        ->where('management_item.id_penyetor','=',Auth::id())
        ->where('management_item.status','0')
        ->get();
        return $this->orders;
    }

    public function requestOrder()
    {
        $item = $this->getMgtItem();
        $last_mgt = $item->id_mgt_item;
        $penyetor = Auth::id();
        $nearest = $this->getNearest($this->lat, $this->lng);
        // dd(doubleval($nearest->distance));
        $trx = Order::updateOrCreate(['id_order' => $this->order_id], [
            'id_mgt_item' => $last_mgt,
            'id_penyetor' => $penyetor,
            'id_bank_sampah' => $nearest->id,
            'date_order' => now(),
            'distance' => $nearest->distance,
            'vehicle' => 'truk sampah',
            'description' => '-'
        ]);

        if ($trx) {
            $updateMgt = $this->updateMgtItem($last_mgt);
            $this->trx = $nearest;
            session()->flash('message', 'Pemesanan Telah Berhasil!');

            // get history 
        } else {
            dd(true);
        }
    }

    public function updateMgtItem($id)
    {
        $mgt = Item::findOrFail($id);
        if ($mgt) {
            $result = Item::updateOrCreate(['id_mgt_item' => $id], [
                'status' => '1'
            ]);
        } else {
            dd(true);
        }
        return $result;
    }

    public function setLatLong($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function getNearest($lat, $lng)
    {
        $lat = '-6.2250847';
        $lng = '106.8471053';
        $result = User::select('*',DB::raw('(
            6371 * ACOS(
                COS(
                    RADIANS(
                        "'.$lat.'"
                    )
                ) * COS(RADIANS(lat)) * COS(
                    RADIANS(`long`) - RADIANS(
                        "'.$lng.'"
                    )
                ) + SIN(
                    RADIANS(
                        "'.$lat.'"
                    )
                ) * SIN(RADIANS(lat))
            )
        ) AS distance'))->where('id','!=',Auth::id())->orderBy('distance','asc')->first();
        return $result;
    }

    public function getHistory()
    {
        try {
            $result = Order::where('id_penyetor','=',Auth::id())->get();
        } catch (\Throwable $th) {
            dd(true);
        }
        return $result;
    }


}
